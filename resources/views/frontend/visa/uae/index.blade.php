@extends('layouts.app')

@section('content')
    @if($info->header_image != '')
        <div class="page-head" style="
            background-image: url({{url('storage/app/public/images/info/'.$info->header_image)}});
            background-size: cover;
            background-position: center;">
        </div>
    @else
        <div class="page-head" style="background-color: #b0a579;">
        </div>
    @endif
    <!-- property area -->
    <div class="content-area home-area-1 recent-property" style="background-color: #FCFCFC; padding-bottom: 55px;">

        <div class="container">

            @include('frontend.visa.uae.visaUaeSearchBox')

            <div class="row">
                <div class="col-md-12 col-sm-12 text-center page-title page-title-home p-b-15">
                    {!! $info->intro !!}
                </div>
            </div>
            <div class="row">
                <div class="proerty-th">
                    <div class="similar-post-section padding-top-40">
                        <div id="prop-smlr-slide-visa-type">
                            <div class="prop-smlr-slide-title">
                                {!! $info->title_section_1 !!}
                            </div>
                            <div id="slick-visa-type">
                                @if ($types)
                                    @foreach ($types as $type)
                                        <div class='type-box'>
                                            <div class="type-box-img">
                                                <img src="{{url('storage/app/public/images/visa/'.$type->image)}}"/>
                                            </div>
                                            <div class='type-box-title'>
                                                <b> {{$type->name}}</b>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="proerty-th">
                    <div class="similar-post-section padding-top-40">
                        <div id="prop-smlr-slide-activity">
                            <div class="prop-smlr-slide-title">
                                {!! $info->title_section_2 !!}
                            </div>
                            @if ($nationalities)
                                <div id="slick-top-activity">
                                    @foreach ($nationalities as $nationality)
                                        @if($nationality->defaultType())
                                            <div class="box-two proerty-item2"
                                                 style="margin: 10px !important;border-top-left-radius: 10px;border-top-right-radius: 10px;">
                                                <div class="item-thumb text-center">
                                                    <a href="{{route('visa.uae.search',['nationality' => $nationality->symbol,'type' => $nationality->defaultType()->type->symbol])}}">
                                                        <img style="margin: 0 auto;"
                                                             src="{{url('storage/app/public/images/visa/'.$nationality->image)}}"/>
                                                    </a>
                                                </div>
                                                <div class="item-entry overflow">
                                                <span class="o-pull-left-en" style="font-size: 17px;">
                                                    <b>{{$nationality->name}}</b>
                                                </span>
                                                    <br>

                                                    <span class="o-pull-left-en" style="font-size: 17px;">
                  {{trans('messages.from')}} {{$nationality->defaultType()->adult_price}} {{trans('messages.this_currency')}}
                                                </span>
                                                    <span class="proerty-price o-pull-right-en">
                                                    <b>
                                                            <a href="{{route('visa.uae.search',['nationality' => $nationality->symbol,'type' => $nationality->defaultType()->type->symbol])}}"
                                                               class="navbar-btn nav-button wow fadeInRight view cursor_pointer"
                                                               data-wow-delay="0.48s">
                                                          {{trans('messages.View_details')}}
                                                            </a>
                                                    </b> </span>

                                                </div>
                                            </div>
                                        @endif
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
