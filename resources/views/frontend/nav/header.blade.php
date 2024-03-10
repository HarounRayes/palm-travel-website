<div class="header-connect">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-sm-8  col-xs-12">
                <div class="header-half header-call">
                    <p style="color:white;">
                        @if(Config::get('site_settings.office') != '')
                            <span><i class="pe-7s-call"></i> <b>
                                            <a href="tel:{{Config::get('site_settings.office')}} " style="color:#fff">
                                             {{Config::get('site_settings.office')}}
                                            </a></b></span>
                        @endif
                        @if(Config::get('site_settings.email') != '')
                            <span><i class="pe-7s-mail"></i> <b>
                                            <a href="mailto:{{Config::get('site_settings.email')}}" style="color:#fff">
                                         {{Config::get('site_settings.email')}}
                                            </a></b></span>
                        @endif
                    </p>
                </div>
            </div>
            <div class="col-md-3 col-sm-1"></div>
            <div class="col-md-4 col-sm-3 col-xs-12 navbar-ot-text-right">
                <div class="header-half header-social">
                    <ul class="list-inline">
                        @if(Config::get('site_settings.facebook') != '')
                            <li>
                                <a href="{{Config::get('site_settings.facebook')}}" target="_blank">
                                    <i class="fab fa-facebook"></i>
                                </a>
                            </li>
                        @endif
                        @if(Config::get('site_settings.twitter') != '')
                            <li>
                                <a href="{{Config::get('site_settings.twitter')}}" target="_blank">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>
                        @endif
                        @if(Config::get('site_settings.youtube') != '')
                            <li>
                                <a href="{{Config::get('site_settings.youtube')}}" target="_blank">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            </li>
                        @endif
                        @if(Config::get('site_settings.instagram') != '')
                            <li>
                                <a href="{{Config::get('site_settings.instagram')}}" target="_blank">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </li>
                        @endif
                        <li>
                            @if (app()->getLocale() != 'en')
                                <a href="{{route('setlocale','en')}}">
                                    {{trans('messages.English')}}
                                </a>
                            @else
                                <a href="{{route('setlocale','ar')}}">
                                    {{trans('messages.Arabic')}}
                                </a>
                            @endif
                        </li>

                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>
<!--End top header -->

