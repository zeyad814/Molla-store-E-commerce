<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class profileController extends Controller
{
    public function index(){
        return view('front/pages/profile/index');
    }
}
