<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Auth;
use Session;

class wishlistController extends Controller
{
    public function index(){
        Session::put('page','shop');
        if(Auth::check()==false){
            return redirect()->route('login');
        }
        $wishlists = Wishlist::where('user_id',Auth::user()->id)->paginate(5);
        $categories=Category::where('status',1)->get();
        return view('front.pages.wishlists.index',compact('wishlists','categories'));
    }
    public function addToWishlist(request $request){


        if(Auth::check()==false){

            session(['url.intended'=> url()->previous()]);
            return response()->json([
                'status'=>false
            ]);

        }

        Wishlist::updateOrCreate(
            [
            'user_id'=>Auth::user()->id,
            'product_id'=>$request->id
            ],
            [
            'user_id'=>Auth::user()->id,
            'product_id'=>$request->id
            ]
        );
        // $wishlist = new Wishlist;
        // $wishlist->user_id = Auth::user()->id;
        // $wishlist->product_id = $request->id;
        // $wishlist->save();

        $product = Product::where('id',$request->id)->first();
        $count = Wishlist::where('user_id',Auth::user()->id)->count();

        if($product == null){
            return response()->json([
                'status'=> true,
                'message'=>'<div class="alert alert-danger">product not found.</div>'
            ]);
        }

        return response()->json([
            'status'=> true,
            'message'=>'<div class="alert alert-success"><strong>"'.$product->product_name.'"</strong> added in your wishlist.</div>',
            'count'=> $count
        ]);
    }
    public function destroy($id){
        Wishlist::where('product_id',$id)->delete();
        return redirect()->back()->with('danger','the product was deleted form the Wishlist.');
    }
}