<nav class="navbar navbar-default ">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigation">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand navbar-brand-custom" href="{{route('home')}}"><img
                    src="{{asset('img/Artboard 1@3x.png')}}" alt="" style="height: 40px !important;"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse yamm" id="navigation">
            <div class="button navbar-ot-right" id="member-zone-div" style="padding-top: 17px;">

                @if(!Auth::guard('member')->check())
                    <a class="navbar-btn nav-button wow bounceInRight login"
                       href="{{route('member.login')}}"
                       data-wow-delay="0.45s">
                        {{trans('messages.Login')}}
                    </a>

                    <button class="navbar-btn nav-button nav-button wow fadeInRight register"
                            onclick="openEnquiryForm(0)" data-wow-delay="0.48s">
                        {{trans('messages.Enquiry')}}
                    </button>
                @else
                    <span class="wow bounceInRight span-welcome" data-wow-delay="0.45s">
                                {{trans('messages.welcome2')}} {{\Illuminate\Support\Facades\Auth::guard('member')->user()->name}}
                            </span>
                    <a class="navbar-btn nav-button wow bounceInRight login" href="{{route('member.logout')}}"
                       data-wow-delay="0.45s" title=" {{trans('messages.Logout')}}">
                        <i class="fa fa-sign-out-alt"></i>
                    </a>
                    <a class="navbar-btn nav-button wow bounceInRight login" href="{{route('member.account')}}"
                       data-wow-delay="0.45s" title=" {{trans('messages.My account')}}">
                        <i class="fa fa-user"></i>
                    </a>
                    <button class="navbar-btn nav-button wow login" data-wow-delay="0.45s"
                            title="{{trans('messages.My Favorites')}}" onclick="openFavoriteModal()">
                        <img src="{{ asset('img/bookmark_add.png') }}" style="width:15px;"/>
                    </button>
                @endguest
                @if (Config::get('global_models.activity') == '1')
                    <div title="{{trans('messages.My Cart')}}"
                         class="bounceInRight"
                         data-wow-delay="0.45s" style="display:inline-block;padding: 3px 20px">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-haspopup="true" aria-expanded="false" id="activity-card">
                            <i class="fa fa-shopping-cart" style="color: #1c3d4e;font-size: 15px"></i>

                                @if(Cookie::get('activity_cart'))
                                    @php
                                        $cookie_data = stripslashes(Cookie::get('activity_cart'));
                                        $cart_data = json_decode($cookie_data, true);
                                        $totalcart = count($cart_data);
                                        $total_cart_price =0;
                                    @endphp
                                <em class="badge">{{$totalcart}}</em>
                                <ul class="dropdown-menu notify-drop" aria-labelledby="activity-card">
                                    @foreach($cart_data as $cart)
                                        @php
                                            $total_cart_price += $cart['price'];
                                        @endphp
                                    @endforeach
                                    <div class="notify-drop-title">
                                        <div class="row">
                                            <div class="col-xs-12 text-center">
                                                <b>{{trans('messages.Cart')}}
                                                    : {{$totalcart}} {{trans('messages.Item')}}</b>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end notify title -->
                                    <!-- notify content -->
                                    <div class="drop-content">
                                        @foreach($cart_data as $cart)
                                            @php
                                                $cart_activity = \App\ActivityTour::find($cart['activity_id']);
                                            @endphp
                                            <li>
                                                <div class="col-md-4 col-sm-4 col-xs-5">
                                                    <div class="cart-drop-img img-responsive">
                                                        <img
                                                            src="{{url('storage/app/public/images/activity/'.$cart_activity->image)}}"
                                                            alt=""/>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-sm-8 col-xs-7 pd-l0">
                                                    <h4 class="activity-cart-price">
                                                        <b>{{$cart['price']}} {{trans('messages.this_currency')}}</b>
                                                    </h4>
                                                    <h4 class="activity-cart-title" >{{$cart_activity->name}}</h4>
                                                    <p>{{$cart['date']}}</p>
                                                    <p>{{$cart['adult']}} {{trans('messages.Adults')}}
                                                        , {{$cart['child']}} {{trans('messages.Children')}}</p>
                                                </div>
                                            </li>
                                        @endforeach
                                    </div>
                                    <div class="drop-footer">
                                        <div class="row text-center align-middle total-price">
                                            <div class=" col-md-6 sol-xs-6">
                                                {{trans('messages.total-price')}}
                                            </div>
                                            <div class="col-md-6 sol-xs-6">
                                                <h4 style="margin: 0">{{$total_cart_price}} {{trans('messages.this_currency')}}</h4>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class=" col-md-6 sol-xs-6 text-center">
                                                <a class="btn btn-blue" href="{{route('activity.card')}}">
                                                    {{trans('messages.View')}}
                                                </a>
                                            </div>
                                            <div class=" col-md-6 sol-xs-6 text-center">
                                                <a href="{{route('member.cart')}}" class="btn btn-white" style="display: none">
                                                    {{trans('messages.Checkout')}}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                            </ul>
                                @else
                                <em class="badge badge-secondary badge-pill badge-warning">0</em>
                                <ul class="dropdown-menu notify-drop" aria-labelledby="activity-card">
                                    <div class="notify-drop-title">
                                        <div class="row">
                                            <div class="col-xs-12 text-center">
                                                <b>{{trans('messages.Cart')}}: 0 {{trans('messages.Item')}}</b>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end notify title -->
                                    <!-- notify content -->
                                    <div class="drop-content">
                                        <li>
                                            <div class="col-md-12 text-center">
                                                no item
                                            </div>
                                        </li>
                                    </div>
                            </ul>
                                @endif


                        </a>
                    </div>
                @endif
                {{--                @if (Config::get('site_settings.apple') != '')--}}
                {{--                <a href="{{Config::get('site_settings.apple')}}" target="_blank">--}}
                {{--                    <img src="{{ asset('img/apple.png') }}" class="navbar-btn wow fadeInRight" data-wow-delay="0.48s">--}}
                {{--                </a>--}}
                {{--                @endif--}}
                {{--                @if (Config::get('site_settings.google') != '')--}}
                {{--                    <a href="{{Config::get('site_settings.google')}}" target="_blank">--}}
                {{--                        <img src="{{ asset('img/google-play.png') }}" class="navbar-btn wow fadeInRight"--}}
                {{--                             data-wow-delay="0.48s">--}}
                {{--                    </a>--}}
                {{--                @endif--}}
            </div>
            <ul class="main-nav nav navbar-nav navbar-ot-left">
                <li class="ymm-sw " data-wow-delay="0.1s">
                    <a href="{{route('/')}}" class="">
                        {{trans('messages.Home')}}
                    </a>
                </li>
                <li class="wow fadeInDown" data-wow-delay="0.3s">
                    <a class="" href="{{route('packages.countries')}}">
                        {{trans('messages.Packages-home-menu')}}
                    </a>
                </li>
                @if (Config::get('global_models.activity') == '1')
                    <li class="wow fadeInDown" data-wow-delay="0.4s">
                        <a class="" href="{{route('activity.index')}}">
                            {{trans('messages.Activities')}}
                        </a>

                    </li>
                @endif
                @if (Config::get('global_models.uaeVisa') == '1' || Config::get('global_models.outboundVisa') == '1')
                    <li class="dropdown wow fadeInDown" data-wow-delay="0.3s">
                        <a type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false" href="#">
                            {{trans('messages.Visa')}}
                            <i class="fas fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @if (Config::get('global_models.uaeVisa') == '1')
                                <li>
                                    <a class="dropdown-item" href="{{route('visa.uae')}}">
                                        {{trans('messages.Uae Visa')}}
                                    </a>
                                </li>
                            @endif
                            @if(Config::get('global_models.outboundVisa') == '1')
                                <li>
                                    <a class="dropdown-item" href="{{route('visa.outbound')}}">
                                        {{trans('messages.Outbound Visa')}}
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                <li class="wow fadeInDown" data-wow-delay="0.3s">
                    <a class="<?php if (isset($blog_active) && $blog_active) { ?> active <?php } ?>"
                       href="{{route('blogs')}}">
                        {{trans('messages.Blog')}}
                    </a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
