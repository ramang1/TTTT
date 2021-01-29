<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>InfyOm Laravel Generator</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('backend/css/email.blade.bootstrap.min.css')}}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('backend/css/email.blade.font-awesome.min.css')}}">

    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('backend/css/email.blade.ionicons.min.css')}}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('backend/css/email.blade.AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/email.blade_all-skins.min.css')}}">

    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('backend/css/email.blade__all.css')}}">


</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="{{ url('/home') }}"><b>PKT-2020 </b>Generator</a>
    </div>

    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Enter Email to reset password</p>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="post" action="{{ url('/password/email') }}">
            @csrf

            <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('email'))
                    <span class="help-block">
                    <strong>{{ $errors->first('email')}}</strong>
                </span>
                @endif
            </div>

            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary pull-right">
                        <i class="fa fa-btn fa-envelope"></i> Send Password Reset Link
                    </button>
                </div>
            </div>

        </form>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<script src="{{asset('backend/js/email.blade.jquery.min.js')}}"></script>
<script src="{{asset('backend/js/email.blade.bootstrap.min.js')}}"></script>

<!-- AdminLTE App -->
<script src="{{asset('backend/js/email.blade.adminlte.min.js')}}"></script>

<script src="{{asset('backend/js/email.blade.icheck.min.js')}}"></script>
</body>
</html>
