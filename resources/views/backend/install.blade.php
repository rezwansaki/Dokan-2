<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name', 'Dokan-2') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ asset('adminlte/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/skins/_all-skins.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/iCheck/flat/blue.css')}}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/morris/morris.css')}}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datepicker/datepicker3.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/daterangepicker/daterangepicker-bs3.css')}}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
</head>

<body class="hold-transition login-page">

<div class="register-box">
    <div class="register-logo">
      <a href="{{ route('home')}}"><b>{{ config('app.name', 'Dokan-2') }}</b> Installation</a>
    </div>

    <div class="register-box-body">
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
      <form method="POST" action="{{ route('install.done') }}">
        @csrf
        <div class="form-group has-feedback">
          <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Full name">

          @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
          <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Install</button>
          </div><!-- /.col -->
        </div>
      </form>
    </div><!-- /.form-box -->
  </div><!-- /.register-box -->

   <!-- jQuery 2.1.4 -->
   <script src="{{ asset('adminlte/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
   <!-- jQuery UI 1.11.4 -->
   <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
   <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
   <script>
     $.widget.bridge('uibutton', $.ui.button);
   </script>
   <!-- Bootstrap 3.3.5 -->
   <script src="{{ asset('adminlte/bootstrap/js/bootstrap.min.js')}}"></script>
   <!-- Morris.js charts -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
   <script src="{{ asset('adminlte/plugins/morris/morris.min.js')}}"></script>
   <!-- Sparkline -->
   <script src="{{ asset('adminlte/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
   <!-- jvectormap -->
   <script src="{{ asset('adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
   <script src="{{ asset('adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
   <!-- jQuery Knob Chart -->
   <script src="{{ asset('adminlte/plugins/knob/jquery.knob.js')}}"></script>
   <!-- daterangepicker -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js')}}"></script>
   <script src="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.js')}}"></script>
   <!-- datepicker -->
   <script src="{{ asset('adminlte/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
   <!-- Bootstrap WYSIHTML5 -->
   <script src="{{ asset('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
   <!-- Slimscroll -->
   <script src="{{ asset('adminlte/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
   <!-- FastClick -->
   <script src="{{ asset('adminlte/plugins/fastclick/fastclick.min.js')}}"></script>
   <!-- AdminLTE App -->
   <script src="{{ asset('adminlte/dist/js/app.min.js')}}"></script>
   <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
   <script src="{{ asset('adminlte/dist/js/pages/dashboard.js')}}"></script>
   <!-- AdminLTE for demo purposes -->
   <script src="{{ asset('adminlte/dist/js/demo.js')}}"></script>


 </body>
</html>