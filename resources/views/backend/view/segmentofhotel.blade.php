<div class="card card-default div-hotel-segment-{{$package_hotel_repeater}}">
    <input type="hidden" name="hotel[segments][{{$package_hotel_repeater}}][segments][]" value="1">
    <input type="hidden" name="hotel[segments][{{$package_hotel_repeater}}][hotel_id][]" value="{{$hotelsegments->hotel->id}}">
    <div class="card-header">
        <h5 class="card-title">
           Segment ({{$hotelsegments->hotel->name_en}})
        </h5>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget-custom="remove"><i class="fas fa-times"></i></button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">

            <div class="col-md-4">
                <div class="form-group">
                    <label>Check In</label>
                    <input class="form-control datepicker datepicker-segment-{{$package_hotel_repeater}}-{{$hotel_segments_repeater}}"
                           id="check-in-datepicker-segment-{{$package_hotel_repeater}}-{{$hotel_segments_repeater}}" type="text"
                           name="hotel[segments][{{$package_hotel_repeater}}][check_in][]" value="{{$hotelsegments->check_in}}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Check out</label>
                    <input class="form-control datepicker datepicker-segment-{{$package_hotel_repeater}}-{{$hotel_segments_repeater}}"
                           id="check-out-datepicker-segment-{{$package_hotel_repeater}}-{{$hotel_segments_repeater}}" type="text"
                           name="hotel[segments][{{$package_hotel_repeater}}][check_out][]"  value="{{$hotelsegments->check_out}}">
                </div>
            </div>
        </div>


    </div>
</div>
