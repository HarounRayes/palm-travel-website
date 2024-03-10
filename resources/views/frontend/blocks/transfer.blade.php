<div class="table-responsive">
    <div class="scrllTble flhtDt">
        <table class="grid highlight info-table" width="100%">
            <thead>
            <tr>
                <th style="background-color:#559685;">
                    {{trans('messages.Arrival_and_departure')}}
                </th>
                <th style="background-color:#559685;">
                    {{trans('messages.pickup')}}
                </th>
                <th style="background-color:#559685;">
                    {{trans('messages.Drop-off')}}
                </th>
                <th style="background-color:#559685;">
                    {{trans('messages.Date_and_Time')}}
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach ($package->transfers as $Transfer)
            <!--Need to make flight date picker-->
            <tr>
                <td rowspan="1" style="width:100px;">
                            <span class="fltDtls">
                                <b>
                           {{$Transfer->type}} 
                                </b>
                            </span>
                    @if ($Transfer->image != '')
                        <center><img src="{{url('img/'.$Transfer->image)}}" style="width:30px;height:30px"/></center>
                    @endif
                </td>
                <td>
                    <span class="fltDtls">
                        <span class="fs11 c66 lh16 di mr15">
                            {{$Transfer->pickup_location}}
                        </span>
                    </span>
                </td>
                <td>
                    <span class="fltDtls">
                        <span class="fs11 c66 lh16 di mr15">
                            {{$Transfer->drop_off_location}}
                        </span>
                    </span>
                </td>

                <td>
                    <span class="fltDtls">

                        <span class="fs11 c66 lh16 di mr15">
                            <i class="fas fa-calendar fs11" aria-hidden="true">
                            </i>
                            <b><span class="span-date">
                                    @if ($Transfer->date != 0)
                                        {{ date("d-m-Y", strtotime($Transfer->date))}}
                                    @else
                                        {{ '00-00-0000' }}
                                    @endif
                                </span></b>
                        </span><br>
                        <span class="fs11 c66 lh16 di mr15">
                            <i class="fas fa-clock-o" aria-hidden="true">
                            </i>

                            <b>
                              {{$Transfer->time}}</b>
                        </span>
                    </span>
                </td>

            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
