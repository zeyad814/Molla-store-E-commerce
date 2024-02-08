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
          <li class="breadcrumb-item active">Edit</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-8">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Edit banner</h5>

              <!-- General Form Elements -->
              <form action="{{ route('updateBanner',$banner->id) }}" id="bannerForm" method="post"  enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <label class="col-sm-2 col-form-label">Banner Type</label>
                        @if($banner->type=="slider")
                        @php $slider='selected' @endphp
                        @else
                        @php $slider=null  @endphp
                        @endif
                        @if($banner->type=="demo_1")
                        @php $demo_1='selected' @endphp
                        @else
                        @php $demo_1=null  @endphp
                        @endif
                        @if($banner->type=="demo_2")
                        @php $demo_2='selected' @endphp
                        @else
                        @php $demo_2=null  @endphp
                        @endif
                        @if($banner->type=="demo_3")
                        @php $demo_3='selected' @endphp
                        @else
                        @php $demo_3=null  @endphp
                        @endif
                        @if($banner->type=="demo_4")
                        @php $demo_4='selected' @endphp
                        @else
                        @php $demo_4=null  @endphp
                        @endif
                        <select class="form-select" name="type" id="status" aria-label="Default select example">
                            <option value="">Select</option>
                            <option {{ $slider }} value="slider">slider</option>
                            <option {{ $demo_1 }} value="demo_1">demo 1</option>
                            <option {{ $demo_2 }} value="demo_2">demo 2</option>
                            <option {{ $demo_3 }} value="demo_3">demo 3</option>
                            <option {{ $demo_4 }} value="demo_4">demo 4</option>
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
                    @if(!empty($banner->image))
                    <div class="form-group">
                    <label for="exampleInputFile">Old Image</label>
                    <a href="{{ asset('admin/assets/img/banners/'. $banner->image) }}" target="_blank"><img class="img-fluid img-thumbnail rounded-circle" width="150px" src="{{ asset('admin/assets/img/banners/'. $banner->image) }}" alt="a7a" ></a>
                    </div>
                    @endif
                  </div>
                </div>

                  <div class="row mb-3">
                      <div class="col-sm-12">
                          <label for="inputText" class="col-sm-2 col-form-label">Title :</label>
                          <input type="text" name="title" class="form-control" value="{{ $banner->title }}" placeholder="Entre Banner title">
                          @error('title')
                          <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="col-sm-12">
                          <label for="inputText" class="col-sm-2 col-form-label">Sort :</label>
                          <input type="number" name="sort" class="form-control" value="{{ $banner->sort }}" placeholder="Entre Banner Sort">
                          @error('sort')
                          <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="col-sm-12">
                          <label for="inputText" class="col-sm-2 col-form-label">link :</label>
                          <input type="text" name="link" class="form-control" value="{{ $banner->link }}" placeholder="Entre the banner link">
                          @error('link')
                          <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="col-sm-12">
                          <label for="inputText" class="col-sm-2 col-form-label">alt :</label>
                          <input type="text" name="alt" class="form-control" value="{{ $banner->alt }}" placeholder="Entre the banner Alt">
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
