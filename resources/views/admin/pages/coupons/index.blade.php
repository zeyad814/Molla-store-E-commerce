@extends('admin.layouts.auth')
@section('title','Coupons')
@section('adminContent')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>COUPONS</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">coupons</li>
          <li class="breadcrumb-item active">index</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">

        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
                <form action="{{ route('coupon.index') }}" method="get">
                    <div class="card-header">
                        <div class="card-tools">
                            <div class="input-group input-group" style="width: 250px;">
                              <input type="text" name="search" class="form-control" placeholder="Search Category..." value="{{ request()->query('search') }}">
                                <div class="input-group-append">
                                  <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                  </button>
                                  <a href="{{ route('coupon.index') }}" class="btn btn-default">
                                    <i class="fas fa-close"></i>
                                  </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
              <h5 class="card-title">Coupon Table</h5>

                <table class="table table-bordered">
                    @if($pageModule['full_access']=="on"||$pageModule['edit_access']=="on")
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('coupon.create') }}" class="btn btn-primary btn-lg active" data-mdb-ripple-init role="button" aria-pressed="true">Add Coupon</a>
                        </div>
                    @endif
                        <br>

                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">name</th>
                        <th scope="col">code</th>
                        <th scope="col">type</th>
                        <th scope="col">discount amount</th>
                        <th scope="col">starts_at</th>
                        <th scope="col">expires_at</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse ($coupons as $coupon)
                        <tr>
                            <th scope="row">{{ $coupon->id }}</th>
                            <td>{{ $coupon->name }}</td>
                            <td>{{ $coupon->code }}</td>
                            <td>{{ $coupon->type }}</td>
                            <td>@if($coupon->type=="fixed")${{ $coupon->discount_amount }}@else {{ $coupon->discount_amount }}% @endif</td>
                            <td>{{ \carbon\carbon::parse($coupon->starts_at)->format('d M,Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($coupon->expires_at)->format('d M,Y') }}</td>
                            <td>
                                @if($coupon->status==1)
                                <div style="width: 30px; height: 30px;">
                                    <svg class="text-success-500 h-6 w-6 text-success"  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </div>
                                @endif
                                @if($coupon->status==0)
                                <div style="width: 30px; height: 30px;">
                                    <svg class="text-danger h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                @endif
                            </td>
                            <td>
                                @if($pageModule['full_access']=="on"||$pageModule['edit_access']=="on")
                                    <a href="{{ route('coupon.edit',$coupon->id) }}" title="edit" class="btn btn-warning" data-color="#265ed7"><i class="ri-edit-box-line"></i></a>
                                @endif
                                    @if($pageModule['full_access']=="on")
                                    <a class="btn btn-danger" href="{{ route('coupon.delete',$coupon->id) }}" onclick="confirmation(event)" title="Delete" ><i class="fas fa-trash" style="color:azure"></i></a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <h1>we dont have coupons</h1>
                        @endforelse
                    </tbody>
                </table>
                {{ $coupons->links() }}
            </div>
            </div>
          </div>



        </div>
      </div>
    </section>

  </main><!-- End #main -->

@endsection
@section('customJs')
<script>
        function confirmation(ev)
        {

            ev.preventDefault();

            var url = ev.currentTarget.getAttribute('href');
           console.log(url);
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success"
                    })
                    window.location.href=url;


                }
                });

        }

</script>
@endsection
