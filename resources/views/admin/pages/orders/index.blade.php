@extends('admin.layouts.auth')
@section('title','Coupons')
@section('adminContent')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>ORDERS</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Order</li>
          <li class="breadcrumb-item active">index</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">

        <div class="col-lg-12">
          <div class="card">
            <form action="{{ route('adminBrand') }}" method="get">
                <div class="card-header">
                    <div class="card-tools">
                        <div class="input-group input-group" style="width: 250px;">
                            <input type="search" name="search" vlaue="{{ Request::get('search') }}" class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                              <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                              </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="card-body">
              <h5 class="card-title">Orders Table</h5>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">Order ID</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Email</th>
                        <th scope="col">phone</th>
                        <th scope="col">Status</th>
                        <th scope="col">Date Purchased</th>
                        <th scope="col">Total</th>
                        <th scope="col">PDF</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                        <tr>
                            <th scope="row">
                                <a href="{{ route('admin.order.update',$order->id) }}">
                                {{ $order->id }}
                                </a>
                            </th>
                            <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                            <td>{{ $order->email }}</td>
                            <td>{{ $order->phone }}</td>
                            <td>
                                 @if($order->status=="delivered")
                                                <span class="badge bg-success">Delivered</span>
                                                @endif
                                                @if($order->status=="rejected")
                                                <span class="badge bg-danger">Rejected</span>
                                                @endif
                                                @if($order->status=="pending")
                                                <span class="badge bg-warning">Pending</span>
                                                @endif
                            </td>
                            <td>{{\Carbon\Carbon::parse($order->created_at)->format('d M, Y') }}</td>
                            <td class="total-col">${{ $order->total }}</td>
                            <td>
                                <a href="{{ route('print.pdf',$order->id) }}" title="PDF" ><h5><i class="bi bi-file-earmark-pdf-fill"></i></h5></a>
                            </td>
                        </tr>
                        @empty
                        <h1>we dont have coupons</h1>
                        @endforelse
                    </tbody>
                </table>
                {{ $orders->links() }}
            </div>
            </div>
          </div>



        </div>
      </div>
    </section>

  </main><!-- End #main -->

@endsection

