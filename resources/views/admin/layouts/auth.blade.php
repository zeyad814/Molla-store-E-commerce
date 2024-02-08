<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('title')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('admin/assets') }}/img/favicon.png" rel="icon">
  <link href="{{ asset('admin/assets') }}/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('admin/assets') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('admin/assets') }}/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="{{ asset('admin/assets') }}/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="{{ asset('admin/assets') }}/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="{{ asset('admin/assets') }}/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="{{ asset('admin/assets') }}/vendor/summernote/summernote.min.css" rel="stylesheet">
  <link href="{{ asset('admin/assets') }}/vendor/dropzone/min/dropzone.min.css" rel="stylesheet">
  <link href="{{ asset('admin/assets') }}/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="{{ asset('admin/assets') }}/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('admin/assets') }}/css/style.css" rel="stylesheet">
  <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="{{ asset('admin/assets') }}/img/logo.png" alt="">
        <span class="d-none d-lg-block">NiceAdmin</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="{{ asset('admin/assets') }}/img/{{Auth::guard('admin')->user()->image}}" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::guard('admin')->user()->name }}</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>Kevin Anderson</h6>
              <span>Web Designer</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('adminLogout') }}">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        @if(Session::get('page')=="index")
        @php $active = ""  @endphp
        @else
        @php $active = "collapsed"  @endphp
        @endif
      <li class="nav-item">
        <a class="nav-link {{ $active }}" href="{{ route('adminHome') }}">
          <i class="bi bi-house-door"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
      @if(Session::get('page')=="category")
      @php $active = ""  @endphp
      @else
      @php $active = "collapsed"  @endphp
      @endif
      <li class="nav-item">
        <a class="nav-link {{ $active }} " href="{{ route('adminCategory') }}">
          <i class="bi bi-grid"></i>
          <span>Categories</span>
        </a>
      </li><!-- End Dashboard Nav -->
      @if(Session::get('page')=="brand")
      @php $active = ""  @endphp
      @else
      @php $active = "collapsed"  @endphp
      @endif
      <li class="nav-item">
        <a class="nav-link {{ $active }} " href="{{ route('adminBrand') }}">
          <i class="bi bi-patch-check-fill"></i>
          <span>brands</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <li class="nav-item">
        @if(Session::get('page')=="product")
        @php $active = ""  @endphp
        @else
        @php $active = "collapsed"  @endphp
        @endif
          <a class="nav-link {{ $active }} " href="{{ route('adminProduct') }}">
              <i class="bi bi-grid"></i>
              <span>Products</span>
            </a>
        </li><!-- End Dashboard Nav -->
      <li class="nav-item">
        @if(Session::get('page')=="rating")
        @php $active = ""  @endphp
        @else
        @php $active = "collapsed"  @endphp
        @endif
          <a class="nav-link {{ $active }} " href="{{ route('rate.index') }}">
              <i class="bi bi-star-fill"></i>
              <span>Rating</span>
            </a>
        </li><!-- End Dashboard Nav -->
      <li class="nav-item">
        @if(Session::get('page')=="order")
        @php $active = ""  @endphp
        @else
        @php $active = "collapsed"  @endphp
        @endif
          <a class="nav-link {{ $active }} " href="{{ route('order.index') }}">
              <i class="bi bi-bag-fill"></i>
              <span>Orders</span>
            </a>
        </li><!-- End Dashboard Nav -->
      <li class="nav-item">
        @if(Session::get('page')=="banner")
        @php $active = ""  @endphp
        @else
        @php $active = "collapsed"  @endphp
        @endif
        <a class="nav-link {{ $active }} " href="{{ route('adminBanner') }}">
          <i class="bi bi-image-fill"></i>
          <span>Banners</span>
        </a>
      </li><!-- End Dashboard Nav -->

        @if(Session::get('page')=="CMS")
        @php $active = ""  @endphp
        @else
        @php $active = "collapsed"  @endphp
        @endif
        <li class="nav-item">
            <a class="nav-link {{ $active }} " href="{{ route('adminCms') }}">
                <i class="bi bi-copy"></i>
                <span>CMS</span>
            </a>
        </li><!-- End Dashboard Nav -->
        @if(Session::get('page')=="coupon")
        @php $active = ""  @endphp
        @else
        @php $active = "collapsed"  @endphp
        @endif
        <li class="nav-item">
            <a class="nav-link {{ $active }} " href="{{ route('coupon.index') }}">
                <i class="bi bi-percent"></i>
                <span>Coupons</span>
            </a>
        </li><!-- End Dashboard Nav -->
        @if(Session::get('page')=="subAdmin")
        @php $active = ""  @endphp
        @else
        @php $active = "collapsed"  @endphp
        @endif
        @if(Auth::guard('admin')->user()->type=="2")
        <li class="nav-item">
          <a class="nav-link {{ $active }} " href="{{ route('subAdmins') }}">
            <i class="bi bi-people-fill"></i>
            <span>Sub Admins</span>
          </a>
        </li><!-- End Dashboard Nav -->
        @endif
        @if(Session::get('page')=="contact")
        @php $active = ""  @endphp
        @else
        @php $active = "collapsed"  @endphp
        @endif
        <li class="nav-item">
            <a class="nav-link {{ $active }} " href="{{ route('contact.index') }}">
                <i class="bi bi-chat-left-dots"></i>
                <span>Messages</span>
            </a>
        </li><!-- End Dashboard Nav -->
        <li class="nav-item">
         @if(Session::get('page')=="updatePassword"||Session::get('page')=="updateDetails")
                @php $active = ""  @endphp
            @else
                @php $active = "collapsed"  @endphp
            @endif
            <a class="nav-link {{ $active }}" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
              <i class="ri-settings-3-fill"></i><span>Settings</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
              <li>
                <a href="{{ route('updatePassword') }}">
                  <i class="bi bi-circle"></i><span>Update Password</span>
                </a>
              </li>
              <li>
                <a href="{{ route('updateDetails') }}">
                  <i class="bi bi-circle"></i><span>Update Details</span>
                </a>
              </li>
              <li>
                <a href="components-badges.html">
                  <i class="bi bi-circle"></i><span>Badges</span>
                </a>
              </li>
            </ul>
          </li><!-- End Components Nav -->


    </ul>

  </aside>


