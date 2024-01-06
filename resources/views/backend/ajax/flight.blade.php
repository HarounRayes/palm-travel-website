<div class="card card-default div-flight">
    <input type="hidden" name="flights[flights][]" value="1" >
    <div class="card-header">
        <h5 class="card-title" style="width: 100%">
            Flight ({{($count_flight+1)}})
        </h5>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget-custom="remove"><i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            @if(Auth::guard('admin')->user()->hasPermissionTo('packages.create.en'))
                <div class="col-md-6">
                    <div class="form-group">
                        <label>English Departure from</label>
                        <input class="form-control" type="text" name="flights[departure_from_en][]">
                    </div>
                </div>
            @endif
            @if(Auth::guard('admin')->user()->hasPermissionTo('packages.create.ar'))
                <div class="col-md-6">
                    <div class="form-group">
                        <label>المغادرة من</label>
                        <input class="form-control" type="text" name="flights[departure_from_ar][]">

                    </div>
                </div>
            @endif
        </div>
        <div class="row">
            @if(Auth::guard('admin')->user()->hasPermissionTo('packages.create.en'))

                <div class="col-md-6">
                    <div class="form-group">
                        <label>English Arrival to</label>
                        <input class="form-control" type="text" name="flights[departure_to_en][]">
                    </div>
                </div>
            @endif
            @if(Auth::guard('admin')->user()->hasPermissionTo('packages.create.ar'))
                <div class="col-md-6">
                    <div class="form-group">
                        <label> الوصول إلى </label>
                        <input class="form-control" type="text" name="flights[departure_to_ar][]">
                    </div>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header">
                            <h3 class="card-title" style="width: 100%">
                                <input type="button" class="btn btn-primary btn-sm " value="+" style="width: 50px"
                                       onclick="add_flight_segment({{$count_flight}})">Segment</h3>
                        </div>
                        <div class="card-body" id='div-container-flight-segment-{{$count_flight}}'>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

