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
                  <h5 class="card-title">coupons</h5>

                  <!-- Multi Columns Form -->
                  <form class="row g-3" action="{{ route('coupon.store') }}" method="post" >@csrf
                    {{-- <div class="col-md-10">
                      <label for="inputName5" class="form-label">code</label>
                      <input type="text" name="code" class="form-control" id="inputName5">
                      @error('code')
                      <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div> --}}
                    <div class="input-group mb-3">
                        <input type="text" name="code" id="promoCodeInput" class="form-control" placeholder="code.." aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                          <button class="btn btn-outline-secondary" id="generateButton" type="button">Generate</button>
                        </div>
                        @error('code')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      </div>
                    <div class="col-md-6">
                      <label for="inputEmail5" class="form-label">name</label>
                      <input type="text" name="name" class="form-control" id="inputEmail5">
                      @error('name')
                      <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="col-md-6">
                      <label for="inputPassword5" class="form-label">Description</label>
                      <textarea class="form-control" id="brand_description" name="description" style="height: 100px"></textarea>
                      @error('description')
                      <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="col-6">
                      <label for="inputAddress5" class="form-label">Max uses</label>
                      <input type="number" name="max_uses" class="form-control" id="inputAddres5s" placeholder="">
                      @error('max_uses')
                      <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="col-6">
                        <label for="inputState" class="form-label">Type</label>
                        <select id="inputState" name="type" class="form-select">
                          <option  value="percent">percent</option>
                          <option selected value="fixed">fixed</option>
                        </select>
                        @error('type')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-2">
                        <label for="inputState" class="form-label">Status</label>
                        <select id="inputState" name="status" class="form-select">
                          <option value="1" selected>active</option>
                          <option value="0">inactive</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="inputAddress5" class="form-label">Starts at</label>
                        <input type="date" name="starts_at" class="form-control" id="inputAddres5s" placeholder="">
                        @error('starts_at')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                      <label for="inputZip" class="form-label">Expires at</label>
                      <input type="date" name="expires_at" class="form-control" id="inputZip">
                      @error('expires_at')
                      <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="col-2">
                        <label for="inputAddress5" class="form-label">Discount amount</label>
                        <input type="number" name="discount_amount" class="form-control" id="inputAddres5s" placeholder="">
                        @error('discount_amount')
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


@endsection
@section('customJs')

<script>
    const generateButton = document.getElementById("generateButton");
const promoCodeInput = document.getElementById("promoCodeInput");

generateButton.addEventListener("click", () => {
  const randomCode = generateRandomCode(10); // Adjust length as needed
  promoCodeInput.value = randomCode;
});

function generateRandomCode(length) {
  const characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
  let result = "";
  for (let i = 0; i < length; i++) {
    result += characters.charAt(Math.floor(Math.random() * characters.length));
  }
  return result;
}
</script>

@endsection
