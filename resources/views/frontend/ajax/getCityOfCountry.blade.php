<label>{{trans('messages.City')}}</label>
<select name="city" id="lunchBegins" class="selectpicker-activity" title="{{trans('messages.Select')}}" tabindex="-98" required>
    <option value="">{{trans('messages.Select')}} </option>
    @foreach ($cities as $city)
        <option value="{{$city->id}}" {{request()->city == $city->id ? "selected" : ""}}>{{$city->name}}</option>
    @endforeach
</select>
