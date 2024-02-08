<?php

namespace App\Http\Controllers\admin;

use Session;
use App\Models\Banner;
use App\Models\AdminRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\createBannerRequest;
use App\Http\Requests\updateBannerRequest;
use Auth;

class adminBannerController extends Controller
{
    public function index(){
        Session::put('page','banner');
        $banners=Banner::paginate(5);
        $bannerPagesModuleCount=AdminRole::where(['subadmin_id'=>Auth::guard('admin')->user()->id,'module'=>'banners'])->count();
        $pageModule=array();
        if(Auth::guard('admin')->user()->type=="2"){
            $pageModule['view_access']="on";
            $pageModule['edit_access']="on";
            $pageModule['full_access']="on";
        }elseif($bannerPagesModuleCount==0){
            $message="this feature is restricted for you!";
            return redirect()->route("adminHome")->with('error',$message);
        }else{
            $pageModule = AdminRole::where(['subadmin_id'=>Auth::guard('admin')->user()->id,'module'=>'banners'])->first()->toArray();
        }
        return view('admin.pages.banners.index',compact('banners','pageModule'));
    }
    public function create() {
        Session::put('page','banner');
        return  view ('admin.pages.banners.create');
    }
    public function store(createBannerRequest $request){
        $data=$request->validated();
        if(isset($data['image'])){
            $img=request()->file('image');
            $image_ext =$img->getClientOriginalExtension();
            $imageName=time().'.'.$image_ext;
            $image_file=$img->move(public_path('admin/assets/img/banners'),$imageName);
            $data['image']= $imageName;
        }
        Banner::create($data);
        return redirect()->route('adminBanner')->with('success',"The Banner was created");
    }
    public function edit($id){
        Session::put('page','banner');
        $banner=Banner::findOrFail($id);
        return view('admin.pages.banners.update', compact('banner'));
    }
    public function update(updateBannerRequest $request, $id) {
        $banner=Banner::find($id);
        $data=$request->validated();
        if(isset($data['image'])){
            if($banner->image==true){
             if (file_exists(public_path("admin\assets\img\banners\\".$banner->image))) {
                    unlink(public_path("admin\assets\img\banners\\".$banner->image));
             }
            }
            $img=request()->file('image');
            $image_ext =$img->getClientOriginalExtension();
            $imageName=time().'.'.$image_ext;
            $image_file=$img->move(public_path('admin/assets/img/banners'),$imageName);
            $data['image']= $imageName;

        }
        Banner::where('id',$id)->update($data);
        return redirect()->route('adminBanner')->with('success',"The banner was updated");
    }
    public function updateStatus(Request $request){
        if($request->ajax()){
            $data=$request->all();

            if($data['status']=="Active"){
                $status=0;
            }else{
                $status=1;
            }
            Banner::where('id',$data['banner_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'banner_id'=>$data['banner_id']]);
        }
    }
    public function destroy($id) {
        Banner::where('id',$id)->delete();
        return redirect()->route('adminBanner')->with('danger','This banner has been deleted!');
    }
}
