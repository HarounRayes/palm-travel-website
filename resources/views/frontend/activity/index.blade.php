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
            <form method="get" action="{{route('activity.search')}}">
                @include('frontend.activity.activitySearchBox')
            </form>
            <div class="row">
                <div class="col-md-12 col-sm-12 text-center page-title page-title-home p-b-15">
                    {!! $info->intro !!}
                </div>
            </div>
            <div class="row">
                <div class="proerty-th">
                    <div class="activity-step-container">
                        @if ($steps)
                            <?php  $h = 1; ?>
                            @foreach ($steps as $step)
                                <div class="col-md-4 col-sm-4 col-xs-4 p-xs-5">
                                    <div class='step-box'>
                                        <div class='step-box-title'>
                                            <b>{{trans('messages.Step')}} {{$h}} : {{$step->name}}</b>
                                        </div>
                                        <div class="step-box-img">
                                            <img src="{{url('storage/app/public/images/activity/'.$step->image)}}"/>
                                        </div>
                                    </div>
                                </div>
                                <?php  $h++;      ?>
                            @endforeach

                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="proerty-th">
                    <div class="similar-post-section padding-top-40">
                        <div id="prop-smlr-slide-activity">
                            <div class="prop-smlr-slide-title">
                                {{trans('messages.top-activities')}}
                            </div>
                            @if ($activities)
                                <div id="slick-top-activity">
                                    @foreach ($activities as $activity)
                                        <div class="box-two proerty-item2"
                                             style="margin: 10px !important;border-top-left-radius: 10px;border-top-right-radius: 10px;">
                                            <div class="item-thumb text-center">

                                                <img style="margin: 0 auto;"
                                                     src="{{url('storage/app/public/images/activity/'.$activity->image)}}"/>

                                            </div>
                                            <div class="item-entry overflow">
                                                <span class="o-pull-left-en"
                                                      style="font-size: 15px;margin-bottom: 10px;min-width: 100%">
                                                    <b>{{$activity->name}}</b>
                                                </span>
                                                <br>
                                                <span class="o-pull-left-en" style="font-size: 17px;">
                  {{trans('messages.from')}} {{$activity->price}} {{trans('messages.this_currency')}}
                                                </span>
                                                <span class="proerty-price o-pull-right-en">
                                                    <b>
                                   <a href="{{route('activity.search',['country' => $activity->activity_country_id,'city' => $activity->activity_city_id ,'adult' => 1])}}"
                                      class="navbar-btn nav-button wow fadeInRight view cursor_pointer"
                                      data-wow-delay="0.48s">
{{trans('messages.View_details')}}
                                   </a>
                                                        </b> </span>
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

    <div class="modal fade" id="myModalActivity" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content"></div>
        </div>
    </div>
@endsection
