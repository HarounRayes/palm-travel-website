@extends('layouts.app')

@section('content')
    <div class="page-head" style="background: #494C53;background-image: url({{url('storage/app/public/images/country/'.$country->header_image) }}) ;
        background-repeat: no-repeat;background-size: 100% 100% ;background-position: center;">

        <div class="container">
            <div class="row">
                <div class="page-head-content">
                    <center><h1 class="page-title" style="color:#FFA500;">
                        <span>

                        </span>
                        </h1></center>
                </div>
            </div>
        </div>
    </div>
    <form action="{{route('packages')}}" class="form-inline packages-container" method="get" id='search-form'
        style="background: #494C53;background-image: url({{url('storage/app/public/images/country/'.$country->background_image) }}) ;
        background-repeat: no-repeat;background-size: 100% 100% ;background-position: center;">

    @include('frontend.blocks.searchForm')
    <div class="home-area-1 recent-property" style="padding-bottom: 55px;">
        <div class="container">

            <div class="proerty-th">

                <div id="menu-search-bar">
                    <div class="handle"><span class="fa fa-search"></span></div>
                    @include('frontend.blocks.sideSearchForm')
                </div>
                <div class="col-sm-12 col-md-12 p0 text-white">
                    @if(isset($country) && $country)
                        {!! $country->intro !!}
                    @endif
                </div>
                <div id="view-packages-area">
                    @if(count($packages) === 0)
                    <center>
                        <img src="{{asset('img/empty_list_animation.gif')}}" width="200" alt="gif empty animation">
                    </center>
                    @else
                        @foreach($packages as $package)
                                <div class="col-sm-6 col-md-4 package-block {{$package->date}}" id="id1">
                                    @include('frontend.blocks.mainPackage')
                                </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    </form>
@endsection
