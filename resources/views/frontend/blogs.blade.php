@extends('layouts.app')

@section('content')
    <div class="main">
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

    <!-- End page header -->

        <!-- property area -->
        <div class="properties-area recent-property" style="background-color: #FFF;">
            <div class="container">
                <div class="row">

                    <div class="col-md-12 padding-top-40 padding-bottom-40">
                        @if($allblogs)
                            @foreach($allblogs as $oneblog)

                                <div class="col-sm-6 col-md-4">
                                    <div class="box-two proerty-item" style="padding-bottom: 15px;">
                                        <div class="item-thumb">
                                            <a href="{{route('blog',['symbol' => $oneblog->symbol])}}">
                                                <img src="{{url('storage/app/public/images/blog/'.$oneblog->image)}}">

                                            </a>
                                        </div>
                                        <div class="item-entry overflow " style="padding: 5px 10px;">
                                            <span class="o-pull-left-en">
                                                <b>{{$oneblog->name}}</b>
                                            </span>
                                            <br>

                                        </div>
                                        <div class="item-entry overflow" style="padding: 5px 10px;">

                                            <span class="proerty-price o-pull-right-en">
                                                <b>
                                                    <a class="navbar-btn nav-button wow fadeInRight view"
                                                       href="{{route('blog',['symbol' => $oneblog->symbol])}}"
                                                       data-wow-delay="0.48s">
{{trans('messages.View')}}
                                                    </a></b> </span>
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
@endsection
