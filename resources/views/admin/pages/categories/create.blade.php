@extends('admin.layouts.auth')
@section('title','create Category')
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
              <form action="{{ route('submitCreateCategory') }}" id="categoryForm" method="post" name="categoryForm" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Name*</label>
                  <div class="col-sm-10">
                    <input type="text" name="category_name" id="name" class="form-control">
                    @error('category_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                {{-- <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Category Level*</label>
                  <div class="col-sm-10">
                    <select name="parent_id" class="form-select">
                        <option value="">select</option>
                        <option value="0">main category</option>
                        @foreach ($categories as $category )
                            <option value="{{ $category['id'] }}">{{ $category['category_name'] }}</option>
                            @if(!empty($category['sub_categories']))
                                @foreach ($category['sub_categories'] as $subcat )
                                <option value="{{ $subcat['id'] }}">&nbsp;&nbsp;&raquo;{{ $subcat['category_name'] }}</option>
                                @endforeach
                            @endif
                        @endforeach
                    </select>
                    @error('parent_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div> --}}

                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Category_discount</label>
                    <div class="col-sm-10">
                      <input type="number" name="category_discount" id="slug" class="form-control">
                      @error('category_discount')
                      <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>

                <div class="row mb-3">
                    <label for="inputEmail" class="col-sm-2 col-form-label">URL*</label>
                    <div class="col-sm-10">
                        <input type="text" name="url" class="form-control">
                        @error('url')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Description*</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="category_description" name="description" style="height: 100px"></textarea>
                    </div>
                </div>
                @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                {{-- <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Meta_title :</label>
                    <div class="col-sm-10">
                        <input type="text" name="meta_title" class="form-control">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Meta_description :</label>
                    <div class="col-sm-10">
                        <input type="text" name="meta_description" class="form-control">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Meta_keywords :</label>
                    <div class="col-sm-10">
                        <input type="text" name="meta_keywords" class="form-control">
                    </div>
                </div> --}}

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
                    <label for="inputText" class="col-sm-2 col-form-label">image*</label>
                    <div class="col-sm-10">
                        <input type="file" name="category_image" class="form-control">
                    </div>
                </div>
                @error('category_image')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
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

{{-- <script>
$("#categoryForm").submit(function(event) {

event.preventDefault();
var element = $(this);
$.ajax({
    url: '{{ route('submitCreateCategory') }}',
    type: 'post',
    data: element.serializeArray(),
    dataType: 'json',
    success: function(response) {
        var errors = response['errors'];
        if(errors['name']) {
            $("#name").addClass('is-invalid')
            .siblings('p')
            .addClass('invalid-feedback').html(errors['name']);
        }else{
            $("#name").removeClass('is-invalid')
            .siblings('p')
            .removeClass('invalid-feedback').html("");
        }
        if(errors['slug']) {
            $("#slug").addClass('is-invalid')
            .siblings('p')
            .addClass('invalid-feedback').html(errors['slug']);
        }else{
            $("#slug").removeClass('is-invalid')
            .siblings('p')
            .removeClass('invalid-feedback').html("");
        }
    }

}), error: function(jqXHR, expetion) {
        console.log("something went wrong");
    }

}); --}}
</script>

@endsection
