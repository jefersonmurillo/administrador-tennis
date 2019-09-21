<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Administrador Club Tennis</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('template/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('template/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('template/bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('template/dist/css/AdminLTE.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('template/plugins/iCheck/square/blue.css') }}">

    <script src="{{ asset('plugins/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/dist/sweetalert2.min.css') }}">

</head>
<body class="hold-transition login-page" style="background-image: url({{ asset('images/fondosesion.jpg') }});">
<div class="login-box">
    <div class="login-logo">
        <a href="{{ route('index') }}">
            <center>
                <img src="{{ asset('images/logoclubtennis.png') }}" alt="" width="150" height="150">
            </center>
        </a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <form method="POST" action="{{ route('password.change') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="row">
                <!-- /.col -->
                <div class="col-sm-12">
                    <center>
                        <h4>Recuperación de contraseña</h4>
                    </center>
                </div>
                <!-- /.col -->
            </div>
            <div class="form-group has-feedback">

                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Nueva contraseña" name="password" required>

                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirme la contraseña" required>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>


            <div class="row">
                <!-- /.col -->
                <div class="col-sm-12">
                    <center>
                        <button type="submit" class="btn btn-primary">
                            {{ __('Cambiar contraseña') }}
                        </button>
                    </center>

                </div>
                <!-- /.col -->
            </div>

        </form>

        {{--<a href="{{ route('password.reset') }}">Olvidé mi contraseña</a><br>--}}

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{ asset('template/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('template/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('template/plugins/iCheck/icheck.min.js') }}"></script>

<script>
    @if($errors->has('password'))
        Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'Las contraseñas no son iguales',
        });
    @endif

    @if($errors->has('email'))
        Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'Este email no corresponde a una cuenta registrada!',
        });
    @endif

    @if($errors->has('status') AND $errors->get('status')[0] == 'error')
        Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'Ocurrio un error al cambiar la contraseña, Por favor intentalo nuevamente',
        });
    @elseif($errors->has('status') AND $errors->get('status')[0] == 'ok')
        Swal.fire(
            'Operación Exitosa!',
            'Inforamación guardada.',
            'success'
        );
    @endif

</script>
</body>
</html>


