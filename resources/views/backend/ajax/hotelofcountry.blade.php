<?php
?>
<div class="row">
    <div class="col-sm-1">
        <label>Hotels
        </label>
    </div>
    <div class="col-sm-10">
        @if($hotels)
            <select class="form-control select2bs4" id="package_hotel" style="width: 100%;">
                <option value="">Select Hotel</option>
                @foreach($hotels as $hotel)
                    <option value="{{$hotel->id}}">{{$hotel->name_en}}</option>
                @endforeach
            </select>
        @endif
    </div>
    <div class="col-sm-1">
        <input type="button" class="btn btn-primary btn-sm " value="+" style="width: 50px" onclick="add_hotel()">
    </div>
</div>
<hr>
