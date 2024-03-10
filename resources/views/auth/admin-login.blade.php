<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Palmoasis Holidays Cpanel:: LogIn</title>
    <!-- Bootstrap core CSS-->
    <link href="{{ asset('backend/login/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="{{ asset('backend/login/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="{{ asset('backend/login/css/sb-admin.css') }}" rel="stylesheet">

</head>

<body class="bg-dark">
<div class="container">
    <div class="card card-login mx-auto mt-5">

        <div class="card-header">Login</div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
                <div class="form-group">
                    <label for="email" class="col-form-label">Username</label>
                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                    @error('username')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password" class="col-form-label">Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>


                <input name="submit" type="submit" id="submit" value="Login" class="btn btn-primary btn-block" style="cursor: pointer" />
            </form>
        </div>
    </div>
</div>
<!-- Bootstrap core JavaScript-->
<script src="{{ asset('backend/login/js/jquery.min.js') }}"></script>
<script src="{{ asset('backend/login/js/bootstrap.bundle.min.js') }}"></script>
<!-- Core plugin JavaScript-->
<script src="{{ asset('backend/login/js/jquery.easing.min.js') }}"></script>
</body>

</html>
