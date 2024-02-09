<?php

namespace App\Http\Controllers\front;

use Session;
use App\Models\Brand;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductRate;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $bestSelling=Product::where('is_bestseller',1)->paginate(5);
        // $topRated=ProductRate::groupBy('product_id')->sum('rating')->orderBy('rating','desc')->get();
        $topRating = ProductRate::groupBy('product_id')
        ->select('product_id')
        ->orderByRaw('sum(rating) desc')
        ->get();
        // dd($topRating);
        return view('front/pages/home/index',compact('sliders','categories','newProducts','discounts','recommendations','bestSelling','topRating'));
    }
}
