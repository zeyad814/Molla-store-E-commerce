@extends('admin.layouts.auth')
@section('title','Create')
@section('adminContent')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Add Sub Admins</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Sub admins</li>
          <li class="breadcrumb-item active">Add</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-7 ">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"></h5>
                  <!-- Multi Columns Form -->
                  <form class="row g-3" action="{{ route('submitAddSubadmins') }}" method="post">@csrf
                    <div class="col-md-12">
                      <label for="inputName5" class="form-label">Full Name</label>
                      <input type="text" name="name" class="form-control" id="inputName5">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                      <label for="inputEmail5" class="form-label">Email</label>
                      <input type="email" name="email" class="form-control" id="inputEmail5">
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                      <label for="inputPassword5" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="inputPassword5">
                    </div>
                    <div class="col-md-6">
                      <label for="inputPassword5" class="form-label">Confirm Password</label>
                      <input type="password" name="password_confirmation" class="form-control" id="inputPassword5">
                    </div>
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="col-12">
                      <label for="inputAddress5" class="form-label">Phone Number</label>
                      <input type="number" name="phone" class="form-control" id="inputAddres5s">
                        @error('phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form><!-- End Multi Columns Form -->

                </div>
              </div>
            </div>
          </div>


        </div>

      </div>
    </section>

  </main><!-- End #main -->

@endsection
