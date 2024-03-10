@extends('layouts.app')
@section('content')
<div class="page-head">
    <div class="container">
        <div class="row">
            <div class="page-head-content">
                <h1 class="page-title">{{trans('messages.New_account')}} / {{trans('messages.Sign_in')}}</h1>
            </div>
        </div>
    </div>
</div>
<!-- End page header -->
<!--<div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"></div>-->

<!-- register-area -->
<div class="register-area" style="background-color: rgb(249, 249, 249);">
    <div class="container">

        <div class="col-md-6">
            <div class="box-for overflow">
                <div class="col-md-12 col-xs-12 register-blocks">
                    <h2>{{trans('messages.New_account')}} : </h2>
                    <form method="POST" action="{{ route('member.register.submit') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">
                                {{trans('messages.Name')}}
                            </label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">
                                {{trans('messages.Email')}}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">
                                {{trans('messages.Phone')}}</label>
                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                                   name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">
                                {{trans('messages.Password')}}
                            </label>
                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror" name="password" required
                                   autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-default" name="register_submit" id="register_submit">
                                {{trans('messages.Register')}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box-for overflow">
                <div class="col-md-12 col-xs-12 login-blocks">
                    <h2> {{trans('messages.Login')}} : </h2>
                    <form method="POST" action="{{ route('member.login.submit') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">
                                {{trans('messages.Email')}}
                            </label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">
                                {{trans('messages.Password')}}
                            </label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-default" name="login_submit">
                                {{trans('messages.Login')}}
                            </button>
                            <a href="{{route('member.password.request')}}" class="btn btn-default">
                                {{trans('messages.Forget-password')}}
                                 </a>
                        </div>
                    </form>
                    <br>
                    <br>


                </div>

            </div>
        </div>

    </div>
</div>
@endsection
