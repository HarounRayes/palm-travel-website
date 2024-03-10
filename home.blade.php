@extends('layouts.app')
@section('content')

    <div class="slider-area">
        @if($sliders)
            <div class="slider">
                <div id="bg-slider" class="owl-carousel owl-theme">
                    @foreach($sliders as $slider)
                        @if($slider->image != '')
                            <div class="item">
                                @if($slider->link)
                                    <a href='{{$slider->link}}' target="_blank">
                                        @endif
                                        <img
                                            src="{{ url('storage/app/public/images/slider/'.$slider->image) }}"
                                            alt="GTA V">
                                        @if($slider->link)
                                    </a>
                                @endif
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
    </div>
    <div class="content-area home-area-1 recent-property" style="background-color: #FCFCFC;">
        <div class="container">
            <div class="row" style="margin-bottom: 3rem">
                <div class="col-md-12 col-sm-12 home-reasons-section">
                    <div class="col-md-2 col-sm-4 col-xs-6 reason-container">
                        <h3 class="m-b-15 m-t-0 yellow-text">{{trans('messages.reason-to')}}</h3>
                        <h4 class="m-t-0 m-b-0 yellow-text">{{trans('messages.book-with-us')}}</h4>
                    </div>
                    @foreach($reasons as $reason)
                        <div class="col-md-2 col-sm-4 col-xs-6 reason-container">
                            <div class="reason-icon">
                                <img src="{{url('storage/app/public/images/info/'.$reason->header_image)}}">
                            </div>
                            <div class="reason-text">{{$reason->intro}}</div>
                        </div>
                    @endforeach
                </div>
            </div>
            @if($services)
                <div class="row m-b-15">
                    <div class="prop-partners-slide-title-line">
                        <div class="prop-partners-slide-title">
                            {{trans('messages.our-services')}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 align-items-center" style="display: flex">
                        @if($service_image->is_image == 1)
                            <img class="home-service-img"
                                 src="{{url('storage/app/public/images/info/'.$service_image->header_image)}}">
                        @else
                            <iframe width="100%" height="205px;"
                                    src="https://www.youtube.com/embed/{{$service_image->header_image}}"
                                    frameborder="0" allowfullscreen>
                            </iframe>
                        @endif
                    </div>
                    <div class="col-md-8 col-sm-12 col-xs-12 p-0">

                        @for($i = 0; $i<$services->count();$i++)

                            <div class="col-md-4 col-sm-4 col-xs-6 home-service-box">
                                <div class="service-icon-container">
                                    <div class="service-icon">
                                        <img src="{{url('storage/app/public/images/service/'.$services[$i]->icon)}}">
                                    </div>
                                </div>
                                <div class="service-text-container pb-0">
                                    {!! $services[$i]->text !!}
                                </div>
                            </div>

                        @endfor
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="proerty-th">
                    <div class="similar-post-section padding-top-40">
                        <div class="prop-partners-slide-title-line">
                            <div class="prop-partners-slide-title">
                                {{trans('messages.our-partners')}}
                            </div>
                        </div>
                        @if ($partners)
                            <div id="slick-partners">

                                @foreach ($partners as $partner)
                                    <div class="partner-img-container">
                                        <img src="{{url('storage/app/public/images/partner/'.$partner->image)}}"
                                             title="{{$partner->name}}"/>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="home-page-image"
         style="background-image: url({{url('storage/app/public/images/info/'.$footer_image->header_image)}})">
        <div class="row">
            <div class="col-md-6 col-sm-4 float-left-ar"></div>
            <div class="col-md-6 col-sm-8 col-xs-12 newsletter-div float-left-ar">
                <div class="row">
                <h4> {!! $footer_image->intro !!}</h4><br>
                </div>
                <div class="row">
                <form method="post" action="{{route('newsletter.save')}}" class="newsletter-form">
                    @csrf
                    <div class="col-md-5 col-sm-5 col-xs-5">
                        <input type="text" name="name" required placeholder="{{trans('messages.Name')}}">
                    </div>
                    <div class="col-md-5 col-sm-5 col-xs-5">
                        <input type="email" name="email" required placeholder="{{trans('messages.Email')}}">
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-2">
                        <input type="submit" value="{{trans('messages.sign-up')}}" class="btn btn-default">
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>

@endsection
