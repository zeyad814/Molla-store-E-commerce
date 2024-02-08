@extends('admin.layouts.auth')
@section('title','Update Password')
@section('adminContent')

<main id="main" class="main">

    <div class="pagetitle">

      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">settings</li>
          <li class="breadcrumb-item active">update password</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-6">

            <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Update Password</h5>

                  <!-- No Labels Form -->
                  <form action="{{ route('submitUpdate') }}" method="POST" class="row g-3">@csrf
                    @error('success')
                    <div class="alert alert-success">{{ $message }}</div>
                    @enderror
                    <div class="col-md-12">
                      <input type="email" name="email" value="{{ Auth::guard('admin')->user()->email }}" readonly style="background-color: #9b9b9b" class="form-control">
                    </div>
                    <div class="col-12">
                      <input type="password" id="current_password" name="current_password" class="form-control" placeholder="Current Password"><span id="verifyCurrentPassword"></span>

                    </div>
                    @error('current_password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="col-md-6">
                      <input type="password" name="password" class="form-control" placeholder="new password">
                    </div>
                    <div class="col-md-6">
                      <input type="password" name="password_confirmation" class="form-control" placeholder="confirm new password">
                    </div>
                    @error('password_confirmation')
                         <div class="alert alert-danger">{{ $message }}</div>
                     @enderror

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
@section('customJs')
<script>
$(document).ready(function(){
    $("#current_password").keyup(function(){
        var current_password = $("#current_password").val();
        // alert(current_password);
        $.ajax({
            type: 'post',
            url: "{{route('checkCurrentPassword')}}",
            data: {
                '_token' : "{{ csrf_token() }}",
                current_password: current_password
                },
            success:function(resp){

                if(resp=="false"){
                    $("#verifyCurrentPassword").html("current password is incorrect");
                }else if(resp=="true"){
                    $("#verifyCurrentPassword").html("current password is correct");
                }

            },error:function(){
                alert("Error");
            }
        })
    });
});




// $(document).on('click','#save',function(event){
//     event.preventDefault();
//     // $("#current_password").keyup(function(){
//         // var current_password = $("#current_password").val();
//         // alert(current_password);
//         $.ajax({
//             type: 'post',
//             url: "{{ route('checkCurrentPassword') }}",
//             data: {
//                 '_token' : "{{ csrf_token() }}",
//                 'current_password': $("input[name='current_password']").val,
//                 },
//             success:function(data){

//                 // if(resp=="false"){
//                 //     $("#verifyCurrentPassword").html("current password is incorrect");
//                 // }else if(resp=="true"){
//                 //     $("#verifyCurrentPassword").html("current password is correct");
//                 // }

//             },error:function(reject){
//                 // alert("Error");
//             }
//         })
//     // });
// });






</script>
@endsection








