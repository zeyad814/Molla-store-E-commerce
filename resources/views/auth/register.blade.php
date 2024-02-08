<!DOCTYPE html>
<html lang="en">
<!-- molla/login.html  22 Nov 2019 10:04:03 GMT -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Molla - Bootstrap eCommerce Template</title>
    <meta name="keywords" content="HTML5 Template">
    <meta name="description" content="Molla - Bootstrap eCommerce Template">
    <meta name="author" content="p-themes">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('front/assets') }}/images/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('front/assets') }}/images/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('front/assets') }}/images/icons/favicon-16x16.png">
    <link rel="manifest" href="{{ asset('front/assets') }}/images/icons/site.html">
    <link rel="mask-icon" href="{{ asset('front/assets') }}/images/icons/safari-pinned-tab.svg" color="#666666">
    <link rel="shortcut icon" href="{{ asset('front/assets') }}/images/icons/favicon.ico">
    <meta name="apple-mobile-web-app-title" content="Molla">
    <meta name="application-name" content="Molla">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="{{ asset('front/assets') }}/images/icons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('front/assets') }}/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{ asset('front/assets') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('front/assets') }}/css/plugins/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="{{ asset('front/assets') }}/css/plugins/magnific-popup/magnific-popup.css">
    <link rel="stylesheet" href="{{ asset('front/assets') }}/css/plugins/jquery.countdown.css">
    <link rel="stylesheet" href="{{ asset('front/assets') }}/css/plugins/nouislider/nouislider.css">
    <!-- Main CSS File -->

    <link rel="stylesheet" href="{{ asset('front/assets') }}/css/style.css">
    <link rel="stylesheet" href="{{ asset('front/assets') }}/css/skins/skin-demo-4.css">
    <link rel="stylesheet" href="{{ asset('front/assets') }}/css/demos/demo-4.css">
</head>

<body>
    <div class="page-wrapper">






            <div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17" style="background-image: url('{{ asset('front/assets') }}/images/backgrounds/login-bg.jpg')">
            	<div class="container">
            		<div class="form-box">
            			<div class="form-tab">
	            			<ul class="nav nav-pills nav-fill" role="tablist">
							    <li class="nav-item">
							        <a class="nav-link " href="{{ route('login') }}"  aria-controls="signin-2" >Sign In</a>
							    </li>
							    <li class="nav-item">
							        <a class="nav-link active" id="register-tab-2" data-toggle="tab" href="#register-2" role="tab" aria-controls="register-2" aria-selected="true">Register</a>
							    </li>
							</ul>
							<div class="tab-content">
							    <div class="tab-pane fade show active" id="register-2" role="tabpanel" aria-labelledby="register-tab-2">
							    	<form action="{{ route('submitRegister') }}" method="post">
                                        @csrf
							    		<div class="form-group">
							    			<label for="register-email-2">Your name *</label>
							    			<input type="text" class="form-control" id="register-email-2" name="name"  required>
							    		</div><!-- End .form-group -->
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
							    		<div class="form-group">
							    			<label for="register-password-2">Your email address *</label>
							    			<input type="email" class="form-control" id="register-password-2" name="email" value="{{ old('email') }}" required>
							    		</div><!-- End .form-group -->
                                        @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
							    		<div class="form-group">
							    			<label for="register-password-2">Password *</label>
							    			<input type="password" class="form-control" id="register-password-2" name="password" required>
							    		</div><!-- End .form-group -->
                                        @error('password')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
							    		<div class="form-group">
							    			<label for="register-password-2">Confirm Password *</label>
							    			<input type="password" class="form-control" id="register-password-2" name="password_confirmation" required>
							    		</div><!-- End .form-group -->
                                        @error('confirmpassword')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
							    		<div class="form-group">
							    			<label for="register-password-2">Phone number *</label>
							    			<input type="number" class="form-control" name="phone" required>
							    		</div><!-- End .form-group -->
                                        @error('phone')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
							    		<div class="form-footer">
							    			<button type="submit" class="btn btn-outline-primary-2">
			                					<span>SIGN UP</span>
			            						<i class="icon-long-arrow-right"></i>
			                				</button>

			                				<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="register-policy-2" required>
												<label class="custom-control-label" for="register-policy-2">I agree to the <a href="#">privacy policy</a> *</label>
											</div><!-- End .custom-checkbox -->
							    		</div><!-- End .form-footer -->
							    	</form>
							    </div><!-- .End .tab-pane -->
							</div><!-- End .tab-content -->
						</div><!-- End .form-tab -->
            		</div><!-- End .form-box -->
            	</div><!-- End .container -->
            </div><!-- End .login-page section-bg -->
        </main><!-- End .main -->


    </div><!-- End .page-wrapper -->
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    <!-- Mobile Menu -->
    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

    <div class="mobile-menu-container">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="icon-close"></i></span>

            <form action="#" method="get" class="mobile-search">
                <label for="mobile-search" class="sr-only">Search</label>
                <input type="search" class="form-control" name="mobile-search" id="mobile-search" placeholder="Search in..." required>
                <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
            </form>



            <div class="social-icons">
                <a href="#" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>
            </div><!-- End .social-icons -->
        </div><!-- End .mobile-menu-wrapper -->
    </div><!-- End .mobile-menu-container -->

    <!-- Sign in / Register Modal -->




    <!-- Plugins JS File -->
    <script src="{{ asset('front/assets') }}/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('front/assets') }}/js/superfish.min.js"></script>
    <script src="{{ asset('front/assets') }}/js/bootstrap-input-spinner.js"></script>


    <!-- Main JS File -->
    <script src="{{ asset('front/assets') }}/js/main.js"></script>
    <script src="{{ asset('front/assets') }}/js/demos/demo-4.js"></script>
</body>


<!-- molla/login.html  22 Nov 2019 10:04:03 GMT -->
</html>
