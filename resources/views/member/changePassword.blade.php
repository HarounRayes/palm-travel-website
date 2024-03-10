@extends('layouts.app')
@section('content')
    <div class="page-head">
        <div class="container">
            <div class="row">
                <div class="page-head-content">
                    <h1 class="page-title">{{trans('messages.Reset_password')}} </h1>
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
                        <h2>{{trans('messages.Change_password')}} : </h2>
                        @foreach ($errors->all() as $error)

                            <p class="text-danger">{{ $error }}</p>

                        @endforeach
                        <form action="{{route('member.change-password.save')}}" method="post" id="change_password_form" name="change_password_form">
                            @csrf
                            <div class="form-group">
                                <label for="password">
                                  {{trans('messages.Old_password')}}
                                </label>
                                <input type="password" class="form-control" id="old_password" name="old_password" required />
                            </div>
                            <div class="form-group">
                                <label for="password">
                                    {{trans('messages.enter_new_password')}}
                                </label>
                                <input type="password" class="form-control" id="new_password" name="new_password" required />
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-default" name="change_password_submit" id="change_password_submit">
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
