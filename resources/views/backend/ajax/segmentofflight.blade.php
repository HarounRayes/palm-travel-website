<div class="card card-default div-flight-segment-{{$flight}}">
    <input type="hidden" name="flights[segments][{{$flight}}][segments][]">
    <div class="card-header">
        <h5 class="card-title">
            Segment ({{($count_flight_segment+1)}})
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
                    <input id="datepicker-flight-segment-departure-2-{{$flight}}-{{$count_flight_segment}}" class="form-control datepicker-flight-segment-{{$flight}}"
                           name="flights[segments][{{$flight}}][departure_date][]" type="text">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Departure time </label>
                    <input id="timepicker-flight-segment-departure-1-{{$flight}}-{{$count_flight_segment}}" class="form-control timepicker-flight-segment-{{$flight}}"
                           name="flights[segments][{{$flight}}][departure_time][]" type="text">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Arrival date </label>
                    <input id="datepicker-flight-segment-arrival-1-{{$flight}}-{{$count_flight_segment}}" class="form-control datepicker-flight-segment-{{$flight}}"
                           name="flights[segments][{{$flight}}][arrival_date][]" type="text">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Arrival time</label>
                    <input id="timepicker-flight-segment-avrrival-2-{{$flight}}-{{$count_flight_segment}}" class="form-control timepicker-flight-segment-{{$flight}}"
                           name="flights[segments][{{$flight}}][arrival_time][]" type="text">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Flight number</label>
                    <input class="form-control" name="flights[segments][{{$flight}}][flight_number][]" type="number">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Icon</label>
                    <input class="form-control" name="flights[segments][{{$flight}}][icon][]" type="file">
                </div>
            </div>
        </div>
        @if(Auth::guard('admin')->user()->hasPermissionTo('packages.create.en'))

            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label>English Departure from</label>
                        <input class="form-control" name="flights[segments][{{$flight}}][departure_from_en][]"
                               type="text">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>English Arrival to</label>
                        <input class="form-control" name="flights[segments][{{$flight}}][arrival_to_en][]" type="text">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>English Flight</label>
                        <input class="form-control" name="flights[segments][{{$flight}}][flight_en][]" type="text">
                    </div>
                </div>
            </div>
        @endif
        @if(Auth::guard('admin')->user()->hasPermissionTo('packages.create.ar'))
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Arabic Departure from</label>
                        <input class="form-control" name="flights[segments][{{$flight}}][departure_from_ar][]"
                               type="text">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Arabic Arrival to</label>
                        <input class="form-control" name="flights[segments][{{$flight}}][arrival_to_ar][]" type="text">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Arabic Flight</label>
                        <input class="form-control" name="flights[segments][{{$flight}}][flight_ar][]" type="text">
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
