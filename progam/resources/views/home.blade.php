<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title>Belanja Kuy</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="description" content="Hound is a Dashboard & Admin Site Responsive Template by hencework." />
	<meta name="keywords" content="admin, admin dashboard, admin template, cms, crm, Hound Admin, Houndadmin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application" />
	<meta name="author" content="hencework"/>
	
	<!-- Favicon -->
	<link rel="apple-touch-icon-precomposed" sizes="57x57" href="{{ asset('dist/img/favicon/apple-touch-icon-57x57.png') }}" />
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('dist/img/favicon/apple-touch-icon-114x114.png') }}" />
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('dist/img/favicon/apple-touch-icon-72x72.png') }}" />
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('dist/img/favicon/apple-touch-icon-144x144.png') }}" />
	<link rel="apple-touch-icon-precomposed" sizes="60x60" href="{{ asset('dist/img/favicon/apple-touch-icon-60x60.png') }}" />
	<link rel="apple-touch-icon-precomposed" sizes="120x120" href="{{ asset('dist/img/favicon/apple-touch-icon-120x120.png') }}" />
	<link rel="apple-touch-icon-precomposed" sizes="76x76" href="{{ asset('dist/img/favicon/apple-touch-icon-76x76.png') }}" />
	<link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{ asset('dist/img/favicon/apple-touch-icon-152x152.png') }}" />
	<link rel="icon" type="image/png" href="{{ asset('dist/img/favicon/favicon-196x196.png') }}" sizes="196x196" />
	<link rel="icon" type="image/png" href="{{ asset('dist/img/favicon/favicon-96x96.png') }}" sizes="96x96" />
	<link rel="icon" type="image/png" href="{{ asset('dist/img/favicon/favicon-32x32.png') }}" sizes="32x32" />
	<link rel="icon" type="image/png" href="{{ asset('dist/img/favicon/favicon-16x16.png') }}" sizes="16x16" />
	<link rel="icon" type="image/png" href="{{ asset('dist/img/favicon/favicon-128.png') }}" sizes="128x128" />
	<meta name="application-name" content="&nbsp;"/>
	<meta name="msapplication-TileColor" content="#FFFFFF" />
	<meta name="msapplication-TileImage" content="mstile-144x144.png" />
	<meta name="msapplication-square70x70logo" content="{{ asset('dist/img/favicon/mstile-70x70.png') }}" />
	<meta name="msapplication-square150x150logo" content="{{ asset('dist/img/favicon/mstile-150x150.png') }}" />
	<meta name="msapplication-wide310x150logo" content="{{ asset('dist/img/favicon/mstile-310x150.png') }}" />
	<meta name="msapplication-square310x310logo" content="{{ asset('dist/img/favicon/mstile-310x310.png') }}" />
	<link rel="apple-touch-icon-precomposed" sizes="57x57" href="{{ asset('dist/img/favicon/apple-touch-icon-57x57.png') }}" />
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('dist/img/favicon/apple-touch-icon-114x114.png') }}" />
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('dist/img/favicon/apple-touch-icon-72x72.png') }}" />
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('dist/img/favicon/apple-touch-icon-144x144.png') }}" />
	<link rel="apple-touch-icon-precomposed" sizes="60x60" href="{{ asset('dist/img/favicon/apple-touch-icon-60x60.png') }}" />
	<link rel="apple-touch-icon-precomposed" sizes="120x120" href="{{ asset('dist/img/favicon/apple-touch-icon-120x120.png') }}" />
	<link rel="apple-touch-icon-precomposed" sizes="76x76" href="{{ asset('dist/img/favicon/apple-touch-icon-76x76.png') }}" />
	<link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{ asset('dist/img/favicon/apple-touch-icon-152x152.png') }}" />
	<link rel="icon" type="image/png" href="{{ asset('dist/img/favicon/favicon-196x196.png') }}" sizes="196x196" />
	<link rel="icon" type="image/png" href="{{ asset('dist/img/favicon/favicon-96x96.png') }}" sizes="96x96" />
	<link rel="icon" type="image/png" href="{{ asset('dist/img/favicon/favicon-32x32.png') }}" sizes="32x32" />
	<link rel="icon" type="image/png" href="{{ asset('dist/img/favicon/favicon-16x16.png') }}" sizes="16x16" />
	<link rel="icon" type="image/png" href="{{ asset('dist/img/favicon/favicon-128.png') }}" sizes="128x128" />
	<meta name="application-name" content="&nbsp;"/>
	<meta name="msapplication-TileColor" content="#FFFFFF" />
	<meta name="msapplication-TileImage" content="{{ asset('dist/img/favicon/mstile-144x144.png') }}" />
	<meta name="msapplication-square70x70logo" content="{{ asset('dist/img/favicon/mstile-70x70.png') }}" />
	<meta name="msapplication-square150x150logo" content="{{ asset('dist/img/favicon/mstile-150x150.png') }}" />
	<meta name="msapplication-wide310x150logo" content="{{ asset('dist/img/favicon/mstile-310x150.png') }}" />
	<meta name="msapplication-square310x310logo" content="{{ asset('dist/img/favicon/mstile-310x310.png') }}" />

	<!-- Fancy-Buttons CSS -->
	<link href="{{ asset('dist/css/fancy-buttons.css') }}" rel="stylesheet" type="text/css">

	<!-- Data table CSS -->
	<link href="{{ asset('vendors/bower_components/datatables/media/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('vendors/bower_components/dropify/dist/css/dropify.min.css') }}" rel="stylesheet" type="text/css"/>

	<!-- Custom CSS -->
	<link href="{{ asset('dist/css/style.css') }}" rel="stylesheet" type="text/css">

	<style>
		.d-flex {
			display: flex;
		}

		.justify-content-between {
			justify-content: space-between;
		}

		.align-items-center {
			align-items: center;
		}

		.mb-0 {
			margin-bottom: 0;
		}
	</style>

	@stack('styles')
	@include('sweetalert::alert')

