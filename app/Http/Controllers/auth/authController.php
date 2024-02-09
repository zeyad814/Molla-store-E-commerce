<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use App\Models\Order;
use App\Models\DiscountCoupon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\registerRequest;
use Illuminate\Support\Facades\Validator;
use App\Mail\restPassword;
use App\Mail\coupon;
use Session;

class authController extends Controller
{
    public function login(){
        return view('auth/login');
    }
    public function register(){
        return view('auth/register');
    }
    public function submitRegister(registerRequest $request){
        $data=$request->validated();
        User::create($data);
        toastr()->success('Data has been created successfully!');
        return redirect()->route('login');

    }
    public function submitLogin(Request $request){
        $data=$request->all();
        // dd($data);
        $credentials = $request->validate([
            'email' => "required|email",
            'password' => "required|min:5|max:255",
        ]);
        if(auth::guard('web')->attempt($credentials))
        {
            if(isset($data['remember'])&&!empty($data['remember'])){
                setcookie('frontEmail',$data['email'],time()+3600);
                setcookie('frontPassword',$data['password'],time()+3600);
            }else{
                setcookie('frontEmail',"");
                setcookie('frontPassword',"");
            }
            //redirect previous page
            // if(session()->has('url.intended')){
            //     return redirect(session()->get('url.intended'));
            // }


         return redirect()->route('home');
        }
        elseif(auth::guard('admin')->attempt($credentials))
        {
         return redirect()->route('adminHome');
        }
        return back()->withErrors([
        'password' => 'The email or password is incorrect.',
    ]);

    }
    public function logout(){
        Auth::logout();
        return redirect()->route('home');
    }
    public function forgotPassword(){
        return view('auth.forgot_password');
    }
    public function submitForgotPassword(request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|exists:users,email'
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
//--------------------------------------------------------
        $token=Str::random(64);
        \DB::table('password_reset_tokens')->insert([
            'email'=> $request->email,
            'token'=> $token,
            'created_at'=> now()
        ]);
//--------------------------------------------------------
        $user=User::where('email',$request->email)->first();
        $formData =[
            'email' => $user,
            'subject'=>'please click here to reset your password',
            'token'=>$token
        ];
        Mail::to($request->email)->send(new restPassword($formData));
        session()->flash('message','please check your account');
        return back();
    }
    public function resetPassword($id){
        $user=user::find($id);
        return view('auth.reset_password',compact('user'));
    }
    public function SubmitResetPassword(request $request,$id){
        $data=$request->all();
        $user=user::find($id);
        $request->validate([
            'password' => "required|max:255|min:8|confirmed",
        ]);
        user::where('id',$id)->update(['password'=>bcrypt($data['password'])]);
        //delete the token from table
        \DB::table('password_reset_tokens')
          ->where('email','=',$user->email)
          ->delete();
          return redirect()->route('login')->with('success','password is reset successfully');
    }
    public function index(){
        Session::put('page','crm');
            $users = Order::groupBy('user_id')
                    ->select('user_id', \DB::raw('sum(total) as total'), \DB::raw('count(*) as order_count'))
                    ->orderBy('total', 'desc')
                    ->paginate(10);
        return view('admin.pages.CRM.index',compact('users'));
    }
    public function send(request $request,$id){
        $user=User::find($id);
        $data = $request->all();
        $coupon = DiscountCoupon::where('code',$data['coupon_code'])->get()->first();
        if(empty($coupon)){
            return redirect()->back()->with('error','this code DOES NOT exist!');
        }
        $formData = [
            'user' => $user,
            'subject'=>'Congratulation you have Promotion Code',
            'coupon_code'=>$data['coupon_code'],
            'coupon_data'=> $coupon
        ];
        Mail::to($user->email)->send(new coupon($formData));
        return redirect()->back()->with('success','Successfully Send Coupon to User');
    }

}
