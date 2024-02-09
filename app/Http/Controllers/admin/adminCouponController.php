<?php

namespace App\Http\Controllers\admin;

use Session;
use App\Models\AdminRole;
use Illuminate\Http\Request;
use App\Models\DiscountCoupon;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Requests\couponRequest;
use App\Http\Requests\updateCouponRequest;
use Auth;

class adminCouponController extends Controller
{
    public function index(request $request){
        Session::put('page','coupon');

        $coupons=DiscountCoupon::paginate(8);
        if(!empty($request->get('search'))){
            $categories=DiscountCoupon::where('name','like',"%".$request->get('search')."%")->paginate(10);
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
            $pageModule = AdminRole::where(['subadmin_id'=>Auth::guard('admin')->user()->id,'module'=>'coupons'])->first()->toArray();
        }
        //----------------------------------------------------------------
        return view('admin.pages.coupons.index',compact('coupons','pageModule'));
    }

    public function create(){

        Session::put('page','coupon');
        return view('admin.pages.coupons.create');
    }

    public function store(couponRequest $request){

        $data=$request->validated();
        if(!empty($data['starts_at'])){
            $now= Carbon::now();
            $start_at = Carbon::createFromFormat('Y-m-d',$data['starts_at']);
            if($start_at->lte($now)){
                return redirect()->back()->withErrors(['starts_at' => 'un available date']);
            }
        }
        if(!empty($data['expires_at'])){
            $now= Carbon::now();
            $expires_at = Carbon::createFromFormat('Y-m-d',$data['expires_at']);
            if($expires_at->lte($now)){
                return redirect()->back()->withErrors(['expires_at' => 'un available date']);
            }
        }
        DiscountCoupon::create($data);
        return redirect()->route('coupon.index')->with('success','the coupon has been created successfully');
    }
    public function edit($id){
        Session::put('page','coupon');
        $coupon=DiscountCoupon::find($id);
        return view('admin.pages.coupons.edit',compact('coupon'));
    }

    public function update(updateCouponRequest $request,$id){
        $coupon= DiscountCoupon::find($id);
        $data=$request->validated();
        // if(!empty($data['starts_at'])){
        //     $now= Carbon::now();
        //     $start_at = Carbon::createFromFormat('Y-m-d',$data['starts_at']);
        //     if($start_at->lte($now)){
        //         return redirect()->back()->withErrors(['starts_at' => 'un available date']);
        //     }
        // }
        if(!empty($data['expires_at'])){
            $now= Carbon::now();
            $start_at = Carbon::createFromFormat('Y-m-d',$data['starts_at']);
            $expires_at = Carbon::createFromFormat('Y-m-d',$data['expires_at']);
            if($expires_at->lte($now)){
                return redirect()->back()->withErrors(['expires_at' => 'un available date']);
            }
            if($expires_at->lte($start_at)){
                return redirect()->back()->withErrors(['expires_at' => 'un available date'],['starts_at' => 'un available date']);
            }
        }
        $coupon->update($data);
        return redirect()->route('coupon.index')->with('success','the coupon has been updated successfully');
    }
    public function destroy($id){
        DiscountCoupon::destroy($id);
        return redirect()->back()->with('danger','the coupon has been deleted successfully');
    }

}
