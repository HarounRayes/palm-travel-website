<div class="card card-default div-flight-segment-{{($flight_repeater-1)}}">
    <input type="hidden" name="flights[segments][{{($flight_repeater-1)}}][segments][]">
    <div class="card-header">
        <h5 class="card-title">
            Segment ({{$segment_repeater}})
        </h5>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget-custom="remove"><i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Departure date </label>
                    <input id="datepicker-flight-2-{{$segment_repeater}}-{{($flight_repeater-1)}}"
                           class="form-control datepicker datepicker-flight-{{($flight_repeater-1)}}"
                           name="flights[segments][{{($flight_repeater-1)}}][departure_date][]" type="text"
                           value="{{($segment->departure_date)?date("d-m-Y", strtotime($segment->departure_date)):""}}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Departure time </label>
                    <input id="timepicker-flight-departure-2-{{$segment_repeater}}-{{($flight_repeater-1)}}"
                           class="form-control timepicker timepicker-flight-{{($flight_repeater-1)}}"
                           name="flights[segments][{{($flight_repeater-1)}}][departure_time][]" type="text"
                           value="{{$segment->departure_time}}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Arrival date </label>
                    <input id="datepicker-flight-1-{{$segment_repeater}}-{{($flight_repeater-1)}}"
                           class="form-control datepicker datepicker datepicker-flight-{{($flight_repeater-1)}}"
                           name="flights[segments][{{($flight_repeater-1)}}][arrival_date][]" type="text"
                           value="{{($segment->arrival_date)?date("d-m-Y", strtotime($segment->arrival_date)):""}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Arrival time</label>
                    <input id="timepicker-flight-arrival-1-{{$segment_repeater}}-{{($flight_repeater-1)}}"
                           class="form-control timepicker timepicker-flight-{{($flight_repeater-1)}}"
                           name="flights[segments][{{($flight_repeater-1)}}][arrival_time][]" type="text"
                           value="{{$segment->arrival_time}}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Flight number</label>
                    <input class="form-control" name="flights[segments][{{($flight_repeater-1)}}][flight_number][]"
                           type="number" value="{{$segment->flight_number}}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Icon</label>
                    <input type="hidden" value="{{$segment->icon}}" name="flights[segments][{{($flight_repeater-1)}}][last_icon][]">
                    <input class="form-control" name="flights[segments][{{($flight_repeater-1)}}][icon][]" type="file" value="">
                    @if(isset($segment->icon))
                        <img style="width: 150px;"
                             src="{{ url('storage/app/public/images/package/'.$segment->icon) }}"/>
                    @endif
                </div>
            </div>
        </div>
        @if(Auth::guard('admin')->user()->hasAnyPermission(['packages.edit.en']))
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>English Departure from</label>
                        <input class="form-control" name="flights[segments][{{($flight_repeater-1)}}][departure_from_en][]"
                               type="text" value="{{$segment->departure_from_en}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>English Arrival to</label>
                        <input class="form-control" name="flights[segments][{{($flight_repeater-1)}}][arrival_to_en][]"
                               type="text" value="{{$segment->arrival_to_en}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>English Flight</label>
                        <input class="form-control" name="flights[segments][{{($flight_repeater-1)}}][flight_en][]"
                               type="text" value="{{$segment->flight_en}}">
                    </div>
                </div>
            </div>
        @endif
        @if(Auth::guard('admin')->user()->hasAnyPermission(['packages.edit.ar']))
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Arabic Departure to</label>
                        <input class="form-control" name="flights[segments][{{($flight_repeater-1)}}][departure_from_ar][]"
                               type="text" value="{{$segment->departure_from_ar}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Arabic Arrival from</label>
                        <input class="form-control" name="flights[segments][{{($flight_repeater-1)}}][arrival_to_ar][]"
                               type="text" value="{{$segment->arrival_to_ar}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Arabic Flight</label>
                        <input class="form-control" name="flights[segments][{{($flight_repeater-1)}}][flight_ar][]"
                               type="text" value="{{$segment->flight_ar}}">
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
