@extends('admin.layouts.auth')
@section('title','Coupons')
@section('adminContent')
<main id="main" class="main">
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Order: #{{ $order->id }}</h1>
            </div>
            <div class="col-sm-6 text-right">
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header pt-3">
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                            <h1 class="h5 mb-3">Shipping Address</h1>
                            <address>
                                <strong>{{ $order->first_name." ".$order->last_name }}</strong><br>
                                {{ $order->address }}<br>
                                {{ $order->town }},{{ $order->state }},{{ $order->postal_code }}<br>
                                Phone: (+20) {{ $order->phone }}<br>
                                Email: {{ $order->email }}
                            </address>
                            </div>



                            <div class="col-sm-4 invoice-col">
                                <b>Invoice #007612</b><br>
                                <br>
                                <b>Order ID:</b> {{ $order->id }}<br>
                                <b>Total:</b> ${{ $order->total }}<br>
                                <b>Status:</b>
                                @if($order->status=="delivered")
                                <span class="text-success">Delivered</span>
                                @elseif($order->status=="pending")
                                <span class="text-warning">Pending</span>
                                @elseif($order->status=="rejected")
                                <span class="text-danger">Rejected</span>
                                @endif
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-3">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th width="100">Price</th>
                                    <th width="100">Qty</th>
                                    <th width="100">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->product->product_name }}</td>
                                    <td>${{ $product->product->final_price }}</td>
                                    <td>{{ $product->product_qty }}</td>
                                    <td>${{ $product->product->final_price*$product->product_qty }}</td>
                                </tr>
                                @endforeach


                                <tr>
                                    <th colspan="3" class="text-right">Subtotal:</th>
                                    <td>${{ $order->total }}</td>
                                </tr>

                                <tr>
                                    <th colspan="3" class="text-right">Shipping:</th>
                                    <td>$0</td>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-right">Grand Total:</th>
                                    <td>${{ $order->total }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Order Status</h5>
                        <div class="mb-3">
                            <form action="{{ route('submit.update.order',$order->id) }}">
                            <select name="status" id="status" class="form-select">
                                        @if($order->status=="Pending")
                                        @php $Pending="selected" @endphp
                                        @else
                                        @php $Pending="" @endphp
                                        @endif
                                        @if($order->status=="delivered")
                                        @php $delivered="selected" @endphp
                                        @else
                                        @php $delivered="" @endphp
                                        @endif
                                        @if($order->status=="rejected")
                                        @php $rejected="selected" @endphp
                                        @else
                                        @php $rejected="" @endphp
                                        @endif
                                <option {{ $Pending }} value="Pending">Pending</option>
                                <option {{ $delivered }} value="delivered">Delivered</option>
                                <option {{ $rejected }} value="rejected">Cancelled</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
</div>
</main>

@endsection
