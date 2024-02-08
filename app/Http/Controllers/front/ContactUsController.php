<?php

namespace App\Http\Controllers\front;

use App\Models\Category;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\createContacUsRequest;
use Session;

class ContactUsController extends Controller
{
    public function create(){
        Session::put('page','contacts');
        $categories=Category::where('status',1)->get();
        return view('front.pages.contact_us.index',compact('categories'));
    }
    public function store(createContacUsRequest $request){
        $data=$request->validated();
        ContactUs::create($data);
        session()->flash('success','Your message has been sent successfully');
        return redirect()->route('home');
        return view('front.pages.contact_us.index',compact('categories'));
    }
    Public function index(){
        Session::put('page','contact');
        $data = ContactUs::orderBy('created_at','desc')->paginate();
        return view('admin.pages.contacts.index',compact('data'));
    }
    public function destroy($id){
        ContactUs::where('id',$id)->delete();
        return redirect()->back();
    }
}
