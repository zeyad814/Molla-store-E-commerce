<?php
use App\Models\Cart;
use App\Models\Brand;
use App\Models\Order;
use App\Models\CMSPage;
use App\Mail\OrderEmail;
use App\Models\Wishlist;
use App\Models\ProductRate;
use App\Models\OrderProduct;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

        function formatDate($dateString, $format = 'Y-m-d'): string
        {
            return Carbon::parse($dateString)->format($format);
        }
        function orderEmail($orderId){
            $order = Order::find($orderId);
            $products =OrderProduct::where('order_id',$orderId)->get();
            $mailData= [
            'subject'=>'Thanks for your order',
            'order'=> $order,
            'products'=>$products,
            ];
            Mail::to($order->email)->send(new OrderEmail($mailData));

        }
        function getPercentRating($id){
            $productRate=ProductRate::where('status',1)->where('product_id',$id)->sum('rating');
            $countRates=ProductRate::where('product_id',$id)->count();
            if($countRates==0){
                $countRates =1;
            }
            $PercentRate=($productRate/$countRates) * 20;
            return $PercentRate;
        }
        function getCountRating($id){
            $countRates=ProductRate::where('status',1)->where('product_id',$id)->count();
            return $countRates;
        }
        function getCountWishlist(){
            if(Auth::check()==true){
            return Wishlist::where('user_id',Auth::user()->id)->count();
            }
            else{
                return 0;
            }
        }
        function getCountCart(){
            if(Auth::check()==true){
            return Cart::where('user_id',Auth::user()->id)->count();
            }else{
                return 0;
            }
        }
        function getCmsPages(){
            return CMSPage::get()->all();
        }
        function getBrands(){
            return Brand::paginate(6);
        }

