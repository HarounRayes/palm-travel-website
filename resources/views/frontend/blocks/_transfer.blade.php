@foreach ($package->transfers as $key => $Transfer)
    <!--Need to make flight date picker-->
    @if($key == 0)
        <div class="transfer-box-container">
            <div class="transfer-box">
                <div><img src="{{url('img/airplane.jpg')}}" style="width:30px;height:30px"/></div>
                <!--<div><img src="{{url('img/'.$Transfer->image)}}" style="width:30px;height:30px"/></div>-->
                <div><img src="{{url('img/taxi cab.gif')}}" style="width:30px;height:30px"/></div>
                <div><img src="{{url('img/hotel.png')}}" style="width:30px;height:30px"/></div>
            </div>
            <div class="transfer-box-details">
                <div>{{$Transfer->pickup_location}}<br>
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
                </div>
                <div>{{$Transfer->drop_off_location}}</div>
            </div>
        </div>
    @else
        <div class="transfer-box-container">
            <div class="transfer-box">
                <div><img src="{{url('img/hotel.png')}}" style="width:30px;height:30px"/></div>
                <!--<div><img src="{{url('img/'.$Transfer->image)}}" style="width:30px;height:30px"/></div>-->
                <div><img src="{{url('img/taxi cab.gif')}}" style="width:30px;height:30px"/></div>
                <div><img src="{{url('img/airplane.jpg')}}" style="width:30px;height:30px"/></div>
            </div>
            <div class="transfer-box-details">
                <div>{{$Transfer->pickup_location}}<br>
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
                </div>
                <div>{{$Transfer->drop_off_location}}</div>
            </div>
        </div>
    @endif
@endforeach