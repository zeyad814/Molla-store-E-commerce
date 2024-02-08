<?php

namespace App\Http\Controllers\admin;

use Session;
use App\Models\Brand;
use App\Models\Product;
use App\Models\AdminRole;
use Illuminate\Http\Request;
use App\Traits\GeneralTraits;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\createBrandRequest;

class adminBrandController extends Controller
{
    use GeneralTraits;

    public function index(request $request){
        Session::put('page','brand');
        
        $brands=Brand::paginate(5);
        if(!empty($request->get('search'))){
            $brands=Brand::where('brand_name','like',"%".$request->get('search')."%")->paginate(5);
        }
        // roles
        $cmsPagesModuleCount=AdminRole::where(['subadmin_id'=>Auth::guard('admin')->user()->id,'module'=>'brands'])->count();
        $pageModule=array();
        if(Auth::guard('admin')->user()->type=="2"){
            $pageModule['view_access']="on";
            $pageModule['edit_access']="on";
            $pageModule['full_access']="on";
        }elseif($cmsPagesModuleCount==0){
            $message="this feature is restricted for you!";
            return redirect()->route("adminHome")->with('error',$message);
        }else{
            $pageModule = AdminRole::where(['subadmin_id'=>Auth::guard('admin')->user()->id,'module'=>'brands'])->first()->toArray();
        }
        //-------------------------------------------------------------------------------
        return view('admin.pages.brands.index',compact('brands','pageModule'));
    }

    public function create(){
        Session::put('page','brand');
        return view('admin.pages.brands.create');
    }
    public function submitCreate(createBrandRequest $request){

        $data=$request->validated();

        if(isset($data['brand_image'])){
            $img=request()->file('brand_image');
            $image_ext =$img->getClientOriginalExtension();
            $imageName=time()+1 .'.'.$image_ext;
            $image_file=$img->move(public_path('admin/assets/img'),$imageName);
            $data['brand_image']= $imageName;
        }
        if(isset($data['brand_logo'])){
            $logo=request()->file('brand_logo');
            $logo_ext =$logo->getClientOriginalExtension();
            $logoName=time().'.'.$logo_ext;
            $logo_file=$logo->move(public_path('admin/assets/img'),$logoName);
            $data['brand_logo']=$logoName;
        }

        Brand::create($data);
        return redirect()->route('adminBrand')->with('success',"The Brand was created");
    }
    public function edit($id){
        Session::put('page','brand');
        $brand=Brand::findOrFail($id);
        return view('admin.pages.brands.edit',compact('brand'));
    }
    public function update(createBrandRequest $request,$id){
        $brand=Brand::find($id);
        $data=$request->validated();

        // brand image
        if(isset($data['brand_image'])){
            if($brand->brand_image==true){
             if (file_exists(public_path("admin\assets\img\\".$brand->brand_image))) {
                    unlink(public_path("admin\assets\img\\".$brand->brand_image));
             }
            }
            $img=request()->file('brand_image');
            $image_ext =$img->getClientOriginalExtension();
            $imageName=time().'.'.$image_ext;
            $image_file=$img->move(public_path('admin/assets/img'),$imageName);
            $data['brand_image']= $imageName;

        }
        // brand logo
        if($request->file('brand_logo')){
                if($brand->brand_logo==true){
                if (file_exists(public_path("admin\assets\img\\". $brand->brand_logo))) {
                    unlink(public_path("admin\assets\img\\". $brand->brand_logo));
                }
                }
                $logo=request()->file('brand_logo');
                $logo_ext =$logo->getClientOriginalExtension();
                $logoName=time() + "1" .'.'.$logo_ext;
                $logo_file=$logo->move(public_path('admin/assets/img'),$logoName);
                $data['brand_logo']=$logoName;
        }
        // update discount
        if($data['brand_discount']){
            Product::where('brand_id',$id)->update(['product_discount'=>$data['brand_discount']]);
        }

        Brand::where('id',$id)->update($data);
        return redirect()->route('adminBrand')->with('success',"The Brand was created");
    }
    public function destroyImage($id){
            $brandImage=Brand::find($id);
            if(file_exists(public_path("admin/assets/img/$brandImage->brand_image"))){
                unlink(public_path("admin/assets/img/$brandImage->brand_image"));
            }
            Brand::where('id',$id)->update(['brand_image'=>""]);
            return redirect()->back()->with('error',"The Brand Image was deleted");
    }
    public function destroyLogo($id){
            $brandLogo=Brand::find($id);
            if(file_exists(public_path("admin/assets/img/$brandLogo->brand_logo"))){
                unlink(public_path("admin/assets/img/$brandLogo->brand_logo"));
            }
            Brand::where('id',$id)->update(['brand_logo'=>""]);
            return redirect()->back()->with('error',"The Brand logo was deleted");
    }
    public function destroy($id){
        Brand::where('id',$id)->delete();
        return redirect()->back()->with('error',"The Brand was deleted");
    }
    public function updateStatus(Request $request){
        if($request->ajax()){
            $data=$request->all();

            if($data['status']=="Active"){
                $status=0;
            }else{
                $status=1;
            }
            Brand::where('id',$data['brand_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'brand_id'=>$data['brand_id']]);
        }
    }

}
