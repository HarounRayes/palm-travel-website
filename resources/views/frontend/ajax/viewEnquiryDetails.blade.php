<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 style="margin: 10px 0;">
        {{$enquiry->package->name}}
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
    @foreach($enquiry->rooms as $room)
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
@if(!$enquiry->tours->isEmpty())
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
        @foreach($enquiry->tours as $tour)
            <tr>
                <td> {{trans('messages.Day-number' , ['number' => $tour->number_day])}}</td>
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
    {{trans('messages.enquiry-message-details')}}
</h1>
{{--    <div class="form-group">--}}
{{--        <input type="text" class="form-control min-form-control" disabled value="{{$enquiry->name}}" />--}}
{{--    </div>--}}
{{--    <div class="form-group">--}}
{{--        <input type="text" class="form-control min-form-control" disabled value="{{$enquiry->phone}}"/>--}}
{{--    </div>--}}
{{--    <div class="form-group">--}}
{{--        <input type="email" class="form-control min-form-control" disabled value="{{$enquiry->email}}"/>--}}
{{--    </div>--}}

{{--    <div class="form-group">--}}
{{--        <input type="text" class="form-control min-form-control" disabled value="{{$enquiry->address}}"/>--}}
{{--    </div>--}}
    <div class="form-group">
        <textarea class="form-control" disabled style="max-width: 100%;">{{$enquiry->message}}</textarea>
    </div>
</div>

<div class="modal-footer">
</div>