<section>@yield('adminContent')</section>

<footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('admin/assets') }}/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="{{ asset('admin/assets') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('admin/assets') }}/vendor/chart.js/chart.umd.js"></script>
  <script src="{{ asset('admin/assets') }}/vendor/echarts/echarts.min.js"></script>
  <script src="{{ asset('admin/assets') }}/vendor/quill/quill.min.js"></script>
  <script src="{{ asset('admin/assets') }}/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="{{ asset('admin/assets') }}/vendor/tinymce/tinymce.min.js"></script>
  <script src="{{ asset('admin/assets') }}/vendor/php-email-form/validate.js"></script>
  <script src="{{ asset('admin/assets') }}/vendor/jquery/jquery.min.js"></script>
  <script src="{{ asset('admin/assets') }}/vendor/jquery-ui/jquery-ui.min.js"></script>
  <script src="{{ asset('admin/assets') }}/vendor/fontawesome-free-6.5.1-web/css/all.min.css"></script>
  <script src="{{ asset('admin/assets') }}/vendor/fontawesome-free-6.5.1-web/js/all.min.js"></script>
  <script src="{{ asset('admin/assets') }}/vendor/jquery-ui/jquery-ui.min.js"></script>
  <script src="{{ asset('admin/assets') }}/vendor/summernote/summernote.min.js"></script>
  <script src="{{ asset('admin/assets') }}/vendor/dropzone/min/dropzone.min.js"></script>
  <script src="{{ asset('admin/assets') }}/vendor/dropzone/dropzone.js"></script>
  {{-- <script src="{{ asset('admin/assets') }}/vendor/jqvmap/maps/jquery.vmap.usa.js"></script> --}}
  <script src="{{ asset('admin/assets') }}/vendor/jquery-knob/jquery.knob.min.js"></script>
  <script src="{{ asset('admin/assets') }}/vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers:{
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  @yield('customJs')
  <!-- Template Main JS File -->
  <script src="{{ asset('admin/assets') }}/js/main.js"></script>
  <script src="{{ asset('admin/assets') }}/js/customJS.js"></script>

</body>

</html>



