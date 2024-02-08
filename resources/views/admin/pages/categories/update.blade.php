@extends('admin.layouts.auth')
@section('title','update Category')
@section('adminContent')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Form Elements</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Forms</li>
          <li class="breadcrumb-item active">Elements</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-11">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Create Category</h5>

              <!-- General Form Elements -->
              <form action="{{ route('updateCategory',$category->id) }}" id="categoryForm" method="post" name="categoryForm" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Name*</label>
                  <div class="col-sm-10">
                    <input type="text" name="category_name" id="name" value="{{ $category->category_name }}" class="form-control">
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>

                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Category_discount</label>
                    <div class="col-sm-10">
                      <input type="number" name="category_discount" value="{{ $category->category_discount }}" class="form-control">
                      @error('category_discount')
                      <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>

                <div class="row mb-3">
                    <label for="inputEmail" class="col-sm-2 col-form-label">URL*</label>
                    <div class="col-sm-10">
                        <input type="text" name="url" value="{{ $category->url }}" class="form-control">
                        @error('url')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Description*</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="category_description" name="description" style="height: 100px">{{ $category->description }}</textarea>
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
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">new image*</label>
                    <div class="col-sm-10">
                        <input type="file" name="category_image" class="form-control">
                    </div>
                </div>
                @error('category_image')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @if(!empty($category->category_image))
                <div class="form-group">
                    <label for="exampleInputFile">Old Image&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <img class="img-fluid img-thumbnail" width="150px" src="{{ asset('admin/assets/img/' . $category['category_image']) }}" alt="" >
                        <div class="btn btn-danger"><a class="deleteCms" href="{{ route('deleteCategoryImage',$category->id) }}" onclick="confirmation(event)" title="Delete" name=" CMS page" ><i class="fas fa-trash" style="color:azure"></i></a></div>
                </div>
                @endif
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
