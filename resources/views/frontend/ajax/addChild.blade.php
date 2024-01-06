@for ($i = 0; $i < $number; $i++)
<div class="col-xs-3 col-sm-6 padding-0-5">
    <label><b>
           {{trans('messages.Child_Age')}}
        </b></label>
    <select id="lunchBegins-{{$i}}-{{$counter}}" class="selectpicker1 child_input_value" title="Select" tabindex="-98" onchange="getSelected(this.value, 'Child-{{$i}}', '{{$counter}}')">
        <option class="bs-title-option" value="0">{{trans('messages.Select')}}</option>
        @for ($j = 1; $j < 12; $j++)
        <option>{{$j}}</option>
        @endfor
    </select>
</div>

@endfor

<input type="hidden" class="num-Child-0" name="num-Child-0-{{$counter}}" id="num-Child-0-{{$counter}}" value="0"/>
<input type="hidden" class="num-Child-1" name="num-Child-1-{{$counter}}" id="num-Child-1-{{$counter}}" value="0"/>
