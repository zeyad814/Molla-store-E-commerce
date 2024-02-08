@extends('admin.layouts.auth')
@section('title','Banners')
@section('adminContent')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Form Elements</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">banners</li>
          <li class="breadcrumb-item active">create</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-8">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Create banner</h5>

              <!-- General Form Elements -->
              <form action="{{ route('storeBanner') }}" id="bannerForm" method="post"  enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <label class="col-sm-2 col-form-label">Banner Type</label>
                        <select class="form-select" name="type" id="status" aria-label="Default select example">
                            <option value="">Select</option>
                            <option value="slider">slider</option>
                            <option value="demo_1">demo 1</option>
                            <option value="demo_2">demo 2</option>
                            <option value="demo_3">demo 3</option>
                            <option value="demo_4">demo 4</option>
                        </select>
                        @error('type')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-12">
                      <label for="inputText" class="col-sm-2 col-form-label">image :</label>
                    <input type="file" name="image" id="name" class="form-control">
                    @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>

                  <div class="row mb-3">
                      <div class="col-sm-12">
                          <label for="inputText" class="col-sm-2 col-form-label">Title :</label>
                          <input type="text" name="title" class="form-control" placeholder="Entre Banner title">
                          @error('title')
                          <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="col-sm-12">
                          <label for="inputText" class="col-sm-2 col-form-label">Sort :</label>
                          <input type="number" name="sort" class="form-control" placeholder="Entre Banner Sort">
                          @error('sort')
                          <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="col-sm-12">
                          <label for="inputText" class="col-sm-2 col-form-label">link :</label>
                          <input type="text" name="link" class="form-control" placeholder="Entre the banner link">
                          @error('link')
                          <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="col-sm-12">
                          <label for="inputText" class="col-sm-2 col-form-label">alt :</label>
                          <input type="text" name="alt" class="form-control" placeholder="Entre the banner Alt">
                          @error('alt')
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
