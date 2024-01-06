@if($nationality->is_visa)
<div class="col-md-2 col-xs-4 label-div">
    <label>{{trans('messages.visa-type')}}</label>
</div>
<div class="col-md-2 col-xs-4" style="padding: 6px 0;">
    <select id="lunchBegins" class="selectpicker"
            data-live-search-style="begins" name="type" required data-live-search="true"
            title="{{trans('messages.visa-type')}}">
        <option value="">{{trans('messages.visa-type')}}</option>
        @foreach($nationality->types as $type)
            <option
                value="{{$type->type->symbol}}" {{ request()->type == $type->type->symbol ? "selected" : "" }}>{{$type->type->name}}</option>
        @endforeach
    </select>
</div>
@endif
