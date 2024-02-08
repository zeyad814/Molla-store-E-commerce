// $(document).ready(function(){
//     $("#current_password").keyup(function(){
//         var current_password = $("#current_password").val();
//         // alert(current_password);
//         $.ajax({
//             type: 'post',
//             url: "{{route('checkCurrentPassword')}}",
//             data: {current_password: current_password},
//             success:function(resp){

//                 if(resp=="false"){
//                     $("#verifyCurrentPassword").html("current password is incorrect");
//                 }else if(resp=="true"){
//                     $("#verifyCurrentPassword").html("current password is correct");
//                 }

//             },error:function(){
//                 alert("Error");
//             }
//         })
//     });
// });







// $(document).on('click','#save',function(event){
//     event.preventDefault();
//     $("#current_password").keyup(function(){
//         var current_password = $("#current_password").val();
//         // alert(current_password);
//         $.ajax({
//             type: 'post',
//             url: "{{route('checkCurrentPassword')}}",
//             data: {current_password: current_password},
//             success:function(resp){

//                 if(resp=="false"){
//                     $("#verifyCurrentPassword").html("current password is incorrect");
//                 }else if(resp=="true"){
//                     $("#verifyCurrentPassword").html("current password is correct");
//                 }

//             },error:function(){
//                 alert("Error");
//             }
//         })
//     });
// });
