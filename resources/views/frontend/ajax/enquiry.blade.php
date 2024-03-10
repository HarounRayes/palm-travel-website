<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 style="margin: 10px 0;">
        {{trans('messages.Enquiry_information')}} : {{$package->name}}
    </h4>
</div>

<div class="modal-body" style="padding-top: 10px;">
    <table class="grid highlight info-table" width="100%">
        <thead>
        <th style="background-color:#004c6c;">
            {{trans('messages.Room')}}
        </th>
        <th style="background-color:#004c6c;">
            <span>{{trans('messages.Adults2')}}</span>
        </th>
        <th style="background-color:#004c6c;">
            {{trans('messages.children3')}}
        </th>
        <th style="background-color:#004c6c;">
            {{trans('messages.children2')}}
        </th>
        <th style="background-color:#004c6c;">
            {{trans('messages.infant')}}
        </th>
        <th style="background-color:#004c6c;">
            {{trans('messages.Room_Cost')}}
        </th>
        </thead>
        <tbody>
        <?php $counter = 1;?>
        @foreach($rooms as $room)
            <?php
            $child1 = 0;
            $child2 = 0;
            $infant = 0;
            if (($room->age_child_1 > 0) && ($room->age_child_1 <= 2)) {
                $infant++;
            }
            if (($room->age_child_2 > 0) && ($room->age_child_2 <= 2)) {
                $infant++;
            }
            if (($room->age_child_1 >= 3) && ($room->age_child_1 <= 5)) {
                $child2++;
            }
            if (($room->age_child_2 >= 3) && ($room->age_child_2 <= 5)) {
                $child2++;
            }
            if (($room->age_child_1 >= 6) && ($room->age_child_1 <= 11)) {
                $child1++;
            }
            if (($room->age_child_2 >= 6) && ($room->age_child_2 <= 11)) {
                $child1++;
            }
            ?>
            <tr>
                <td> {{trans('messages.Room')}} {{$counter}}</td>
                <td>{{$room->num_adult}}</td>
                <td>{{$child1 }}</td>
                <td>{{$child2}}</td>
                <td>{{$infant}}</td>
                <td>{{$room->room_cost}}</td>
            </tr>
            <?php $counter++ ?>
        @endforeach

        </tbody>

    </table>
    <br>
    @if($tours->count() >0)
        <table class="grid highlight info-table" width="100%">
            <thead>
            <th style="background-color:#004c6c;">
                {{trans('messages.Day')}}
            </th>
            <th style="background-color:#004c6c;">
                {{trans('messages.Tour')}}
            </th>
            <th style="background-color:#004c6c;">
                {{trans('messages.Type')}}
            </th>
            <th style="background-color:#004c6c;">
                <span class="hidden-xs">{{trans('messages.Adults2')}}</span>
            </th>
            <th style="background-color:#004c6c;">
                {{trans('messages.children1')}}
            </th>
            <th style="background-color:#004c6c;">
                {{trans('messages.infant')}}
            </th>

            <th style="background-color:#004c6c;">
                {{trans('messages.Tour_Cost')}}
            </th>
            </thead>
            <tbody>
            @foreach($tours as $tour)
                <tr>
                    <td> {{trans('messages.Day-number' ,['number' => $tour->number_day])}}</td>
                    <td>{{$tour->tour->name }}</td>
                    @if (isset($tour->tour->is_bus) && $tour->tour->is_bus == '1')
                        <td>{{trans('messages.Bus')}}</td>
                    @else
                        <td>{{trans('messages.Car')}}</td>
                    @endif
                    <td>{{$tour->adult_number}}</td>
                    @if (isset($tour->tour->is_bus) && $tour->tour->is_bus == '1')
                        <td>{{$tour->child_number_2}}</td>
                        <td>{{$tour->child_number}}</td>
                    @else
                        <td>--</td>
                        <td>--</td>
                    @endif
                    <td>{{$tour->tour_cost}}</td>
                </tr>
            @endforeach
            </tbody>

        </table>
        <br>
    @endif
    <table class="grid highlight info-table" width="100%">
        <thead>

        </thead>
        <tbody>
        <tr>
            <td style="width: 50%;background-color:#004c6c;color:#fff">
                {{trans('messages.Total_Package_Rate')}}  </td>
            <td style="width: 50%">{{$enquiry->cost}}</td>
        </tr>
        </tbody>
    </table>

    <hr>

    <h1 class="s-property-title">
        {{trans('messages.Please_fill')}}
    </h1>
    @if(isset($is_booking) && $is_booking == "1")
        <form method="post" action="{{route('order.save')}}">
            @else
                <form method="post" action="{{route('send-enquiry')}}">
                    @endif
                    @csrf
                    <input type="hidden" name="enquiry_id" value="{{$enquiry->id}}"/>
                    <input type="hidden" name="package_id" value="{{$package->id}}"/>
                    <input type="hidden" name="all_person" value="{{$all_person}}"/>
                    <input type="hidden" name="package_hotel_id" value="{{$package_hotel_id}}"/>
                    <input type="hidden" name="hotel_id" value="{{$hotel_id}}"/>
                    @if(!Auth::guard('member')->check())
                        <div class="form-group">
                            <input type="text" class="form-control min-form-control" id="name" name="name"
                                   placeholder="{{trans('messages.Full_name')}}" required="true"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control min-form-control" id="phone" name="phone"
                                   placeholder="{{trans('messages.Phone')}}" required="true"/>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control min-form-control" id="email" name="email"
                                   placeholder="{{trans('messages.Email')}}" required="true"/>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control min-form-control" id="address"
                                   placeholder="{{trans('messages.Address')}}" name="address"/>
                        </div>
                    @endif
                    <div class="form-group">
        <textarea class="form-control" id="message" name="message" placeholder="{{trans('messages.Message')}}" rows="5"
                  style="max-width: 100%;"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="navbar-btn nav-button login" name="send_enquiry_submit" type="submit"
                                data-wow-delay="0.45s">
                            @if(isset($is_booking) && $is_booking == "1")
                                {{trans('messages.Checkout')}}
                            @else
                                {{trans('messages.Send')}}
                            @endif
                        </button>
                    </div>
                </form>

</div>

<div class="modal-footer">
</div>
