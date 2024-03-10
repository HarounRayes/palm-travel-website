@if ($tours)
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
            {{trans('messages.Adults')}}

        </th>
        <th style="background-color:#004c6c;">
            {{trans('messages.Children')}}

        </th>
        <th style="background-color:#004c6c;">
            {{trans('messages.infant2')}}

        </th>

        <th style="background-color:#004c6c;">
            {{trans('messages.Tour_Cost')}}
        </th>
        <th style="background-color:#004c6c;"></th>
        </thead>
        <tbody>

        @foreach ($tours as $tour)
            <tr id="row-tour-{{$tour->id}}">
                <td>{{trans('messages.Day').' '.$tour->number_day}} </td>
                <td>{{$tour->tour->name}}</td>
                <td>
                    @if ($tour->type == '1')
                        {{trans('messages.Car')}}
                    @elseif ($tour->type == '2')
                        {{trans('messages.Bus')}}
                    @endif</td>
                <td>{{$tour->adult_number}}</td>
                @if ($tour->type == '2')
                    <td>{{$tour->child_number_2}}</td>
                    <td>{{$tour->child_number}}</td>
                @else
                    <td>0</td>
                    <td>0</td>
                @endif
                <td>{{$tour->tour_cost}}</td>
                <td><a onclick="DeleteOneTour('{{$tour->id}}','{{$tour->day_id}}')" style="cursor: pointer">
                        <i class="fas fa-close"></i> <span
                            class="hidden-xs"> {{trans('messages.Delete_Tour')}}</span></a>
                    <input id="session-tour-cost-{{$tour->id}}" value="{{$tour->tour_cost}}" type="hidden"/>
                </td>
            </tr>
        @endforeach

        </tbody>

    </table>
    <br>
@else
    <h3 class="center">
        {{trans('messages.No_selected_tours')}}
    </h3>
@endif
