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
              <form action="{{ route('submitCreateBrand') }}" id="brandForm" method="post"  enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Name*</label>
                  <div class="col-sm-10">
                    <input type="text" name="brand_name" id="name" class="form-control">
                    @error('brand_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>

                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">brand_discount</label>
                    <div class="col-sm-10">
                      <input type="number" name="brand_discount" id="slug" class="form-control">
                      @error('brand_discount')
                      <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="row mb-3">
                      <label for="inputPassword" class="col-sm-2 col-form-label">Description*</label>
                      <div class="col-sm-10">
                          <textarea class="form-control" id="brand_description" name="description" style="height: 100px"></textarea>
                      </div>
                  </div>
                  @error('description')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror


                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Select Status</label>
                    <div class="col-sm-10">
                        <select class="form-select" name="status" id="status" aria-label="Default select example">
                            <option value="1">Active</option>
                            <option value="0">Block</option>
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
