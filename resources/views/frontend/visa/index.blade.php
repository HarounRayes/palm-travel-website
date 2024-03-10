@extends('layouts.app')

@section('content')
    <div class="page-head" style="background: #494C53;background-image: url({{url('storage/app/public/images/info/'.$info->header_image)}}) ;
        background-repeat: no-repeat;background-size: cover;background-position: center;">
        @include('frontend.visa.visaHeader')
    </div>


    <!-- property area -->
    <div class="content-area home-area-1 recent-property" style="background-color: #FCFCFC; padding-bottom: 55px;">

        <div class="container">

            <div class="row">
                <div class="col-md-12 col-sm-12 text-center page-title page-title-home">
                    {!! $info['intro_'.app()->getLocale()] !!}
                </div>
            </div>

            <div class="row">
                <div class="proerty-th">
                    <div class="similar-post-section padding-top-40">
                        <div id="prop-smlr-slide-visa-type">
                            <div class="prop-smlr-slide-title">
                                {{trans('messages.types-of-visa')}}
                            </div>
                            @if ($types)
                                <div id="slick-visa-type">
                                    @foreach ($types as $type)
                                        <div class="slick-visa-box">
                                            <div class="slick-visa-image">
                                                <a href="{{route('visa.type',['symbol' => $type->symbol])}}">
                                                    <img src="{{url('storage/app/public/images/visa/'.$type->image)}}" style="width:100%"/>
                                                </a>
                                            </div>
                                            <div class="slick-visa-title text-center">
                                                <a href="{{route('visa.type',['symbol' => $type->symbol])}}">
                                                    <span>{{$type->name}}</span>
                                                </a></div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="proerty-th">
                    <div class="similar-post-section padding-top-40">
                        <div id="prop-smlr-slide-visa-country">
                            <div class="prop-smlr-slide-title">
                                 {{trans('messages.other-visa-offered')}}
                            </div>
                            @if ($visa_countries)
                                <div id="slick-visa-country">
                                    @foreach ($visa_countries as $country)
                                        <div class="slick-visa-box">
                                            <div class="slick-visa-image">
                                                <a href="{{route('visa.country' ,['symbol' => $country->symbol])}}">
                                                    <img src="{{url('storage/app/public/images/visa/'.$country->symbol)}}" style="width:100%"/>
                                                </a></div>
                                            <div class="slick-visa-title text-center">
                                                <a href="{{route('visa.country' ,['symbol' => $country->symbol])}}">
                                                    <span class="span-title">{{$country->name}}</span>
                                                </a>
                                                <span
                                                    class="span-blue">{{trans('messages.from')}} {{$country->price}} {{trans('messages.this_currency')}}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
