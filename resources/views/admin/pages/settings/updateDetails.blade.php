@extends('admin.layouts.auth')
@section('title','Update Details')
@section('adminContent')

<main id="main" class="main">

    <div class="pagetitle">

      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">settings</li>
          <li class="breadcrumb-item active">update details</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-6">

            <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Update Details</h5>

                  <!-- No Labels Form -->
                  <form action="{{ route('submitUpdateDetails') }}" enctype="multipart/form-data" method="POST" class="row g-3">@csrf
                    @error('success')
                    <div class="alert alert-success">{{ $message }}</div>
                    @enderror
                    <div class="col-md-12">
                      <input type="email" name="email" value="{{ Auth::guard('admin')->user()->email }}" readonly style="background-color: #9b9b9b" class="form-control">
                    </div>

                    <div class="col-md-6">
                      <input type="text" name="name" class="form-control" placeholder="new name">
                      @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>

                    <div class="col-md-6">
                      <input type="number" name="phone" class="form-control" placeholder="phone">
                        @error('phone')
                             <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="inputNanme4" class="form-label">Update Image</label>
                        <input type="file" name="image" class="form-control">
                            @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                      </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form><!-- End No Labels Form -->

                </div>
              </div>



            </div>


          </div>

        </div>
      </div>
    </section>

  </main>

@endsection









