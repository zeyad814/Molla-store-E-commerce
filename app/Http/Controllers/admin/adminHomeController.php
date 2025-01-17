<?php

namespace App\Http\Controllers\admin;

use Session;
use App\Models\User;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class adminHomeController extends Controller
{
    public function index(){
        session::put('page','index');
        $brands=Brand::get()->count();
        $products=Product::get()->count();
        $categories=Category::get()->count();
        $users=User::get()->count();
        $orders=Order::get()->count();
        $revenue = Order::where('status','delivered');
        $totalRevenue=$revenue->sum('total');
        $startOfMonth=Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        $subMonth=Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d H:i:s');
        $currentDate=Carbon::now()->format('Y-m-d H:i:s');
        $thisMonth=Order::where('status','delivered')
        ->whereDate('created_at','>=',$startOfMonth)
        ->whereDate('created_at','<=',$currentDate)
        ->sum('total');
        // $topSelling=OrderProduct::groupBy('product_id')->orderByRaw('sum(product_id) desc')->get();
        $topSelling = OrderProduct::groupBy('product_id')
                        ->select(\DB::raw('sum(total) as total'),'product_id', \DB::raw('count(*) as product_qty'))
                        ->orderByRaw('product_id')->orderBy('product_qty','desc')
                        ->paginate(5);
        $lastMonth=$revenue->whereBetween('created_at',[$subMonth,$startOfMonth])->sum('total');
        return view('admin/pages/home/index',compact('brands','products','categories','thisMonth','totalRevenue','lastMonth','orders','users','topSelling'));
    }
}
