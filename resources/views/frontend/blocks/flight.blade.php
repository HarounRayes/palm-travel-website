<div class="table-responsive">
    <div class="scrllTble flhtDt">
        <table class="grid highlight info-table" width="100%">
            <thead>
            <tr>
                <th style="background-color:#559685;">
                    {{trans('messages.Destination')}}
                </th>
                <th style="background-color:#559685;">
                    {{trans('messages.Flight')}}
                </th>
                <th style="background-color:#559685;">
                    {{trans('messages.Departure')}}
                </th>
                <th style="background-color:#559685;">
                    {{trans('messages.Arrival')}}
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach ($package->flights as $Flight)
                @if($Flight->segments)
                    @foreach ($Flight->segments as $segmentF)
                        <!--Need to make flight date picker-->
                        <tr>
                            <td rowspan="1">
                                <span class="fltDtls">
                                    <b>
                                        {{$Flight->departure_from}} - {{$Flight->departure_to}}
                                    </b>
                                </span>
                            </td>
                            <td>
                                <center><img alt="segment image" class="arlnLogo"
                                             src="{{url('storage/app/public/images/package/' . $segmentF->icon)}}"
                                             style="width: 45px;height: 45px;"></center>
                                <center>{{$segmentF->flight}} {{$segmentF->flight_number}}</center>
                            </td>
                            <td>
                        <span class="fltDtls">
                            {{$segmentF->departure_from}}                            <br>
                            <span class="fs11 c66 lh16 di mr15">
                                <i class="fas fa-calendar fs11 flight-date-icon" aria-hidden="true">
                                </i>
                                <b><span class="span-date flight-date">
                                 @if ($segmentF->departure_date != 0)
                                            {{date("d-m-Y", strtotime($segmentF->departure_date))}}
                                        @else
                                            {{ '00-00-0000'}}
                                        @endif
                            </span></b>
                            </span>
                            <span class="fs11 c66 lh16 di mr15 ">
                                <i class="fas fa-clock-o" aria-hidden="true">
                                </i>
                                <b>{{$segmentF->departure_time}}</b>
                            </span>
                        </span>
                            </td>
                            <td>
                        <span class="fltDtls">
                            {{$segmentF->arrival_to}}                           <br>
                            <span class="fs11 c66 lh16 di mr15">
                                <i class="fas fa-calendar fs11 flight-date-icon" aria-hidden="true">
                                </i>
                                <b><span class="span-date flight-date">
                                   @if ($segmentF->arrival_date != 0)
                                            {{date("d-m-Y", strtotime($segmentF->arrival_date))}}
                                        @else
                                            {{'00-00-0000'}}
                                        @endif
                                </span></b>
                            </span>
                            <span class="fs11 c66 lh16 di mr15">
                                <i class="fas fa-clock-o" aria-hidden="true">
                                </i>
                                <b>{{$segmentF->arrival_time}}</b>
                            </span>
                        </span>
                            </td>
                        </tr>
                    @endforeach
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
</div>
