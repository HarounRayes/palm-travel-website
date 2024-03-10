<form name="uae-from" method="get" action="{{route('visa.uae')}}">
    <input name="outbound" value="0" type="hidden"/>
    <input name="uae" value="1" type="hidden"/>
    <div class="form-control-visa" style="width: 40%;">
        <label> {{trans('messages.your-nationality')}} </label>
        <select name="nationality" id="lunchBegins" class="selectpicker-visa" title="{{trans('messages.Select')}}"
                tabindex="-98" required>
            <option class="bs-title-option" value="">
                {{trans('messages.Select')}}
            </option>
            @foreach ($nationalities as $nationality)
                <option
                    {{$nationality->id==request()->nationality?"selected":""}} value="{{$nationality->id}}">{{$nationality->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-control-visa">
        <label style="width: 100%"><br> </label>
        <input type="submit" value=" {{trans('messages.Go')}}"/>
    </div>
</form>
