<?php $count2 = 1 ?>
@foreach($package->days as $day)
    <div class="col-md-12 col-md-12 col-xs-12 day-slide">
        <div class="slide direction slide-day-container" data-toggle="collapse"
             data-target="#day-div-{{$package->id}}-{{$day->id}}">

        <span class="flag dayArrow" style="background-color:#1c3d4e;border-radius: 0 0px;">
            {{trans('messages.Day').' '.$count2}}
        </span>
            <span class="dayArrow2">
          {{$day->day_title}}
        </span>
            @if(isset($day->open_day) && $day->open_day == '1' )
                <i class="slide-day fa fa-minus first"></i>
                @if(!$day->daytours->isEmpty())
                    <input type="hidden" class="day-tour-all-cost" id="day-tour-all-cost-{{$day->id}}" value="0"/>
                    <span class="dayArrowTour"
                          onclick="add_tour_to_package('{{$day->id}}' , '{{$package->id}}','{{$count2}}')">
                {{trans('messages.Add_tour')}}
             </span>
                @endif
        </div>
        <div id="day-div-{{$package->id}}-{{$day->id}}"
             class="s-property-content panel-collapse fqa-body slide-day-body">
            <p>
                {!! $day->day_description !!}
            </p>
        </div>
        @else
            <i class="slide-day fa fa-plus"></i>
            @if(!$day->daytours->isEmpty())
                <input type="hidden" class="day-tour-all-cost" id="day-tour-all-cost-{{$day->id}}" value="0"/>
                <span class="dayArrowTour"
                      onclick="add_tour_to_package('{{$day->id}}' , '{{$package->id}}','{{$count2}}')">
                {{trans('messages.Add_tour')}}
             </span>
            @endif
    </div>
    <div id="day-div-{{$package->id}}-{{$day->id}}"
         class="s-property-content panel-collapse fqa-body slide-day-body collapse">
        <p>
            {!! $day->day_description !!}
        </p>
    </div>
    @endif
    </div>
    <?php $count2++ ?>
@endforeach
