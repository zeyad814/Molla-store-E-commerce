<?php

namespace App\Http\Controllers\admin;
use App\Traits\GeneralTraits;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\AdminRole;
use Auth;
use Session;
use App\Http\Requests\createCtegoryRequest;

class adminCategoryController extends Controller
{
    use GeneralTraits;





    public function index(request $request){
        Session::put('page','category');
        $categories=Category::paginate(10);
        // search
        if(!empty($request->get('search'))){
            $categories=Category::where('category_name','like',"%".$request->get('search')."%")->paginate(10);
        }
        //roles
        $cmsPagesModuleCount=AdminRole::where(['subadmin_id'=>Auth::guard('admin')->user()->id,'module'=>'categories'])->count();
        $categoriesModule=array();
        if(Auth::guard('admin')->user()->type=="2"){
            $categoriesModule['view_access']="on";
            $categoriesModule['edit_access']="on";
            $categoriesModule['full_access']="on";
        }elseif($cmsPagesModuleCount==0){
            $message="this feature is restricted for you!";
            return redirect()->route("adminHome")->with('error',$message);
        }else{
            $categoriesModule = AdminRole::where(['subadmin_id'=>Auth::guard('admin')->user()->id,'module'=>'categories'])->first()->toArray();
        }
        return view('admin.pages.categories.index',compact('categories','categoriesModule'));
    }

    public function create(){
        Session::put('page','category');
        return view('admin.pages.categories.create');
    }
    public function submitCreateCategory(createCtegoryRequest $request){

        $data=$request->validated();
        if(empty($data['category_discount'])){
            $data['category_discount']=0;
        }
        if(isset($data['category_image'])){
            $data['category_image']=GeneralTraits::uploadImageFile('category_image');
        }
        Category::create($data);
        return redirect()->route('adminCategory')->with('success',"The Category was created");


    }

    public function edit($id){
        Session::put('page','category');
        $category=Category::find($id);
        return view('admin.pages.categories.update',compact('category'));
    }
    public function update(createCtegoryRequest $request,$id){
        $category = Category::findOrFail($id);
            $data=$request->validated();


        if (isset($data['category_image'])) {
            if($category->category_image==true){
             if (file_exists(public_path("admin\assets\img\\" . $category->category_image))) {
                    unlink(public_path("admin\assets\img\\" . $category->category_image));
             }
            }
             $data['category_image']=GeneralTraits::uploadImageFile('category_image');
        }
        if($data['category_discount']){
            Product::where('category_id',$id)->update(['product_discount'=>$data['category_discount']]);
        }
            $category->update($data);
            return redirect()->route('adminCategory')->with("succes","the category has been updated");

    }

    public function destroy($id){
        Category::where('id',$id)->delete();
        return redirect()->route('adminCategory')->with('success',"The Category was deleted");
    }
    public function destroyImage($id){
        $categoryImage=Category::where('id',$id)->select('category_image')->first();
        if(file_exists(public_path("admin\assets\img\\" . $categoryImage->category_image))){
            unlink(public_path("admin\assets\img\\" . $categoryImage->category_image));
        }
        Category::where('id',$id)->update(['category_image'=>""]);
        return redirect()->back()->with('success',"The Category Image was deleted");
    }
    public function updateStatus(Request $request){
        if($request->ajax()){
            $data=$request->all();

            if($data['status']=="Active"){
                $status=0;
            }else{
                $status=1;
            }
            Category::where('id',$data['category_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'category_id'=>$data['category_id']]);
        }
    }
}
