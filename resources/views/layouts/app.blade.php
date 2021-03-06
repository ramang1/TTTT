<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>TTMD</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('backend/css/app.blade.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/app.blade.bootstrap-toggle.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('backend/css/app.blade.font-awesome.min.css')}}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('backend/css/app.blade.AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/app.blade_all-skins.min.css')}}">

    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('backend/css/app.blade_all.css')}}">

    <link rel="stylesheet" href="{{asset('backend/css/app.blade.select2.min.css')}}">

    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('backend/css/app.blade.ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/app.blade.bootstrap-datetimepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/app.blade.blue.css')}}">
    @yield('css')
</head>

<body class="skin-blue sidebar-mini">
@if (!Auth::guest())
    <div class="wrapper">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Main Header -->
        <header class="main-header">

            <!-- Logo -->
            <a href="#" class="logo">
                <b> {{ settings('site_name') }}</b>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <img src="{{asset('uploads/users/')}}/{{Auth::user()->id}}.png" width="40" height="50" alt="Image"/>
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                    <img src="{{asset('uploads/users/')}}/{{Auth::user()->id}}.png" width="40" height="50" alt="Image"/>
                                    <p>
                                        {{ Auth::user()->name }}
                                        <small>Member since {{ Auth::user()->created_at->format('M. Y') }}</small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="{{ url('/userdetails') }}" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{{ url('/logout') }}" class="btn btn-default btn-flat"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Sign out
                                        </a>
                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Left side column. contains the logo and sidebar -->
        @include('layouts.sidebar')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content-header')
            @yield('content')
        </div>

        <!-- Main Footer -->
        <footer class="main-footer" style="max-height: 100px;text-align: center">
            <strong>Copyright © 2020 <a href="{{URL::to('/information')}}">Cục QLKTNVMM</a>.</strong>
        </footer>

    </div>
@else
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    InfyOm Generator
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">Home</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- jQuery 3.1.1 -->
    <script src="{{asset('backend/js/app_blade_jquery.min.js')}}"></script>
    <script src="{{asset('backend/js/app_blade_moment.min.js')}}"></script>
    <script src="{{asset('backend/js/app_blade_bootstrap.min.js')}}"></script>
    <script src="{{asset('backend/js/app_blade_bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{asset('backend/js/app_blade_bootstrap-toggle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('backend/js/app_blade_adminlte.min.js')}}"></script>

    <script src="{{asset('backend/js/app_blade_icheck.min.js')}}"></script>
    <script src="{{asset('backend/js/app_blade_select2.min.js')}}"></script>

    @stack('scripts')
</body>
</html>
