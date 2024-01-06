<?php
?>
<label>City</label>
@if($cities)
    <select class="form-control select2bs4" id="city" name="activity_city_id" style="width: 100%;">
        <option value="">Select City</option>
        @foreach($cities as $city)
            <option value="{{$city->id}}">{{$city->name_en}}</option>
        @endforeach
    </select>
@endif
