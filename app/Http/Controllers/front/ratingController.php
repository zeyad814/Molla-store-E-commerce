<?php

namespace App\Http\Controllers\front;

use Session;
use App\Models\AdminRole;
use App\Models\ProductRate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\createRatingRequest;
use Auth;
class ratingController extends Controller
{
    public function store(createRatingRequest $request){
        $data=$request->validated();
        $count = ProductRate::where('email',$data['email'])->count();
        if($count > 0){
            return redirect()->back()->with('error','this account is already rete.');
        }
        ProductRate::create($data);
        return redirect()->back()->with('success','Thank you for rating.');
    }
    public function index(request $request){
        Session::put('page','rating');

        $ratings=ProductRate::orderBy('created_at','desc')->paginate(12);

        // roles accesses
        $cmsPagesModuleCount=AdminRole::where(['subadmin_id'=>Auth::guard('admin')->user()->id,'module'=>'ratings'])->count();
        $pageModule=array();
        if(Auth::guard('admin')->user()->type=="2"){
            $pageModule['view_access']="on";
            $pageModule['edit_access']="on";
            $pageModule['full_access']="on";
        }elseif($cmsPagesModuleCount==0){
            $message="this feature is restricted for you!";
            return redirect()->route("adminHome")->with('error',$message);
        }else{
            $pageModule = AdminRole::where(['subadmin_id'=>Auth::guard('admin')->user()->id,'module'=>'ratings'])->first()->toArray();
        }
        //----------------------------------------------

        return view('admin.pages.rating.index',compact('ratings','pageModule'));
    }
    public function updateStatus(Request $request,$id){
        $rating=ProductRate::findOrFail($id);
        $data=$request->all();
        if($rating->status==0){
            $rating->update(['status'=>1]);
        }else{
            $rating->update(['status'=>0]);
        }
        return redirect()->back()->with('success','the status updated successfully.');
    }
}
