<div class="col-md-4 col-sm-3 col-xs-6">
    <div class="application-field-div">
        @if ($requirement->required == '1')
            <span class="required">*</span>
        @endif
        <label>{{$requirement->requirement->name}}</label>
        @if ($requirement->required == '1')
        @else
            <select name="requirement[{{$i}}][{{$requirement->requirement->field}}]"
                    class="selectpicker" required>
                <option vlaue="">{{trans('messages.Select')}}</option>
                @foreach(config('constans.public_variable.'.$requirement->requirement->field) as $key => $value)
                    <option value="{{$key}}">
                        {{trans('messages.'.$value)}}
                    </option>
                @endforeach
            </select>
        @endif
    </div>
</div>
