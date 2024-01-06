@extends('layouts.app')

@section('content')

    <div class="page-head">
        <div class="container">
            <div class="row">
                <div class="page-head-content">
                    <h1 class="page-title">{{trans('messages.My_account')}} </h1>
                </div>
            </div>
        </div>
    </div>
    <!-- End page header -->

    <!-- register-area -->
    <div class="register-area" style="background-color: rgb(249, 249, 249);">
        <div class="container">

            <div class="row">
                <div class="panel with-nav-tabs flight_map_tap3">
                    <div class="panel-heading">
                        <ul class="nav nav-tabs pl15 pt10" style="padding:0px">
                            <li class="account-tab active">
                                <a href="#myinformation" data-toggle="tab">
                                    <i class="fa fa-user">
                                    </i>
                                    <br> {{trans('messages.My_information')}}
                                </a>
                            </li>
                            <li class="account-tab">
                                <a href="#myenquiries" data-toggle="tab">
                                    <i class="fa fa-mail-reply">
                                    </i>
                                    <br> {{trans('messages.My_Enquiries')}}
                                </a>
                            </li>
                            <li class="account-tab">
                                <a href="#myorders" data-toggle="tab">
                                    <img src="{{asset('img/bookmark_add.png')}}"
                                         style="width:20px;"/>
                                    <br> {{trans('messages.My_Favorites')}}
                                </a>
                            </li>
                            <li class="account-tab">
                                <a href="#mypament" data-toggle="tab">
                                    <i class="fa fa-shopping-basket">
                                    </i>
                                    <br> {{trans('messages.my_payments')}}
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="myinformation">
                                <h1 class="s-property-title">
                                    {{trans('messages.My_information')}}
                                </h1>

                                <div class="s-property-content">
                                    <form action="" method="post" id="register_form" name="register_form">
                                        <div class="form-group">
                                            <label for="name">
                                                {{trans('messages.Name')}}
                                            </label>
                                            <input type="text" class="form-control" id="name" name="name" required
                                                   disabled="true" value="{{$user->name}}"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">
                                                {{trans('messages.Email')}}</label>
                                            <input type="email" class="form-control" id="email" name="email" required
                                                   disabled="true" value="{{$user->email}}"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">
                                                {{trans('messages.Phone')}}</label>
                                            <input type="text" class="form-control" id="phone" name="phone" required
                                                   disabled="true" value="{{$user->phone}}"/>
                                        </div>
                                        <div class="form-group">
                                            <a href="{{route('member.change-password')}}"
                                               class="btn btn-default">
                                                {{trans('messages.Change_password')}}
                                            </a>
                                        </div>
                                    </form>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="myenquiries">
                                <h1 class="s-property-title">
                                    {{trans('messages.My_Enquiries')}}
                                </h1>

                                <div class="s-property-content">
                                    <div class="order-area">
                                        <div class="enquiry-package-name tab-custom-title">
                                            {{trans('messages.Package')}}
                                        </div>
                                        <div class="enquiry-package-date tab-custom-title">
                                            {{trans('messages.Date1')}}
                                        </div>
                                        <div class="enquiry-package-room tab-custom-title">
                                            {{trans('messages.Room_number')}}
                                        </div>

                                        <div class="enquiry-package-manage tab-custom-title">
                                            {{trans('messages.Manage')}}
                                        </div>
                                    </div>

                                    @if($enquiries->count() > 0)
                                        @foreach ($enquiries as $enquiry)
                                            @if ($enquiry->custom)
                                                <div class="order-area" id="enquiry-area-{{$enquiry->id}}">
                                                    <div class="enquiry-package-name custom">
                                                        {{trans('messages.Custom')}}
                                                    </div>
                                                    <div class="enquiry-package-date">
                                                            {{ date("d-m-Y", strtotime($enquiry->created_at))}}
                                                    </div>
                                                    <div class="enquiry-package-room">
                                                        @if ($enquiry->num_room)
                                                            {{$enquiry->num_room}}
                                                        @else
                                                            --
                                                        @endif
                                                    </div>
                                                    <div class="enquiry-package-manage">
                                                        <a class="" onclick="delete_enquiry('{{$enquiry->id}}')"><i
                                                                class="fa fa-trash"></i></a>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="order-area" id="enquiry-area-{{$enquiry->id}}">
                                                    <div class="enquiry-package-name">
                                                        {{$enquiry->package->name}}
                                                    </div>
                                                    <div class="enquiry-package-date">
                                                            {{ date("d-m-Y", strtotime($enquiry->created_at))}}
                                                    </div>
                                                    <div class="enquiry-package-room">
                                                        @if ($enquiry->num_room)
                                                            {{$enquiry->num_room}}
                                                        @else
                                                            --
                                                        @endif
                                                    </div>

                                                    <div class="enquiry-package-manage">
                                                        <a onclick="view_enquiry_details('{{$enquiry->id}}')">
{{--                                                        <a href="{{route('details',['symbol' => $enquiry->package->symbol,'hotel' => $enquiry->package->defaultHotel()->symbol])}}"--}}
{{--                                                           target="_blank">--}}
                                                            {{trans('messages.View')}}
                                                        </a>
                                                        |
                                                        <a class="" onclick="delete_enquiry('{{$enquiry->id}}')"><i
                                                                class="fa fa-trash"></i></a>
                                                    </div>


                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="tab-pane fade" id="myorders">
                                <h1 class="s-property-title">
                                    {{trans('messages.My_Favorites')}}
                                </h1>

                                <div class="s-property-content">
                                    <div class="order-area">
                                        <div class="order-package-name tab-custom-title">
                                            {{trans('messages.Package')}}
                                        </div>
                                        <div class="order-package-date tab-custom-title">
                                            {{trans('messages.Date1')}}
                                        </div>
                                        <div class="order-package-manage tab-custom-title">
                                            {{trans('messages.Manage')}}
                                        </div>
                                    </div>

                                    @if ($favorites->count() > 0)
                                        @foreach ($favorites as $favorite)
                                            <div class="order-area" id="order-area-{{$favorite->id}}">
                                                <div class="order-package-name">
                                                    {{$favorite->package->name}}
                                                </div>
                                                <div class="order-package-date">
                                                        {{date("d-m-Y", strtotime($favorite->created_at))}}
                                                </div>
                                                <div class="order-package-manage">
                                                    <a href="{{route('details',['symbol' => $favorite->package->symbol,'hotel' => $favorite->package->defaultHotel()->symbol])}}"
                                                       target="_blank">
                                                        {{trans('messages.View')}}
                                                    </a>
                                                    | <a class="" onclick="delete_favorite('{{$favorite->id }}')"
                                                         title="{{trans('messages.delete_from_favorites')}}">
                                                        <i class="fa fa-trash"></i></a>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif

                                </div>
                            </div>
                            <div class="tab-pane fade " id="mypament">
                                <h1 class="s-property-title">
                                    {{trans('messages.my_payments')}}
                                </h1>
                                <div class="s-property-content">
                                    <div class="order-area">
                                        <div class="order-package-name tab-custom-title">
                                            {{trans('messages.Package')}}
                                        </div>
                                        <div class="order-package-date tab-custom-title">
                                            {{trans('messages.Date1')}}
                                        </div>
                                        <div class="order-package-manage tab-custom-title">
                                            {{trans('messages.Cost')}}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
