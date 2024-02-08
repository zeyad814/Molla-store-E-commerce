<?php

namespace App\Http\Controllers\auth;

use Auth;
use Hash;
use Session;
use App\Models\Admin;
use App\Models\AdminRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\registerRequest;
use App\Http\Requests\adminLoginRequest;
use App\Http\Requests\addSubadminsRequest;
use App\Http\Requests\updateDetailsRequest;
use App\Http\Requests\updatePasswordRequest;

class adminAuthController extends Controller
{
    public function login(){
        return view('auth.admin.login');
    }
    public function submitLogin(adminLoginRequest $request){
        $data = $request->validated();
        if(auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password']]))
        {
            //remeber me
            if(isset($data['remember'])&&!empty($data['remember'])){
                setcookie('email',$data['email'],time()+3600);
                setcookie('password',$data['password'],time()+3600);
            }else{
                setcookie('email',"");
                setcookie('password',"");
            }
         return redirect()->route('adminHome');
        }
        return back()->withErrors(['password' => 'The email or password is incorrect.']);
    }
    public function adminLogout(){
        Auth::logout();
        return redirect()->route('adminLogin');
    }
    public function updatePassword(){
        session::put('page','updatePassword');
        return view('admin.pages.settings.updatepassword');
    }
    public function submitUpdatePassword(updatePasswordRequest $request){

        $data = $request->all();
        if (Hash::check($data['current_password'],Auth::guard('admin')->user()->password)) {
            if($data['password'] == $data['password_confirmation']){
               Admin::where('id',Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['password'])]);
               return redirect()->back()->with('success','the password is successfully changed');
            }else{
                return redirect()->back()->with('password_confirmation','the password is not match');
            }
        }else{
            return redirect()->back()->with('current_password','the password is incorrect');
        }
    }
    public function checkCurrentPassword(Request $request){
         $data = $request->all();
         if(Hash::check($data['current_password'],Auth::guard('admin')->user()->password) ){
            return "true";
         }else{
            return "false";
         }
    }

    public function updateDetails(){
        session::put('page','updateDetails');
         return view('admin.pages.settings.updateDetails');
    }
    public function submitUpdateDetails(updateDetailsRequest $request){
        $data = $request->all();
        if (isset($data['image']))
        {
            if (file_exists(public_path('admin/assets/img/' . Auth::guard('admin')->user()->image)))
            {
                unlink(public_path('admin/assets/img/' . Auth::guard('admin')->user()->image));
            }
        }
        $img = $request->file('image');
        $ext =$img->getClientOriginalExtension();
        $imageName=time().'.'.$ext;
        $file=$img->move(public_path('admin/assets/img'),$imageName);
        $data['image']=$imageName;
        Admin::where('id',Auth::guard('admin')->user()->id)->update(['image'=>$data['image'],'name'=>$data['name'],'phone'=>$data['phone']]);
        return redirect()->back()->with('success',"The data was updated");


    }
    public function subAdmins(request $request){
        Session::put('page','subAdmin');
        $subadmin=Admin::where(['type'=>'1'])->paginate();
        if(!empty($request->get('search'))){
            $subadmin=Admin::where('type',1)->where('name','like',"%".$request->get('search')."%")->paginate();
        }
        return view('admin.pages.subadmins.index',compact('subadmin'));
    }
    public function updateSubadminState(Request $request,$id){
        $data = Admin::find($id);
        if($data['status']==1){
            Admin::where('id',$data->id)->update(['status'=>0]) ;
        }elseif($data['status']==0){
            Admin::where('id',$data->id)->update(['status'=>1]) ;
        }
        return redirect()->back()->with('success',"The Status is Updated");
    }
    public function deleteSubadmin($id){
        Admin::where('id',$id)->delete();
        return redirect()->back();
    }
    public function addSubadmins(){
        Session::put('page','subAdmin');
        return view('admin.pages.subadmins.add');
    }
    public function submitAddSubadmins(addSubadminsRequest $request){
        $data = $request->validated();
        $data['password']=bcrypt($data['password']);
        Admin::create($data);
        return redirect()->route('subAdmins')->with('success',"The Sub Admin added successfully");
        dd($data);
    }
    public function updateRoles($id){
        Session::put('page','subAdmin');
        $data=Admin::find($id);
        $role = AdminRole::where("subadmin_id",$id)->get();
        return view('admin.pages.subadmins.update_role',compact('data','role'));
    }
    public function submitUpdateRoles(Request $request,$id) {
        $data = $request->all();

        adminRole::where("subadmin_id",$id)->delete();
        foreach ($data as $key => $value) {
            if(isset($value['view'])){
                $view=$value['view'];
            }else{
                $view = 0;
            }
            if(isset($value['edit'])){
                $edit=$value['edit'];
            }else{
                $edit = 0;
            }
            if(isset($value['full'])){
                $full=$value['full'];
            }else{
                $full = 0;
            }
                $role = new AdminRole;
            $role->subadmin_id=$data['subadmin_id'];
            $role->module = $key;
            $role->view_access = $view;
            $role->edit_access = $edit;
            $role->full_access = $full;
            $role->save();
        }

        return redirect()->route('subAdmins')->with('success','Roles updated successfully');
    }

}
