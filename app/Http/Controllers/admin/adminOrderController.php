<?php

namespace App\Http\Controllers\admin;

use Dompdf\Dompdf;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Traits\GeneralTraits;
use App\Http\Controllers\Controller;
use Session;

class adminOrderController extends Controller
{
    use GeneralTraits;
    public function index(){
        Session::put('page', 'order');
        $orders = Order::latest()->paginate(8);
        return view('admin.pages.orders.index',compact('orders'));
    }
    public function update($id){
        Session::put('page', 'order');
        $order = Order::find($id);
        $products = OrderProduct::where('order_id',$id)->get();
        return view('admin.pages.orders.update',compact('order','products'));
    }
    public function submitUpdate(request $request,$id){
        $data=$request->all();
        if($data['status']=='delivered'){
            OrderEmail($id);
        }
        Order::where('id',$id)->update($data);
        return redirect()->back()->with('success','the Status has been updated');
    }
    public function printPdf($id){

        $order = Order::find($id);
        $products = OrderProduct::where('order_id',$id)->get();

        $domPdf= new Dompdf();
        $domPdf->loadHtml($this->getPdfContent($order,$products));
        // $domPdf->loadHtml($content);
        $domPdf->setPaper('A4','landscape');
        $domPdf->render();
        $domPdf->stream();
    }
}
