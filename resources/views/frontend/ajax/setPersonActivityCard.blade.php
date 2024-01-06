@if($number == 1)
    <h4>{{trans('messages.Lead-passenger')}}</h4>
    <input type="hidden" name="person[{{$card}}][main_passenger]" value="1">
    <div class="row" >
        <div class="col-xs-6">
            <label>{{trans('messages.Name')}}</label>
            <input name="person[{{$card}}][firstname][0]"
                   type="text" required
                   class="form-control"
                   placeholder="{{trans('messages.Name')}}"/>
        </div>
        <div class="col-xs-6">
            <label>{{trans('messages.Surname')}}</label>
            <input name="person[{{$card}}][lastname][0]"
                   type="text" required
                   class="form-control"
                   placeholder="{{trans('messages.Surname')}}"
            />
        </div>
    </div>
@else
    <h4>{{trans('messages.All-passenger')}}</h4>
    <input type="hidden" name="person[{{$card}}][main_passenger]" value="0">

    @for($i=0;$i<$number;$i++)
        <div class="row" >
            <p style="padding: 15px 15px 0">{{trans('messages.Passenger')}} {{($i+1)}}</p>
            <div class="col-xs-6">
                <label>{{trans('messages.Name')}}</label>
                <input
                    name="person[{{$card}}][firstname][{{$i}}]"
                    type="text" required
                    class="form-control"
                    placeholder="{{trans('messages.Name')}}"/>
            </div>
            <div class="col-xs-6">
                <label>{{trans('messages.Surname')}}</label>
                <input
                    name="person[{{$card}}][lastname][{{$i}}]"
                    type="text" required
                    class="form-control"
                    placeholder="{{trans('messages.Surname')}}"/>
            </div>
        </div>
    @endfor
@endif
