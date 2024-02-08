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
          <li class="breadcrumb-item active">create</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-11">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Create Brand</h5>

              <!-- General Form Elements -->
              <form action="{{ route('updateBrand',$brand->id) }}" id="brandForm" method="post"  enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Name*</label>
                  <div class="col-sm-10">
                    <input type="text" name="brand_name" id="name" value="{{ $brand->brand_name }}" class="form-control">
                    @error('brand_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>

                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">brand_discount</label>
                    <div class="col-sm-10">
                      <input type="number" name="brand_discount" value="{{ $brand->brand_discount }}" id="slug" class="form-control">
                      @error('brand_discount')
                      <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="row mb-3">
                      <label for="inputPassword" class="col-sm-2 col-form-label">Description*</label>
                      <div class="col-sm-10">
                          <textarea class="form-control" id="brand_description" name="description" style="height: 100px">value="{{ $brand->description }}"</textarea>
                      </div>
                  </div>
                  @error('description')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Select Status</label>
                    <div class="col-sm-10">
                        <select class="form-select" name="status" id="status" value="{{ $brand->status }}" aria-label="Default select example">
                            @if($brand->status==1)
                            @php $active="selected" @endphp
                            @else
                            @php $active="" @endphp
                            @endif
                            @if($brand->status==0)
                            @php $inactive="selected" @endphp
                            @else
                            @php $inactive="" @endphp
                            @endif

                            <option value="1" {{ $active }}>Active</option>
                            <option value="0" {{ $inactive }} >Block</option>
                        </select>
                        @error('status')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">LOGO*</label>
                    <div class="col-sm-10">
                        <input type="file" name="brand_logo" class="form-control">
                        @error('brand_logo')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    @if(!empty($brand->brand_logo))
                    <div class="form-group">
                    <label for="exampleInputFile">Old logo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <img class="img-fluid img-thumbnail rounded-circle " width="100" height="50" src="{{ asset('admin/assets/img/' . $brand['brand_logo']) }}" alt="" >
                    <div class="btn btn-danger"><a class="deleteCms" href="{{ route('deleteBrandLogo',$brand->id) }}" onclick="confirmation(event)" title="Delete" name=" CMS page" ><i class="fas fa-trash" style="color:azure"></i></a></div>
                    </div>
                    @endif
                </div>
                <div class="row mb-3">
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>

              </form><!-- End General Form Elements -->

            </div>
          </div>

        </div>


@endsection
