
<label>Tour</label>
@if($tours)
    <select class="form-control select2bs4" name="days[tours][{{$day}}][]" style="width: 100%;" required>
        <option value="">Select Tour</option>
        @foreach($tours as $tour)
            <option value="{{$tour->id}}">{{$tour->name_en}}</option>
        @endforeach
    </select>
@endif
