@extends('layouts.app')
@section('content')

    <div class="slider-area">
        @if($sliders)
            <div class="slider">
                <div id="slick-home-slider" class="dir-ar-ltr">
                    @foreach($sliders as $slider)
                        @if($slider->image != '')

                            @if($slider->link != '')
                                <a href='{{$slider->link}}' target="_blank">
                                    @endif
                                    <div class="item">
                                        <!--added later-->
                                        <!--<img-->
                                        <!--    src="{{ url('storage/app/public/images/slider/'.$slider->image) }}"-->
                                        <!--    alt="{{Config::get('site_settings.site_name')}}">-->
                                        <img
                                            src="{{ url('storage/app/public/images/slider/1619283879.sliderimagear8.jpg') }}"
                                            alt="{{Config::get('site_settings.site_name')}}">
                                    </div>
                                    @if($slider->link != '')
                                </a>
                            @endif

                        @endif
                    @endforeach
                </div>
            </div>
        @endif
    </div>
    <!-- Start About -->

    <div class="content-area home-area-1 recent-property" style="overflow: hidden;padding-bottom: 0 ">
        <section id="mu-about">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mu-about-area">
                            <!-- Start Feature Content -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <h3 class="mb-2">{{$about_image->title_section_1}}</h3>
                                        {!! $about_image->intro !!}
                                    </div>
                                </div>
                            </div>
                            <!-- End Feature Content -->

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End About -->
        
        <!-- Start Call to Action -->
        <!--<section id="mu-featured-tours">-->
        <!--    <div class="container">-->
        <!--        <div class="row">-->
        <!--            <div class="col-md-12">-->
        <!--                <div class="mu-featured-tours-area">-->
        <!--                    <h3 class="mar-b-20">{{$feature_section->title_section_1}}</h3>-->
        <!--                    <p class="mu-title-content">{!! $feature_section->intro !!}</p>-->

                            <!-- Start Featured Tours content -->
        <!--                    <div class="mu-featured-tours-content">-->
        <!--                        <div class="mu-featured-packages-slider">-->
        <!--                            @if ($featured_packages)-->
        <!--                                @foreach($featured_packages as $package)-->
        <!--                                @include('frontend.blocks.homeMainPackage')-->
        <!--                                @endforeach-->
        <!--                            @endif-->
        <!--                        </div>-->
        <!--                    </div>-->
                            <!-- End Featured Tours content -->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</section>-->
        <!-- Start Call to Action -->

        <!-- Start Why Us -->
        <section id="mu-why-us">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mu-why-us-area">
                            <h3>{{trans('messages.our-services')}}</h3>
                            <center>
                                <div class="mu-clients-slider">
                                    @if ($services)
                                        @foreach ($services as $service)
                                            <div class="mu-clients-single">
                                                <img style="max-width: 60%;" src="{{url('storage/app/public/images/service/'.$service->icon)}}">
                                                <p>{!! $service->title !!}</p>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </center>
                        </div>
                        
                        <!--<div class="mu-why-us-area">-->
                        <!--    <h3>{{trans('messages.our-services')}}</h3>-->
                            <!--<div class="mu-why-us-content">-->
                                <!--<div class="mu-service-slider">-->
                        <!--            @if($services)-->
                        <!--                @foreach($services as $service)-->
                        <!--                    <div class="col-sm-3">-->
                        <!--                        <div class="mu-why-us-single">-->
                        <!--                            <div class="my-why-us-single-icon">-->
                        <!--                                <img src="{{url('storage/app/public/images/service/'.$service->icon)}}">-->
                        <!--                            </div>-->
                        <!--                            <h6 class="bold">{!! $service->title !!}</h6>-->
                                                    <!--<p>{!! $service->text !!}</p>-->
                        <!--                        </div>-->
                        <!--                    </div>-->
                        <!--                @endforeach-->
                        <!--            @endif-->
                                <!--</div>-->
                            <!--</div>-->
                        <!--</div>-->
                    </div>
                </div>
                <div class="mu-featured-tours-area">
                            <h3 class="mar-b-20">{{$feature_section->title_section_1}}</h3>
                            <p class="mu-title-content">{!! $feature_section->intro !!}</p>

                            <!-- Start Featured Tours content -->
                            <div class="mu-featured-tours-content">
                                <div class="mu-featured-tours-slider">
                                    @if ($countries)
                                        @foreach($countries as $country)
                                            <div class="col-md-4">
                                                <div class="box-two proerty-item2">
                                                    <div class="item-thumb">
                                                        <a href="{{route('packages',['country' => $country->symbol])}}">
                                                            <img
                                                                src="{{ url('storage/app/public/images/country/'.$country->image) }}">
                                                        </a>
                                                    </div>
                                                    <div class="item-entry overflow" style="padding: 8px">
                                                <span class="o-pull-left-en" style="font-size: 17px;">
                                                    <b>{{trans('messages.Starting_From')}}</b>
                   {{$country->start_price}} {{trans('messages.this_currency')}}
                                                </span>
                                                        <span class="proerty-price o-pull-right-en">
                                                    <b>
                                   <a href="{{route('packages',['country' => $country->symbol])}}"
                                      class="navbar-btn nav-button wow fadeInRight view"
                                      data-wow-delay="0.48s">
{{trans('messages.View_details')}}
                                   </a>
                                                        </b> </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <!-- End Featured Tours content -->
                        </div>
            </div>
            
        </section>
        <!-- End Why Us -->

