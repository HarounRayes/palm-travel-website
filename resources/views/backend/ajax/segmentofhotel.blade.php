<div class="card card-default div-hotel-segment-{{$count_hotel}}">
    <input type="hidden" name="hotel[segments][{{$count_hotel}}][segments][]" value="1">
    <input type="hidden" name="hotel[segments][{{$count_hotel}}][hotel_id][]" value="{{$hotel_segment->id}}">
    <div class="card-header">
        <h5 class="card-title">
           Segment ({{$hotel_segment->name_en}})
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
                    <input class="form-control datepicker-segment-{{$count_hotel}}-{{$count_hotel_segment}}"
                           id="check-in-datepicker-segment-{{$count_hotel}}-{{$count_hotel_segment}}" type="text"
                           name="hotel[segments][{{$count_hotel}}][check_in][]">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Check out</label>
                    <input class="form-control datepicker-segment-{{$count_hotel}}-{{$count_hotel_segment}}"
                           id="check-out-datepicker-segment-{{$count_hotel}}-{{$count_hotel_segment}}" type="text"
                           name="hotel[segments][{{$count_hotel}}][check_out][]">
                </div>
            </div>
        </div>
    </div>
</div>
