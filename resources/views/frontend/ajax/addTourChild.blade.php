@for ($i = 0; $i < $number; $i++)
<div class="col-xs-3 col-sm-6 padding-0-5">
    <label><b>{{trans('messages.Child_Age')}} </b></label>
    <select id="lunchBegins" class="selectpicker2" title="Select" tabindex="-98" onchange="getTourSelected(this.value, 'Child-{{$i}}', '{{$counter}}')">
        <option class="bs-title-option" value="0">{{trans('messages.Select')}}</option>
        @for ($j = 1; $j < 12; $j++)
        <option>{{$j}}</option>
        @endfor
    </select>
</div>
@endfor
<input type="hidden" name="num-tour-Child-0-{{$counter}}" id="num-tour-Child-0-{{$counter}}" value="0"/>
<input type="hidden" name="num-tour-Child-1-{{$counter}}" id="num-tour-Child-1-{{$counter}}" value="0"/>
