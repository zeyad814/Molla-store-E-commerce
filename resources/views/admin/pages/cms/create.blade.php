@extends('admin.layouts.auth')
@section('title','Create')
@section('adminContent')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>CMS Management</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">CMS</li>
          <li class="breadcrumb-item active">Create</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12 ">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add CMS page</h5>

              <!-- General Form Elements -->
              <form action="{{ route('submitCreateCms') }}" method="post">@csrf

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Title :</label>
                  <div class="col-sm-10">
                    <input type="text" name="title" class="form-control">
                  </div>
                </div>
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="row mb-3">
                  <label for="inputEmail" class="col-sm-2 col-form-label">URL :</label>
                  <div class="col-sm-10">
                    <input type="text" name="url" class="form-control">
                  </div>
                </div>
                @error('url')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Description :</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" id="description" name="description" style="height: 100px"></textarea>
                  </div>
                </div>
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Meta_title :</label>
                    <div class="col-sm-10">
                      <input type="text" name="meta_title" class="form-control">
                    </div>
                    </div>
                    @error('meta_title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Meta_description :</label>
                        <div class="col-sm-10">
                          <input type="text" name="meta_description" class="form-control">
                        </div>
                        </div>
                        @error('meta_description')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Meta_keywords :</label>
                    <div class="col-sm-10">
                      <input type="text" name="meta_keywords" class="form-control">
                    </div>
                    </div>
                    @error('meta_description')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                <div class="row mb-3">
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Submit Form</button>
                  </div>
                </div>

              </form><!-- End General Form Elements -->

            </div>
          </div>

        </div>

      </div>
    </section>

  </main><!-- End #main -->


@endsection
