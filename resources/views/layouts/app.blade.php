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
    {{-- <link href='http://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900' rel='stylesheet' type='text/css'/> --}}
    <link type="text/css" rel="stylesheet" href="{{ asset('css/theme-default/bootstrap.css?1422792965')}}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('css/theme-default/materialadmin.css?1425466319')}}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('css/theme-default/font-awesome.min.css?1422529194')}}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('css/theme-default/material-design-iconic-font.min.css?1421434286')}}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('css/theme-default/libs/toastr/toastr.css?1425466569')}}" />
    @stack('form-css')

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
		<script type="text/javascript" src="{{asset('js/libs/utils/html5shiv.js?1403934957')}}"></script>
		<script type="text/javascript" src="{{asset('js/libs/utils/respond.min.js?1403934956')}}"></script>
		<![endif]-->
        <!-- END STYLESHEETS -->

        <!-- Plugin css for this page -->
        @stack('datatable-css')
        @stack('print-css')
        <!-- End plugin css for this page -->
        <!-- Layout styles -->
        <!-- End layout styles -->
        <!-- Form Steps -->
        <!-- Style css -->
        <link type="text/css" rel="stylesheet" href="{{ asset('css/style.css')}}" />

</head>
<body class="menubar-hoverable header-fixed menubar-pin ">

    <!-- BEGIN HEADER -->
    @include('includes.header')
    <!-- END HEADER -->

    <!-- BEGIN BASE -->
    <div id="base">
        <!-- BEGIN OFFCANVAS LEFT -->
        <div class="offcanvas">
        </div><!--end .offcanvas-->
        <!-- END OFFCANVAS LEFT -->

        <!-- BEGIN CONTENT-->
        <div id="content">
            <section>
                <div class="section-body contain-lg">
                    <!--**********************************
                        Content body start
                    ***********************************-->
                    @yield('content')
                    <!--**********************************
                        Content body end
                    ***********************************-->

                </div>
            </section>
        </div><!--end #content-->
        <!-- END CONTENT -->

        <!-- BEGIN MENUBAR-->
        @include('includes.sidebar')
        <!-- END MENUBAR -->

        <!-- BEGIN OFFCANVAS RIGHT -->
        <div class="offcanvas">
        </div><!--end .offcanvas-->
        <!-- END OFFCANVAS RIGHT -->

    </div><!--end #base-->
    <!-- END BASE -->

    <!-- BEGIN JAVASCRIPT -->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- BEGIN JAVASCRIPT -->
    <script src="{{ asset('js/libs/jquery/jquery-1.11.2.min.js')}}"></script>
    <script src="{{ asset('js/libs/jquery/jquery-migrate-1.2.1.min.js')}}"></script>
    @stack('jq-ui-js')
    <script src="{{ asset('js/libs/bootstrap/bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/libs/spin.js/spin.min.js')}}"></script>
    <script src="{{ asset('js/libs/autosize/jquery.autosize.min.js')}}"></script>
    @stack('form-js')
    <script src="{{ asset('js/libs/nanoscroller/jquery.nanoscroller.min.js')}}"></script>
    <script src="{{ asset('js/libs/toastr/toastr.js')}}"></script>
    <script src="{{ asset('js/core/source/App.js')}}"></script>
    <script src="{{ asset('js/core/source/AppNavigation.js')}}"></script>
    <script src="{{ asset('js/core/source/AppForm.js')}}"></script>
    <script src="{{ asset('js/core/source/AppCard.js')}}"></script>
    <script src="{{ asset('js/core/source/AppVendor.js')}}"></script>
    {{--
    <script src="{{ asset('js/core/source/AppOffcanvas.js')}}"></script>
    <script src="{{ asset('js/core/source/AppNavSearch.js')}}"></script>
    --}}
    <!-- END JAVASCRIPT -->

    @stack('datatable-js')
    @stack('datatable-init-js')
    @stack('jqvalidation-js')
    @stack('form-init-js')
    @stack('dashboard-js')

    <script>
        $(document).ready(function () {
            @if ($errors->any())
                toastr.error('<div class="text-lg text-bold col-xs-12" >@foreach ($errors->all() as $error ){{$error}}<br/>@endforeach</div>', '{{__('Errors!')}}',{"positionClass": "toast-top-center","closeButton": true,"timeOut": 0})
            @endif

            @foreach (['success', 'error', 'warning', 'info'] as $msgtype)
                @if (Session::has($msgtype))
                    toastr['{{$msgtype}}']('<div class="text-lg text-bold col-xs-12" >{{Session::get($msgtype)}}</div >', '{{__(strtoupper($msgtype))}}',{"positionClass": "toast-top-center","closeButton": true,"timeOut": 0})
                @endif
            @endforeach

        })
    </script>

</body>
</html>
