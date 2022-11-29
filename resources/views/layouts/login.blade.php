<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- BEGIN META -->
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="">
	<meta name="description" content="">
	<meta name="author" content="AASOFT">
	<meta name="robots" content="">
	<meta property="og:title" content="">
	<meta property="og:description" content="">
	<meta name="format-detection" content="telephone=no">
    <!-- END META -->

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


	<!-- PAGE TITLE HERE -->
	<title>
        @hasSection('pageTitle')
            @yield('pageTitle')
        @else
            {{ config('app.name', 'PSMS') }}
        @endif('pageTitle')
    </title>

	<!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png')}}">

    <!-- BEGIN STYLESHEETS -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900' rel='stylesheet' type='text/css'/>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/theme-default/bootstrap.css?1422792965')}}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('css/theme-default/materialadmin.css?1425466319')}}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('css/theme-default/font-awesome.min.css?1422529194')}}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('css/theme-default/material-design-iconic-font.min.css?1421434286')}}" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script type="text/javascript" src="{{asset('js/libs/utils/html5shiv.js?1403934957')}}"></script>
		<script type="text/javascript" src="{{asset('js/libs/utils/respond.min.js?1403934956')}}"></script>
		<![endif]-->
    <!-- END STYLESHEETS -->


    <!-- Plugin css for this page -->

    <!-- End plugin css for this page -->
    <!-- Layout styles -->
    <!-- End layout styles -->
    <!-- Form Steps -->
	<!-- Style css -->

</head>
<body class="menubar-hoverable header-fixed">
    <!--**********************************
        Content body start
    ***********************************-->
    @yield('content')
    <!--**********************************
        Content body end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- BEGIN JAVASCRIPT -->
    <script src="{{ asset('js/libs/jquery/jquery-1.11.2.min.js')}}"></script>
    <script src="{{ asset('js/libs/jquery/jquery-migrate-1.2.1.min.js')}}"></script>
    <script src="{{ asset('js/libs/bootstrap/bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/libs/spin.js/spin.min.js')}}"></script>
    <script src="{{ asset('js/libs/autosize/jquery.autosize.min.js')}}"></script>
    <script src="{{ asset('js/libs/nanoscroller/jquery.nanoscroller.min.js')}}"></script>
    <script src="{{ asset('js/core/source/App.js')}}"></script>
    <script src="{{ asset('js/core/source/AppNavigation.js')}}"></script>
    <script src="{{ asset('js/core/source/AppOffcanvas.js')}}"></script>
    <script src="{{ asset('js/core/source/AppCard.js')}}"></script>
    <script src="{{ asset('js/core/source/AppForm.js')}}"></script>
    <script src="{{ asset('js/core/source/AppNavSearch.js')}}"></script>
    <script src="{{ asset('js/core/source/AppVendor.js')}}"></script>
    <script src="{{ asset('js/core/demo/Demo.js')}}"></script>
    <!-- END JAVASCRIPT -->

    @stack('jqvalidation-js')

</body>
</html>
