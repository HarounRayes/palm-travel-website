@if($number > 0)
    <div class="col-md-2 col-sm-3 col-xs-3 m-t-20">
    <label>{{trans('messages.age-of-children')}} </label>
    </div>
    @for($i=1;$i<($number+1);$i++)
        <div class="col-md-2 col-sm-2 col-xs-3 m-t-20">
        <select id="ageChild{{$i}}" name="ageChild{{$i}}" class="selectpicker4"
                title="{{trans('messages.Child')}} {{$i}}" required>
            @for ($t = 1; $t < 12; $t++)
                <option value="{{$t}}">{{$t}}</option>
            @endfor
        </select>
        </div>
    @endfor
@endif
