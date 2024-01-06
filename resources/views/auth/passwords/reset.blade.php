@extends('layouts.app')
@section('content')
    <div class="page-head">
        <div class="container">
            <div class="row">
                <div class="page-head-content">
                    <h1 class="page-title">{{trans('messages.Reset-password')}} </h1>
                </div>
            </div>
        </div>
    </div>
    <!-- End page header -->
    <!-- register-area -->
    <div class="register-area" style="background-color: rgb(249, 249, 249);">
        <div class="container">
            <div class="col-md-12">
                <div class="box-for overflow">
                    <div class="col-md-12 col-xs-12 register-blocks">
                        <h2>{{trans('messages.Reset-password')}}: </h2>
                        <form action="{{route('member.password.update')}}" method="post">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="form-group">
                                <label for="name">
                                    {{trans('messages.Enter-your-new-password')}}
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="password">
                                    {{trans('messages.Email')}}
                                </label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ $email ?? old('email') }}" required autocomplete="email"
                                       autofocus>

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
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password"
                                       required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">
                                    {{trans('messages.confirm-password')}}
                                </label>
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation" required autocomplete="new-password">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-default" name="reset_password_submit"
                                        id="reset_password_submit">
                                    {{trans('messages.ok')}}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
