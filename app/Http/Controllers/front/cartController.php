<?php

namespace App\Http\Controllers\front;

use Auth;
use Session;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\DiscountCoupon;
use App\Models\UserInformation;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Requests\cartRequest;
use App\Http\Requests\submitCouponRequest;
use App\Http\Requests\updateCartRequest;
use Illuminate\Support\Carbon;
use App\Http\Requests\checkoutRequest;
use App\Http\Controllers\Controller;

class cartController extends Controller
{
    public function store(cartRequest $request,$id){
        $data=$request->validated();
        $product = Product::find($id);
        if (Auth::check()) {
            $data['user_id']= Auth::user()->id;
            $data['product_id']=$product->id;
            $data['price']=$product->final_price;
            if($product->stock==0){
                return redirect()->back()->with(['danger'=>'Out of Stock!']);
            }
            if(Cart::where(['product_id'=>$data['product_id'],'user_id'=>Auth::user()->id])->exists()){
                return redirect()->back()->with(['danger'=>'the product already added to cart']);
            }
            cart::create($data);
            return redirect()->back()->with('success','the product was added to cart successfully');
        }else{
            // $cart[$id]=[
            //     'name' =>$product->product_name,
            //     'price' =>$product->final_price,
            //     'product_qty'=>$data["product_qty"],
            //     'image'=>$product->main_image,
            // ];
            // session()->put('cart',$cart);
            // return redirect()->back()->with('success','the product was added to cart successfully');
            return redirect()->route('login')->with(['danger'=>'you must login to add product in your cart!']);
        }



    }
    public function index(){
        $categories=Category::where('status',1)->get();
        if (!Auth::check()) {
            // return view('front.pages.cart.index',compact('categories'));
            return redirect()->route('login')->with(['danger'=>'login to enter!']);
        }else{
            $totalPrice= 0;
            $cartContent=Cart::where('user_id',Auth::user()->id)->paginate(4);
            foreach($cartContent as $item){
                $subTotal= $item->price * $item->product_qty;
                $totalPrice += $subTotal;
            }
            return view('front.pages.cart.index',compact('categories','cartContent','totalPrice'));
        }
    }
    public function update(updateCartRequest $request,$id){
        $data=$request->validated();
        dd($data);
    }
    public function destroy($id){
        Cart::destroy($id);
        return redirect()->back()->with('success','The item has been removed from your cart');
    }
    public function checkout(){
        $categories=Category::where('status',1)->get();
        $totalPrice= 0;
        $discount=0;
        if(Cart::where('user_id',Auth::user()->id)->exists()){
            $cartContent=Cart::where('user_id',Auth::user()->id)->get();

            foreach($cartContent as $item){
                if($item->product->stock==0){
                    return back()->with('error','some products are not available.');
                }
            }

            foreach($cartContent as $item){
                $subTotal= $item->price * $item->product_qty;
                $totalPrice += $subTotal;
            }
            if(session()->has('code')){
                $code=session()->get('code');
                if($code->type=='percent'){
                    $totalPrice=$totalPrice-(($code->discount_amount/100)*$totalPrice);
                }else{
                    $totalPrice=$totalPrice-$code->discount_amount;
                }
                $discount=$code->discount_amount;
            }
        }
        // else{
        //     if(!session()->has('url.intended')){
        //         session(['url.intended'=>url()->current()]);
        //     }
        //     return redirect()->back()->with('warning','Your cart is empty, please add some products');
        // }

        return view('front.pages.checkout.index',compact('categories','cartContent','totalPrice','discount'));
    }
    public function submitCheckout(checkoutRequest $request){
        $data=$request->validated();
        //// save customer information
        UserInformation::updateOrCreate(
            [
                'user_id'=>Auth::user()->id,
                'first_name'=>$data['first_name'],
                'last_name'=>$data['last_name'],
                'address'=>$data['address'],
                'phone'=>$data['phone'],
                'town'=>$data['town'],
                'state'=>$data['state'],
                'postal_code'=>$data['postal_code'],
                'email'=>$data['email'],
            ]
        );
        // save data of order
        $total=0;
        $discount=0;
        $coupon_code='';

        $cartContent=Cart::where('user_id',Auth::user()->id)->get();
            foreach($cartContent as $item){
                $subTotal= $item->price * $item->product_qty;
                $total += $subTotal;
            }
            if(session()->has('code')){
                $code=session()->get('code');
                if($code->type=='percent'){
                    $total=$total-(($code->discount_amount/100)*$total);
                }else{
                    $total=$total-$code->discount_amount;
                }
                $discount=$code->discount_amount;
                $coupon_code=$code->code;
                DiscountCoupon::where('id',$code->id)->decrement('max_uses');
            }
        $order=Order::create(
            [
                'user_id'=>Auth::user()->id,
                'total'=>$total,
                'discount'=>$discount,
                'coupon_code'=>$coupon_code,
                'first_name'=>$data['first_name'],
                'last_name'=>$data['last_name'],
                'address'=>$data['address'],
                'phone'=>$data['phone'],
                'town'=>$data['town'],
                'state'=>$data['state'],
                'postal_code'=>$data['postal_code'],
                'email'=>$data['email'],
                'notes'=>$data['notes'],
                'status'=>'pending',
            ]
            );

            Session::forget('code');
        //save product in the order details table
        foreach($cartContent as $product){
            OrderProduct::create([
                'product_id'=> $product->product->id,
                'order_id'=>$order->id,
                'name'=>$product->product->product_name,
                'product_qty'=>$product->product_qty,
                'price'=>$product->price,
                'total'=>$product->price*$product->product_qty,
            ]);
            Product::where('id',$product->product->id)->update(['stock'=>$product->product->stock-$product->product_qty]);
        }

        // send order email
        // OrderEmail($order->id);

        //delete from cart after add to order
        Cart::where('user_id',Auth::user()->id)->delete();
        return redirect()->route('thankyou');
    }
    public function thankyou(){
        $categories=Category::where('status',1)->get();
        return view('front.pages.checkout.thankyou',compact('categories'));
    }
    public function myHistory(){
        $categories=Category::where('status',1)->get();
        $orders = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(8);
        return view('front.pages.orders.history',compact('orders','categories'));
    }
    public function orderDetails($id){
        $categories=Category::where('status',1)->get();
        $order = Order::find($id);
        $products = OrderProduct::where('order_id',$id)->get();
        return view('front.pages.orders.details',compact('order','categories','products'));
    }
    public function submitCoupon(submitCouponRequest $request){
        $data=$request->validated();
        $code=DiscountCoupon::where('code',$data['code'])->first();
        $now=Carbon::now();
        if($code->starts_at != ""){
            $startDate=Carbon::createFromFormat('Y-m-d',$code->starts_at);
            if($now->lte($startDate)){
                return redirect()->back()->with('danger','this coupon is not available');
            }
        }
        if($code->expires != ""){
            $endDate=Carbon::createFromFormat('Y-m-d',$code->expires_at);
            if($now->gt($endDate)){
                return redirect()->back()->with('warning','this coupon is not available');
            }
        }
        if($code->max_uses<=0){
            return redirect()->back()->with('warning','This Coupon has been used up!');
        }
        Session::put('code',$code);
        return redirect()->back()->with('success','the Coupon was successfully applied!');
    }
    public function incrementQuantity($id){
        Cart::where('id', $id)->increment('product_qty');
        if(Cart::where('id',$id)->value('product_qty')==0){
            Cart::where('id', $id)->delete();
        }
        return back()->with('success','the cart was successfully updated!');
    }
    public function decrementQuantity($id){
        Cart::where('id', $id)->decrement('product_qty');
        if(Cart::where('id',$id)->value('product_qty')==0){
            Cart::where('id', $id)->delete();
        }
        return back()->with('success','the cart was successfully updated!');
    }
}
