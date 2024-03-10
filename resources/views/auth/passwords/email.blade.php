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
                        <h2>{{trans('messages.Reset-password')}} : </h2>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @else
                            <form action="{{route('member.password.email')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="name">
                                        {{trans('messages.Enter-your-email')}}
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="name">
                                        {{trans('messages.Email')}}
                                    </label>
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           name="email" value="{{ old('email') }}" required autocomplete="email"
                                           autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-default" name="forget_password_submit"
                                            id="forget_password_submit">
                                        {{trans('messages.Send')}}
                                    </button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
