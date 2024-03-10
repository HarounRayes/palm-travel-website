<form method="get" action="{{route('visa.outbound.nationality')}}">
    <input type="hidden" name="visa" value="{{$visa->id}}"/>
    <div class="form-group">
        <label> {{trans('messages.Your-Nationality')}}</label>
        <select name="nationality" required id="lunchBegins" class="selectpicker-visa-2"
                title="{{trans('messages.Select')}}">
            @foreach ($nationalities as $nationality)
                <option value="{{$nationality->id}}">
                    {{$nationality->name}}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <input type="submit" value="{{trans('messages.ok')}}" class="btn btn-success"/>
    </div>
</form>
