<div class="card card-default div-day-tour-{{$day}}">
    <div class="card-header">
        <h5 class="card-title">
            Day Tour ({{($count_day_tour+1)}})
        </h5>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget-custom="remove"><i class="fas fa-times"></i></button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    @if($country == null || $country = '')
                        You must select country
                        @else
                    <label>City</label>
                    @if($cities)
                        <select class="form-control" onchange="select_tour_of_city('{{$day}}',this.value,'{{$count_day_tour}}')">
                            <option value="">Select city</option>
                            @foreach($cities as $city)
                                <option value="{{$city->id}}">  {{$city->name_en}} </option>
                            @endforeach
                        </select>
                    @endif
                        @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group" id="div-container-day-tour-{{$day}}-{{$count_day_tour}}">
                </div>
            </div>
        </div>

    </div>
</div>