{{--        <!-- Start Video -->--}}
{{--        <section id="mu-video">--}}
{{--            <div class="container">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-md-12">--}}
{{--                        <div class="mu-video-area ">--}}
{{--                            <h3 class="mar-b-20 text-white"> {{$service_image->title_section_1}}</h3>--}}
{{--                            <p class="mu-title-content">--}}
{{--                                {!! $service_image->intro !!}--}}
{{--                            </p>--}}

{{--                            <!-- Start Video content -->--}}
{{--                            <div class="mu-video-content">--}}
{{--                                @if($service_image->is_image == 1)--}}
{{--                                    <img class="home-service-img"--}}
{{--                                         src="{{url('storage/app/public/images/info/'.$service_image->header_image)}}">--}}
{{--                                @else--}}
{{--                                    <iframe width="854" height="480" allow='autoplay'--}}
{{--                                            src="https://www.youtube.com/embed/{{$service_image->header_image}}?autoplay=1&mute=1"--}}
{{--                                            frameborder="0" allowfullscreen>--}}
{{--                                    </iframe>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- End Video content -->--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}
{{--        <!-- End Video -->--}}

        
        <!-- Start Featured Tours -->
<!--        <section id="mu-featured-tours">-->
<!--            <div class="container">-->
<!--                <div class="row">-->
<!--                    <div class="col-md-12">-->
<!--                        <div class="mu-featured-tours-area">-->
<!--                            <h3 class="mar-b-20">{{$feature_section->title_section_1}}</h3>-->
<!--                            <p class="mu-title-content">{!! $feature_section->intro !!}</p>-->

                            <!-- Start Featured Tours content -->
<!--                            <div class="mu-featured-tours-content">-->
<!--                                <div class="mu-featured-tours-slider">-->
<!--                                    @if ($countries)-->
<!--                                        @foreach($countries as $country)-->
<!--                                            <div class="col-md-4">-->
<!--                                                <div class="box-two proerty-item2">-->
<!--                                                    <div class="item-thumb">-->
<!--                                                        <a href="{{route('packages',['country' => $country->symbol])}}">-->
<!--                                                            <img-->
<!--                                                                src="{{ url('storage/app/public/images/country/'.$country->image) }}">-->
<!--                                                        </a>-->
<!--                                                    </div>-->
<!--                                                    <div class="item-entry overflow" style="padding: 8px">-->
<!--                                                <span class="o-pull-left-en" style="font-size: 17px;">-->
<!--                                                    <b>{{trans('messages.Starting_From')}}</b>-->
<!--                   {{$country->start_price}} {{trans('messages.this_currency')}}-->
<!--                                                </span>-->
<!--                                                        <span class="proerty-price o-pull-right-en">-->
<!--                                                    <b>-->
<!--                                   <a href="{{route('packages',['country' => $country->symbol])}}"-->
<!--                                      class="navbar-btn nav-button wow fadeInRight view"-->
<!--                                      data-wow-delay="0.48s">-->
<!--{{trans('messages.View_details')}}-->
<!--                                   </a>-->
<!--                                                        </b> </span>-->
<!--                                                    </div>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                        @endforeach-->
<!--                                    @endif-->
<!--                                </div>-->
<!--                            </div>-->
                            <!-- End Featured Tours content -->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </section>-->
        <!-- End Featured Tours -->

        <!-- Start Clients -->
        <section id="mu-clients">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mu-clients-area">
                            <h3> {{trans('messages.our-partners')}}</h3>

                            <!-- Start Clients brand logo -->
                            <div class="mu-clients-slider">
                                @if ($partners)
                                    @foreach ($partners as $partner)
                                        <div class="mu-clients-single">
                                            <img src="{{url('storage/app/public/images/partner/'.$partner->image)}}"
                                                 alt="{{$partner->name}}">
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <!-- End Clients brand logo -->

                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row col-md-12">
                    <div class="mu-callto-action-area">
                        <h3 class="text-white" style="color:#659a8a !important;">{!! $journey_section->intro !!}</h3>
                        <a class="mu-book-now-btn" href="{{route('packages.countries')}}">{{$journey_section->title_section_1}}</a>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mu-contact-area">
                            <h3 class="mar-b-20">{{$newsletter_section->title_section_1}}</h3>
                            <p>{!! $newsletter_section->intro !!}</p>

                            <!-- Start Contact Content -->
                            <div class="mu-contact-content">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="mu-contact-form-area">
                                            <div id="form-messages"></div>
                                            <form method="post" action="{{route('newsletter.save')}}"
                                                  class="newsletter-form">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control"
                                                                   placeholder="{{trans('messages.Full_name')}}"
                                                                   id="name" name="name" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="email" class="form-control"
                                                                   placeholder="{{trans('messages.Email')}}" id="email"
                                                                   name="email"
                                                                   required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div id="newsletter_id"></div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">

                                                    <div class="col-md-6">
                                                        {!! RecaptchaV3::field('newsletter') !!}
                                                        @if ($errors->has('g-recaptcha-response'))
                                                            <span class="help-block">
                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <button type="submit" class="mu-send-msg-btn">
                                                    <span>{{trans('messages.sign-up')}}</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- End Contact Content -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Clients -->

        <!-- Start Call to Action -->
        <!--<section id="mu-callto-action" style="background-color:white;">-->
        <!--    <div class="container">-->
        <!--        <div class="row col-md-12">-->
        <!--            <div class="mu-callto-action-area">-->
        <!--                <h3 class="text-white" style="color:#659a8a !important;">{!! $journey_section->intro !!}</h3>-->
        <!--                <a class="mu-book-now-btn" href="{{route('packages.countries')}}">{{$journey_section->title_section_1}}</a>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</section>-->
        <!-- Start Call to Action -->

        <!-- Start Contact -->
        <!--<section id="mu-contact">-->
        <!--    <div class="container">-->
        <!--        <div class="row">-->
        <!--            <div class="col-md-12">-->
        <!--                <div class="mu-contact-area">-->
        <!--                    <h3 class="mar-b-20">{{$newsletter_section->title_section_1}}</h3>-->
        <!--                    <p>{!! $newsletter_section->intro !!}</p>-->

                            <!-- Start Contact Content -->
        <!--                    <div class="mu-contact-content">-->
        <!--                        <div class="row">-->

        <!--                            <div class="col-md-12">-->
        <!--                                <div class="mu-contact-form-area">-->
        <!--                                    <div id="form-messages"></div>-->
        <!--                                    <form method="post" action="{{route('newsletter.save')}}"-->
        <!--                                          class="newsletter-form">-->
        <!--                                        @csrf-->
        <!--                                        <div class="row">-->
        <!--                                            <div class="col-md-6">-->
        <!--                                                <div class="form-group">-->
        <!--                                                    <input type="text" class="form-control"-->
        <!--                                                           placeholder="{{trans('messages.Full_name')}}"-->
        <!--                                                           id="name" name="name" required>-->
        <!--                                                </div>-->
        <!--                                            </div>-->

        <!--                                            <div class="col-md-6">-->
        <!--                                                <div class="form-group">-->
        <!--                                                    <input type="email" class="form-control"-->
        <!--                                                           placeholder="{{trans('messages.Email')}}" id="email"-->
        <!--                                                           name="email"-->
        <!--                                                           required>-->
        <!--                                                </div>-->
        <!--                                            </div>-->
        <!--                                        </div>-->
        <!--                                        <div class="row">-->
        <!--                                            <div class="col-sm-12">-->
        <!--                                                <div id="newsletter_id"></div>-->
        <!--                                            </div>-->
        <!--                                        </div>-->
        <!--                                        <div-->
        <!--                                            class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">-->

        <!--                                            <div class="col-md-6">-->
        <!--                                                {!! RecaptchaV3::field('newsletter') !!}-->
        <!--                                                @if ($errors->has('g-recaptcha-response'))-->
        <!--                                                    <span class="help-block">-->
        <!--                                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>-->
        <!--                            </span>-->
        <!--                                                @endif-->
        <!--                                            </div>-->
        <!--                                        </div>-->
        <!--                                        <button type="submit" class="mu-send-msg-btn">-->
        <!--                                            <span>{{trans('messages.sign-up')}}</span>-->
        <!--                                        </button>-->
        <!--                                    </form>-->
        <!--                                </div>-->
        <!--                            </div>-->

        <!--                        </div>-->
        <!--                    </div>-->
                            <!-- End Contact Content -->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</section>-->
        <!-- End Contact -->

    </div>
@endsection
