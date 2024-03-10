@extends('layouts.app')
@section('content')
    @if($package->package_image_header != '')
        <div class="page-head" style="height: 100%; background-position: center; background-repeat: no-repeat;
            background-size: cover; background-image: url({{url('storage/app/public/images/package/' . $package->package_image_header)}});">
            @else
                <div class="page-head" style='background-color: #b0a579'>
                    @endif
                </div>
        </div>
        <!-- End page header -->
        <div class="content-area single-property" style="background-color: #FFF;">
            <div class="container padding-top-40 padding-xs-top-5">
                <div class="row">
                    <div class="col-md-8 single-property-content" style="padding: 0 !important;">
                        @include('frontend.package.details.slider')
                        <div class="panel with-nav-tabs flight_map_tap3">
                            <div class="panel-heading package-details-tabs mt-0">
                                @include('frontend.package.details.tabs')
                            </div>
                            <div>
                                    @include('frontend.package.details.tabs-content')
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 p0">
                        <aside class="sidebar sidebar-property blog-asside-right" style="background-color: #FFF;">
                            <div class="panel panel-default sidebar-menu wow fadeInRight animated">
                                <div class="panel-body search-widget">
                                    <fieldset>
                                        <div class="row">
                                            @if(isset($package->map) && $package->map != '') 
                                                <div class="col-sm-12">
                                                    <label><b>
                                                            {{trans('messages.Your_Destination')}}
                                                        </b></label>
                                                    <div id="map-image">
                                                        <img
                                                            src="{{url('storage/app/public/images/package/' . $package->map)}}"/>
                                                    </div>
                                                </div>
                                            @endif
                                            @if(isset($package->video) && $package->video != '')
                                                <div class="col-sm-12">
                                                    <div class="section property-video">
                                                        <label><b>
                                                                {{trans('messages.Holiday_Video')}}
                                                            </b></label>
                                                        <div class="video-thumb">
                                                            <iframe width="100%" height="205px;"
                                                                    src="https://www.youtube.com/embed/{{$package->video}}?autoplay=1&mute=1&enablejsapi=1"
                                                                    frameborder="0" allowfullscreen>
                                                            </iframe>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="panel-group">
                                    <div class="panel-default">
                                        <div class="col-sm-12 mar-b-20" style="padding: 0px;overflow: hidden">
                                            <div class="section property-hotel" style='overflow: unset;'>
                                                <label><b>
                                                        {{trans('messages.Select_Hotel')}}
                                                    </b></label>
                                                <div class="col-sm-12 no-padding">
                                                    @if($package->packageHotels)

                                                        @foreach($package->packageHotels as $OneHotel)
                                                            <form
                                                                action="{{route('details',['symbol' => $package->symbol,'hotel' => $OneHotel->hotel->symbol])}}"
                                                                method="get">
                                                                <div class="col-sm-4 col-xs-4 padding-custom">
                                                                    @if(isset($OneHotel->sould_out) && $OneHotel->sould_out)
                                                                        <div class="checkbox-hotel disabled"
                                                                             style="cursor: not-allowed"
                                                                             title="{{trans('messages.sold_out')}}">
                                                                            <div class="radio">
                                                                                <label class="no-padding"
                                                                                       style="cursor: not-allowed">
                                                                                    <input class="radio-hotel"
                                                                                           id="radio-hotel"
                                                                                           style="cursor: not-allowed"
                                                                                           type="radio" disabled
                                                                                           {{request()->hotel == $OneHotel->hotel->symbol ?"checked":""}}
                                                                                           value="{{$OneHotel->hotel->symbol}}">
                                                                                    {{$OneHotel->hotel->star_rate}} {{trans('messages.Stars')}}
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    @else
                                                                        <div class="checkbox-hotel">
                                                                            <div class="radio">
                                                                                <label class="no-padding">

                                                                                    <input class="radio-hotel"
                                                                                           id="radio-hotel"
                                                                                           type="radio"
                                                                                           {{request()->hotel == $OneHotel->hotel->symbol ?"checked":""}}
                                                                                           value="{{$OneHotel->hotel->symbol}}">

                                                                                    {{$OneHotel->hotel->star_rate}} {{trans('messages.Stars')}}
                                                                                </label>
                                                                            </div>
                                                                        </div>

                                                                    @endif
                                                                </div>
                                                            </form>
                                                        @endforeach

                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        @include('frontend.package.details.hotel-pricing')
                                        @include('frontend.package.details.booking-section')
                                    </div>
                                </div>
                                {{--                                <div class="col-xs-12 mar-t-10" style="padding: 0px;margin-top: 30px;">--}}
                                {{--                                    <h4 class="s-property-title-1">--}}
                                {{--                                        <?= $olang->langGetinfo('Share') ?>--}}
                                {{--                                    </h4>--}}
                                {{--                                    <div class="roperty-social">--}}
                                {{--                                        <ul>--}}
                                {{--                                            <li style="cursor: pointer;">--}}
                                {{--                                            <!--<a title="Share this on facebok " href="https://www.facebook.com/sharer/sharer.php?u=http://<?= $_SERVER['HTTP_HOST'] ?>/details.php%3Fhotel%3D<?= $hotel_id ?>%26package%3D<?= $package_symbol ?>" style="cursor: pointer">-->--}}
                                {{--                                                <img src="assets/img/social_big/facebook_grey.png" id="fb-share-pacakge-button">--}}
                                {{--                                                <!--</a>-->--}}
                                {{--                                                <!-- <div id="fb-share-pacakge-button">--}}
                                {{--                                                     <svg viewBox="0 0 12 12" preserveAspectRatio="xMidYMid meet">--}}
                                {{--                                                     <path class="svg-icon-path" d="M9.1,0.1V2H8C7.6,2,7.3,2.1,7.1,2.3C7,2.4,6.9,2.7,6.9,3v1.4H9L8.8,6.5H6.9V12H4.7V6.5H2.9V4.4h1.8V2.8 c0-0.9,0.3-1.6,0.7-2.1C6,0.2,6.6,0,7.5,0C8.2,0,8.7,0,9.1,0.1z" fill="gray"></path>--}}
                                {{--                                                      </svg></div>-->--}}
                                {{--                                            </li>--}}

                                {{--                                            <li>--}}
                                {{--                                                <a title="Share this on twitter " href="#">--}}
                                {{--                                                    <img src="assets/img/social_big/twitter_grey.png">--}}
                                {{--                                                </a>--}}
                                {{--                                            </li>--}}

                                {{--                                        </ul>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                                @if ($package->pdf != '')
                                    <div class="col-xs-12 mar-t-10" style="padding: 0px;">
                                        <div class="panel-default">
                                            <center>
                                                <a class="navbar-btn nav-button wow fadeInRight btn nav-button-details"
                                                   target="_blank"
                                                   href="{{url('storage/app/public/pdf/'.$package->pdf)}}"
                                                   data-wow-delay="0.5s">
                                                    {{trans('messages.Download-PDF')}}
                                                </a>
                                            </center>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
        @include('frontend.package.details.modals')
@endsection
