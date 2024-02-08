<?php

namespace App\Http\Controllers\admin;

use Auth;
use Session;
use App\Models\CmsPage;
use App\Models\Category;
use App\Models\AdminRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\createCmsRequest;
use App\Http\Requests\updateCmsRequest;

class adminCmsController extends Controller
{
    public function index(request $request){
        Session::put('page','CMS');
        $data=CmsPage::paginate(10);
        // search
        if(!empty($request->get('search'))){
            $categories=CmsPage::where('title','like',"%".$request->get('search')."%")->paginate(10);
        }
        // roles
        $cmsPagesModuleCount=AdminRole::where(['subadmin_id'=>Auth::guard('admin')->user()->id,'module'=>'cms_pages'])->count();
        $pageModule=array();
        if(Auth::guard('admin')->user()->type=="2"){
            $pageModule['view_access']="on";
            $pageModule['edit_access']="on";
            $pageModule['full_access']="on";
        }elseif($cmsPagesModuleCount==0){
            $message="this feature is restricted for you!";
            return redirect()->route("adminHome")->with('error',$message);
        }else{
            $pageModule = AdminRole::where(['subadmin_id'=>Auth::guard('admin')->user()->id,'module'=>'cms_pages'])->first()->toArray();
        }
        return view('admin.pages.cms.index',compact('data','pageModule'));
    }
    public function updateCmsStatus(Request $request,CmsPage $id){
        $data = CmsPage::find($_GET['id']);
        if($data['status']==1){
            CmsPage::where('id',$data->id)->update(['status'=>0]) ;
        }elseif($data['status']==0){
            CmsPage::where('id',$data->id)->update(['status'=>1]) ;
        }
        return redirect()->back()->with('success',"The Status is Updated");

    }
    public function create(){
        Session::put('page','CMS');
        return view("admin.pages.cms.create");
    }
    public function submitCreate(createCmsRequest $request){
        $data = $request->validated();
        CmsPage::create($data);
        return redirect()->route('adminCms')->with('success',"the data created successfully");
    }
    public function update($id){
        Session::put('page','CMS');
        $data = CmsPage::findOrFail($id);
        return view("admin.pages.cms.update",compact('data'));
    }
    public function submitUpdate(updateCmsRequest $request,$id){
        $data = $request->validated();
        CmsPage::where('id',$id)->update($data);
        return redirect()->route('adminCms')->with('success',"the data Updated successfully");
    }
    public function deleteCms(request $request,$id) {
        CmsPage::where('id',$id)->delete();
         return redirect()->route('adminCms');
       }
    public function show($url){
        $categories=Category::where('status',1)->get();
        $page = CmsPage::where('url',$url)->get()->first();
        return view('front.pages.cms.show',compact('categories','page'));
    }

}
