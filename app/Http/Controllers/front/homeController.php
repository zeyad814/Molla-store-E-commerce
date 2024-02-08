<?php

namespace App\Http\Controllers\front;

use App\Models\Brand;
use App\Models\Banner;
use App\Models\Product;
use App\Models\OrderProduct;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class homeController extends Controller
{
    public function index(){
        Session::put('page','home');
        $sliders=Banner::where('type','slider')->where('status',1)->orderBy('sort', 'asc')->get();
        $categories=Category::where('status',1)->get();
        // $newProducts=Product::where('status',1)->where('is_featured','yes')orderBy('created_at','desc')->paginate(5);
        $newProducts=Product::where('status',1)->orderBy('created_at','desc')->paginate(5);
        $discounts=Product::where('status',1)->where('product_discount','>=',15)->orderBy('product_discount','desc')->paginate(5);
        $recommendations=OrderProduct::select('product_id')->distinct()->orderBy('product_id','desc')->paginate(4);
        return view('front/pages/home/index',compact('sliders','categories','newProducts','discounts','recommendations'));
    }
}
