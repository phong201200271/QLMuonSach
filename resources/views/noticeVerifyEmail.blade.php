<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Forgot Password</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition login-page">
<div class="login-box" style="width: 25%">
    {{dd(session('user'))}}
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            @if(isset($success))
                <div class="alert alert-success" role="alert" style="text-align: center">
                    {{$success}}
                </div>
            @endif
            <p class="login-box-msg">Hãy truy cập Email để có thể kích hoạt tài khoản</p>
            <form action="{{route('resendVerifyEmail')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-12">
{{--                        <input type="hidden" name="mail" value="{{$user->mail}}">--}}
                        <button type="submit" class="btn btn-primary btn-block">Gửi lại yêu cầu kích hoạt tài khoản</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
</body>
</html>