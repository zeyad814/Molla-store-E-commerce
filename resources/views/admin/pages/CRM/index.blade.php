@extends('admin.layouts.auth')
@section('title','Coupons')
@section('adminContent')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>CRM</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">CRM</li>
          <li class="breadcrumb-item active">index</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">

        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Customer Relationship Management</h5>

                <table class="table table-bordered">
                        <br>

                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">NAME</th>
                        <th scope="col">EMAIL</th>
                        <th scope="col">TOTAL ORDERS</th>
                        <th scope="col">TOTAL  REVENUE </th>
                        <th scope="col">SEND COUPON</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->user->name }}</td>
                            <td>{{ $user->user->email }}</td>
                            <td>{{ $user->order_count }}</td>
                            <td>{{ $user->total }}</td>
                            <td>
                                {{-- @if($pageModule['full_access']=="on") --}}
                                <h4><a class="btn btn-primary" data-bs-toggle="modal" title="SEND MAIL" data-bs-target="#exampleModal" ><i class="bi bi-envelope-fill"></i></a></h4>
                                {{-- @endif --}}
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Send Code</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('cms.send.coupon',$user->user->id) }}" method="POST">@csrf
                                        <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Coupon Code:</label>
                                        <input type="text" class="form-control" name="coupon_code" id="recipient-name">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Send Coupon</button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                            </div>
                        </div>
                        @empty
                        <h1>we dont have content to show</h1>
                        @endforelse
                    </tbody>
                </table>
            </div>
            </div>
          </div>



        </div>
      </div>
    </section>

  </main><!-- End #main -->

@endsection
