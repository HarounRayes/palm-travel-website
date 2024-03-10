@foreach ($package->flights as $Flight)
    @if($Flight->segments)
        @foreach ($Flight->segments as $segmentF)
            <!--Need to make flight date picker-->
            <div class="flight-segment-box">
                <!--<h4> -->
                <!--@if ($segmentF->departure_date != 0)-->
                <!--        {{date("d-m-Y", strtotime($segmentF->departure_date)). ' - '}}-->
                <!--    @else-->
                <!--        {{ '00-00-0000 - '}}-->
                <!--    @endif-->
                <!--    @if ($segmentF->arrival_date != 0)-->
                <!--        {{date("d-m-Y", strtotime($segmentF->arrival_date))}}-->
                <!--    @else-->
                <!--        {{'00-00-0000'}}-->
                <!--    @endif-->
                <!--</h4>-->
                <div class="flight-segment-box-content">
                    <div class="">
                        <center><img alt="segment image" class="arlnLogo"
                                     src="{{url('storage/app/public/images/package/' . $segmentF->icon)}}"
                                     style="width: 45px;height: 45px;"></center>
                        <center>{{$segmentF->flight}} {{$segmentF->flight_number}}</center>
                    </div>
                    <div class="">
                        {{$segmentF->departure_time. ' - '}} {{date("d-m-Y", strtotime($segmentF->departure_date))}}<br>
                        {{$segmentF->departure_from}}
                    </div>
                    <div class="line"><span></span>
                    </div>
                    <div class="">
                        {{$segmentF->arrival_time. ' - '}} {{date("d-m-Y", strtotime($segmentF->arrival_date))}}<br>
                        {{$segmentF->arrival_to}}
                    </div>
                </div>
            </div>
        @endforeach
    @endif
@endforeach