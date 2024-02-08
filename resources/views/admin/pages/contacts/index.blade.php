@extends('admin.layouts.auth')
@section('title','Coupons')
@section('adminContent')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>CONTACTS</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Contacts</li>
          <li class="breadcrumb-item active">index</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">

        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Contacts Table</h5>

                <table class="table table-bordered">
                        <br>

                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">name</th>
                        <th scope="col">Email</th>
                        <th scope="col">subject</th>
                        <th scope="col">Message</th>
                        <th scope="col">created at</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $contact)
                        <tr>
                            <th scope="row">{{ $contact->id }}</th>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->subject }}</td>
                            <td>{{ $contact->message }}</td>
                            <td>{{ \carbon\carbon::parse($contact->created_at)->format('d M,Y') }}</td>

                            <td>
                                    <a class="btn btn-danger" href="{{ route('contact.delete',$contact->id) }}" onclick="confirmation(event)" title="Delete" ><i class="fas fa-trash" style="color:azure"></i></a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <h1>we dont have contacts</h1>
                        @endforelse
                    </tbody>
                </table>
                {{ $data->links() }}
            </div>
            </div>
          </div>



        </div>
      </div>
    </section>

  </main><!-- End #main -->

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

