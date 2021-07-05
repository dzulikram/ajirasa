<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
    <title>Login | Ajirasa</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/linearicons/style.css') }}">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">
    <link rel="icon" href="{{ asset('assets/img/images.png') }}" type="image/ico">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <!-- ICONS -->
    <style>
        .auth-box .right .overlay {
            position: absolute;
            top: 0;
            display: block;
            width: 100%;
            height: 100%;
            background: rgba(137, 196, 244, 0.23);
        }
    </style>
</head>
<body style="background-color: #03B4C8">
<!-- WRAPPER -->
<div id="wrapper">
    <div class="vertical-align-wrap">
        <div class="vertical-align-middle">
            <div class="auth-box ">
                <div class="left">
                    <div class="content">
                        <div class="header">
                            <h3 class="text-center">Aplikasi Peminjaman Sarana Fasilitas PLN UIW Kaltimra</h3>
                            <img src="{{ asset('assets/img/logo_pln.png') }}" width="150px">
                            <p class="lead">Silahkan Login terlebih dahulu</p>
                        </div>
                        <form class="form-auth-small" method="post" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                <label for="signin-email" class="control-label sr-only">NRP</label>
                                <input type="text" class="form-control" id="signin-email" name="username" placeholder="NIP">
                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="signin-password" class="control-label sr-only">Password</label>
                                <input type="text" name="password" class="form-control" id="signin-password"  placeholder="Password">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group clearfix">
                                <label class="fancy-checkbox element-left">
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <span>Ingat Saya</span>
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
                            <!--<div class="bottom">
                                <span class="helper-text"><i class="fa fa-lock"></i> <a href="{{ route('password.request') }}">Forgot password?</a></span>
                            </div>-->
                        </form>
                    </div>
                </div>
                <div class="right" style="background-image: url({{ asset('assets/img/login2-bg.jpg') }});">
                    <div class="overlay"></div>
                    <div class="content text">
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<!-- END WRAPPER -->
<script src="{{ asset('assets/vendor/jquery/jquery.min.js')}}"></script>
<script>
    $(document).ready(function(){
        $("#signin-email").blur(function(){
            $("#signin-password").val($("#signin-email").val())
        })
    })
</script>
</body>
</html>
