<div class="card card-default div-day-tour-{{($day_repeater-1)}}">
    <div class="card-header">
        <h5 class="card-title">
            Day Tour ({{$day_tour_repeater}})
        </h5>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget-custom="remove"><i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>City</label>
                    @if($cities)
                        <select class="form-control" id="select-{{($day_repeater-1)}}-{{($day_tour_repeater-1)}}" name="tour-city"
                                onchange="select_tour_of_city('{{($day_repeater-1)}}',this.value,'{{($day_tour_repeater-1)}}')">
                            <option value="">Select city</option>
                            @foreach($cities as $city)
                                @if($daytour->tour->city_id == $city->id)
                                    <option value="{{$city->id}}" selected="true">{{$city->name_en}} </option>
                                @else
                                    <option value="{{$city->id}}">  {{$city->name_en}} </option>
                                @endif
                            @endforeach
                        </select>
                    @endif

                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group" id="div-container-day-tour-{{($day_repeater-1)}}-{{($day_tour_repeater-1)}}">

                    <label>Tour</label>
                    @if(!$daytour->tour->allToursInCity()->isEmpty())
                        <select class="form-control select2bs4" name="days[tours][{{($day_repeater-1)}}][]" style="width: 100%;" required>
                            <option value="">Select Tour</option>
                            @foreach($daytour->tour->allToursInCity() as $one_tour)
                                @if($daytour->tour->id == $one_tour->id)
                                    <option value="{{$one_tour->id}}" selected="true">{{$one_tour->name_en}}</option>
                                @else
                                    <option value="{{$one_tour->id}}">{{$one_tour->name_en}}</option>
                                @endif
                            @endforeach
                        </select>
                    @endif

                </div>
            </div>
        </div>

    </div>
</div>
