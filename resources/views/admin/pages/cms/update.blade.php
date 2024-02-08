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
          <li class="breadcrumb-item active">Update</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12 ">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Update in CMS page</h5>

              <!-- General Form Elements -->
              <form action="{{ route('submitUpdateCms',$data->id) }}" method="post">@csrf

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Title :</label>
                  <div class="col-sm-10">
                    <input type="text" name="title" value="{{ $data->title }}" class="form-control">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputEmail" class="col-sm-2 col-form-label">URL :</label>
                  <div class="col-sm-10">
                    <input type="text" name="url" value="{{ $data->url }}" class="form-control">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Description :</label>
                  <div class="col-sm-10">
                    <textarea class="form-control"  id="description" name="description" style="height: 100px">{{ $data->description }}</textarea>
                  </div>
                </div>


                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Meta_title :</label>
                    <div class="col-sm-10">
                      <input type="text" name="meta_title" value="{{ $data->meta_title }}" class="form-control">
                    </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Meta_description :</label>
                        <div class="col-sm-10">
                          <input type="text" name="meta_description" value="{{ $data->meta_description }}" class="form-control">
                        </div>
                        </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Meta_keywords :</label>
                    <div class="col-sm-10">
                      <input type="text" name="meta_keywords" value="{{ $data->meta_keywords }}" class="form-control">
                    </div>
                    </div>

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