</head>

<body>

	<!--Preloader-->
	<div class="preloader-it">
		<div class="la-anim-1"></div>
	</div>
    {{-- @guest --}}

    {{-- @yield('content') --}}

    {{-- @else --}}
	<!--/Preloader-->
    <div class="wrapper theme-4-active pimary-color-orange">
        {{-- Navbar --}}
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="mobile-only-brand pull-left">
				<div class="nav-header pull-left">
					<div class="logo-wrap">
						<a href="/">
							<img class="brand-img" src="{{ asset('dist/img/shop.jpg') }}" width="20" alt="brand"/>
							<span class="brand-text">Belanja Kuy</span>
						</a>
					</div>
				</div>	
				<a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);"><i class="zmdi zmdi-menu"></i></a>
				<a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-more"></i></a>
			</div>
		</nav>

		{{-- Sidebar --}}
		<div class="fixed-sidebar-left">
			<ul class="nav navbar-nav side-nav nicescroll-bar">
				@if (Route::has('login'))
					@auth
						<li class="navigation-header">
							<span>Main</span> 
							<i class="zmdi zmdi-more"></i>
						</li>
						<li>
							<a href="/" class="nav-link {{ Request::segment(1) == '' ? 'active' : '' }}">
								<div class="pull-left"><i class="zmdi zmdi-store mr-20"></i><span class="right-nav-text">Home</span></div>
								<div class="clearfix"></div>
							</a>
						</li>
						@can('checkcostumer')
						<li>
							<a href="/pembelian" class="nav-link {{ Request::segment(1) == 'pembelian' ? 'active' : '' }}">
								<div class="pull-left"><i class="zmdi zmdi-money mr-20"></i><span class="right-nav-text">Pemesanan Produk</span></div>
								<div class="clearfix"></div>
							</a>
						</li>
						@endcan
						@can('checkmerchant')
						<li>
							<a href="/produk" class="nav-link {{ Request::segment(1) == 'produk' ? 'active' : '' }}">
								<div class="pull-left"><i class="zmdi zmdi-shopping-cart-plus mr-20"></i><span class="right-nav-text">Produk</span></div>
								<div class="clearfix"></div>
							</a>
						</li>
						<li>
							<a href="/pembelian" class="nav-link {{ Request::segment(1) == 'pembelian' ? 'active' : '' }}">
								<div class="pull-left"><i class="zmdi zmdi-money mr-20"></i><span class="right-nav-text">Pemesanan Produk</span></div>
								<div class="clearfix"></div>
							</a>
						</li>
						@endcan
						<li><hr class="light-grey-hr mb-10"/></li>
						<li>
							<a href="/logout">
								<div class="pull-left"><i class="zmdi zmdi zmdi-power mr-20"></i><span class="right-nav-text">Logout</span></div>
								<div class="clearfix"></div>
							</a>
						</li>
					@else
						<li class="navigation-header">
							<span>Main</span> 
							<i class="zmdi zmdi-more"></i>
						</li>
						<li>
							<a href="/" class="nav-link active">
								<div class="pull-left"><i class="zmdi zmdi-home mr-20"></i><span class="right-nav-text">Home</span></div>
								<div class="clearfix"></div>
							</a>
						</li>
						<li>
							<a href="#" data-toggle="modal" data-target="#modalLogin"><div class="pull-left"><i class="zmdi zmdi-sign-in mr-20"></i><span class="right-nav-text">Login</span></div><div class="pull-right"></div><div class="clearfix"></div></a>
						</li>
						<li>
							<a href="#" data-toggle="modal" data-target="#modalRegister"><div class="pull-left"><i class="zmdi zmdi-assignment-account mr-20"></i><span class="right-nav-text">Register</span></div><div class="pull-right"></div><div class="clearfix"></div></a>
						</li>
						<li><hr class="light-grey-hr mb-10"/></li>
					@endauth
				@endif
			</ul>
		</div>

		<!-- Main Content -->
		<div class="page-wrapper">
            {{-- <div class="container-fluid"> --}}
				
				<!-- Title -->
				{{-- <div class="row heading-bg"> --}}
					{{-- <div class="col-md-12"> --}}
						@yield('content')
					{{-- </div> --}}
					<!-- /Breadcrumb -->
				{{-- </div> --}}
				<!-- /Title -->
			
			{{-- </div> --}}
		</div>
        <!-- /Main Content -->
	</div>
	
    <!-- /#wrapper -->

    {{-- @endguest --}}
	
	<!-- JavaScript -->
	
    <!-- jQuery -->
	<script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('vendors/bower_components/jquery/dist/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('vendors/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

	<script src="{{ asset('vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js') }}"></script>
    
	<!-- Data table JavaScript -->
	<script src="{{ asset('vendors/bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('dist/js/dataTables-data.js') }}"></script>
	
	<!-- Slimscroll JavaScript -->
	<script src="{{ asset('dist/js/jquery.slimscroll.js') }}"></script>
	
	<!-- Owl JavaScript -->
	<script src="{{ asset('vendors/bower_components/owl.carousel/dist/owl.carousel.min.js') }}"></script>
	
	<!-- Switchery JavaScript -->
	<script src="{{ asset('vendors/bower_components/switchery/dist/switchery.min.js') }}"></script>
	
	<!-- Fancy Dropdown JS -->
	<script src="{{ asset('dist/js/dropdown-bootstrap-extended.js') }}"></script>
	
	<!-- Init JavaScript -->
	<script src="{{ asset('dist/js/init.js') }}"></script>

	@stack('scripts')
</body>

</html>