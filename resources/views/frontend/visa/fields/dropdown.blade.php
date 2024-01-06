<div class="col-md-4 col-sm-3 col-xs-6">
    <div class="application-field-div">
        @if ($requirement->required == '1')
            <span class="required">*</span>
        @endif
        <label>{{$requirement->name}}</label>
        @if ($requirement->required == '1')
            <select name="requirement[{{$i}}][{{$requirement->field}}]"
                    class="selectpicker" required>
                <option vlaue="">{{trans('messages.Select')}}</option>
                    @foreach(config('constans.public_variable.'.$requirement->field) as $key => $value)
                        <option value="{{$key}}">
                            {{trans('messages.'.$value)}}
                        </option>
                    @endforeach
            </select>
        @else
            <select name="requirement[{{$i}}][{{$requirement->field}}]"
                    class="selectpicker">
                <option vlaue="">{{trans('messages.Select')}}</option>
                    @foreach(config('constans.public_variable.'.$requirement->field) as $key => $value)
                        <option value="{{$key}}">
                            {{trans('messages.'.$value)}}
                        </option>
                    @endforeach
            </select>
        @endif
    </div>
</div>
