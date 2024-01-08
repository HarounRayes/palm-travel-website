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
    <div class="country-container" 
        style="
            background-image: url({{url('storage/app/public/images/info/'.$info->background_image)}});
            background-size: cover;
            background-position: center;"
            >

        <form action="{{route('packages')}}" class="form-inline" method="get" id='search-form'>
            @include('frontend.blocks.searchForm')
        </form>

        <!-- property area -->
        <div class="home-area-1 recent-property" style="padding-bottom: 55px;">

            <div class="container">

                <div class="row m-b-15">
                    <div class="col-md-12 col-sm-12 text-center page-title page-title-home">
                        <!-- /.feature title -->
                        @if (Config::get('intro_title')!= '')
                            <h2> {{Config::get('intro_title')}}</h2>
                        @endif
                        @if (Config::get('intro_value')!= '')
                            <h3>{{Config::get('intro_value')}}</h3>
                        @endif
                    </div>
                </div>

                <div class="row" style="display: none;">
                    <div class="col-sm-12">
                        <div class="box-two " style="margin: 20px 0;padding: 10px;overflow:hidden">
                            <h3>{{trans('messages.Sort_by')}}</h3>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label>{{trans('messages.Price')}}</label>
                                <select onchange="sortCountryPackages()" class="form-control" id="sort-price">
                                    <option value="0">{{trans('messages.Select')}}</option>
                                    <option value="DESC">{{trans('messages.DESC')}}</option>
                                    <option value="ASC">{{trans('messages.ACS')}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="view-country-packages-area">
                    <div class="proerty-th">

                        @if ($countries)
                            @foreach ($countries as $country)
                                <div class="col-sm-6 col-md-4">
                                    <div class="country-box">
                                        <div class="item-thumb">
                                            <a href="{{route('packages',['country' => $country->symbol])}}">
                                                <img class="country-image"
                                                     src="{{ url('storage/app/public/images/country/'.$country->image) }}">
                                            </a>
                                        </div>
                                        <div class="item-entry overflow">
                                            <h3 class="country-title text-center">{{$country->name}}</h3>
                                            <div class="country-details">
                                                <p class="text-center" style="font-size: 17px;">
                                                    <b>{{trans('messages.Starting_From')}}</b>
                                                    {{$country->start_price}} {{trans('messages.this_currency')}}
                                                </p>
                                                <p class="text-center">
                                                    <b>
                                                        <a href="{{route('packages',['country' => $country->symbol])}}"
                                                           class="navbar-btn nav-button wow fadeInRight view"
                                                           data-wow-delay="0.48s">
                                                            {{trans('messages.View_details')}}
                                                        </a>
                                                    </b></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>

    <style>
        .country-container {
            background: url();
            background-size: cover;
            background-attachment: fixed;
        }
    </style>
@endsection
