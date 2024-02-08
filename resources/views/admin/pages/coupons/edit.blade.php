@extends('admin.layouts.auth')
@section('title','Brands')
@section('adminContent')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Form Elements</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">brands</li>
          <li class="breadcrumb-item active">edit</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-11">

            <div class="card">
                <div class="card-body">
                  <h5 class="card-title">coupons</h5>

                  <!-- Multi Columns Form -->
                  <form class="row g-3" action="{{ route('coupon.update',$coupon->id) }}" method="post" >@csrf
                    <div class="col-md-12">
                      <label for="inputName5" class="form-label">code</label>
                      <input type="text" name="code" value="{{ $coupon->code }}" class="form-control" id="inputName5">
                      @error('code')
                      <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="col-md-6">
                      <label for="inputEmail5" class="form-label">name</label>
                      <input type="text" name="name" class="form-control" value="{{ $coupon->name }}"  id="inputEmail5">
                      @error('name')
                      <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="col-md-6">
                      <label for="inputPassword5" class="form-label">Description</label>
                      <textarea class="form-control" id="brand_description" name="description" style="height: 100px">{{ $coupon->description }}</textarea>
                      @error('description')
                      <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="col-6">
                      <label for="inputAddress5" class="form-label">Max uses</label>
                      <input type="number" name="max_uses" value="{{ $coupon->max_uses }}" class="form-control" id="inputAddres5s" placeholder="">
                      @error('max_uses')
                      <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="col-6">
                        <label for="inputState" class="form-label">Type</label>
                        @if($coupon->type=="fixed")
                        @php $fixed="selected" @endphp
                        @else
                        @php $fixed="" @endphp
                        @endif
                        @if($coupon->type=="percent")
                        @php $percent="selected" @endphp
                        @else
                        @php $percent="" @endphp
                        @endif
                        <select id="inputState" name="type" class="form-select">
                          <option {{ $percent }} value="percent">percent</option>
                          <option {{ $fixed }} value="fixed">fixed</option>
                        </select>
                        @error('type')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-2">
                        <label for="inputState" class="form-label">Status</label>
                        @if($coupon->status==1)
                        @php $active="selected" @endphp
                        @else
                        @php $active="" @endphp
                        @endif
                        @if($coupon->status==0)
                        @php $inactive="selected" @endphp
                        @else
                        @php $inactive="" @endphp
                        @endif
                        <select id="inputState" name="status" class="form-select">
                          <option value="1" {{ $active }} >active</option>
                          <option value="0" {{ $inactive }} >inactive</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="inputAddress5" class="form-label">Starts at</label>
                        <input type="date" name="starts_at" value="{{ $coupon->starts_at }}" class="form-control" id="inputAddres5s" placeholder="">
                        @error('starts_at')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                      <label for="inputZip" class="form-label">Expires at</label>
                      <input type="date" name="expires_at" value="{{ $coupon->expires_at }}" class="form-control" id="inputZip">
                      @error('expires_at')
                      <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="col-2">
                        <label for="inputAddress5" class="form-label">Discount amount</label>
                        <input type="number" name="discount_amount" value="{{ $coupon->discount_amount }}" class="form-control" id="inputAddres5s" placeholder="">
                        @error('discount_amount')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                  </form><!-- End Multi Columns Form -->

                </div>
              </div>

            </div>

        </div>


@endsection
