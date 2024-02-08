<?php

namespace App\Http\Controllers\front;

use App\Models\Product;
use App\Models\ProductRate;

use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class frontProductController extends Controller
{
    public function index(request $request,$id=null){
        Session::put('page','shop');
        $categories=Category::where('status',1)->get();
        $brandsArray=[];
        $priceMax=1000;
            $priceMin=0;
            $sort="";

        $products=Product::where('status',1);


        if(isset($id)){
        $products=$products->where('category_id',$id);
        }

        if(!empty($request->get('brand'))){
            $brandsArray = explode(',',$request->get('brand'));
            $products = $products->whereIn('brand_id',$brandsArray);
        }


        if($request->get('price_min')!='' && $request->get('price_max')!=''){
            if($request->get('price_max')==1000){
                $products =  $products->whereBetween('final_price',[$request->get('price_min'),100000]);
                $priceMax=1000;
                $priceMin=$request->get('price_min');
            }else{
            $products =  $products->whereBetween('final_price',[$request->get('price_min'),$request->get('price_max')]);
            $priceMax=$request->get('price_max');
            $priceMin=$request->get('price_min');
            }
        }

        if(!empty($request->get('search'))){
            $products = $products->where('product_name','like',"%".$request->get('search')."%");
        }


        if($request->get('sort')){
            if($request->get('sort')=="latest"){
                $products = $products->orderBy('created_at','desc');
                $sort="latest";
            }elseif($request->get('sort')=="price_desc"){
                $products = $products->orderBy('final_price','desc');
                $sort="price_desc";
            }elseif ($request->get('sort')=="price_asc") {
                $products = $products->orderBy('final_price','asc');
                $sort="price_asc";
            }
        }

        $products = $products->paginate(8)->appends($request->all());
        $brands=Brand::orderBy('created_at','desc')->get();
        return view('front.pages.products.index',compact('categories','products','brands','brandsArray','priceMax','priceMin','sort'));
    }




    public function show($id){
        Session::put('page','shop');
        // $product=Product::where('id',$id)->where('status',1)->withCount('product_rates')->withSum('product_rates','rating');
        $categories=Category::where('status',1)->get();
        $product=Product::where('status',1)->findOrFail($id);

        $count=ProductRate::where('status',1)->where('product_id',$id)->count();
        // dd($productRate);
        $productReview=ProductRate::where('status',1)->where('product_id',$id)->paginate(3);
        $relatedProducts=Product::where('category_id',$product->category_id)->paginate(6);
        return view('front.pages.products.show',compact('product','categories','relatedProducts','productReview','count'));
    }

}
