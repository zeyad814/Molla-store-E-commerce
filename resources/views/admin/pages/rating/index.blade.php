@extends('admin.layouts.auth')
@section('title','rating')
@section('adminContent')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>PRODUCT RATING </h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">rating</li>
          <li class="breadcrumb-item active">index</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">

        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    
                  <h5 class="card-title">Reviews</h5>
                  {{-- <a href="{{ route('createbrand') }}" class="col-12 btn btn-primary" >add brand</a> --}}
                  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    </div>
                  <table class="table">
                    <thead>
                      <tr>
                        <th>#ID</th>
                        <th>
                          <b>P</b>roduct
                        </th>
                        <th>Rating</th>
                        <th>Comment</th>
                        <th>Name</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                        @forelse ($ratings as $rating)
                        <tr>
                            <td>{{ $rating->id }}</td>
                          <td class="w-25">
                            {{ $rating->product->product_name }}
                          </td>
                          <td>
                            {{ $rating->rating }}
                          </td>
                          <td>{{ $rating->comment }}</td>
                          <td>{{ $rating->name }}</td>
                          <td>
                            <div class="table-actions">
                                @if($pageModule['full_access']=="on"||$pageModule['edit_access']=="on")
                                    @if($rating->status==1)
                                    <a class=" btn btn-primary" href="{{ route('rate.update.status',$rating->id) }}"><i class="fas fa-toggle-on" status="Active" ></i></a>
                                    @endif
                                    @if($rating->status==0)
                                    <a class=" btn btn-secondary" href="{{ route('rate.update.status',$rating->id) }}" ><i class="fas fa-toggle-off" status="Inactive" ></i></a>
                                    @endif
                                @endif
                            </div>
                        </td>
                        </tr>
                        {{-- href="{{ route('deleteCms',$brand->id) }}" --}}
                        @empty
                        <h1>we dont any content to show</h1>
                        @endforelse

                    </tbody>
                  </table>
                  <!-- End Table with stripped rows -->

                </div>
              </div>



        </div>
      </div>
    </section>

  </main><!-- End #main -->

@endsection

