<div class="card card-default div-transfer">
    <input type="hidden" name="transfers[transfers][]" value="{{($transfer_repeater-1)}}">
    <div class="card-header">
        <h5 class="card-title" style="width: 100%">
            Transfer ({{$transfer_repeater}})
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
                    <label>Transfer Date</label>
                    <input type="text" class="form-control datepicker datepicker-transfer" name="transfers[date][{{($transfer_repeater-1)}}]" value="{{($transfer->date)?date("d-m-Y", strtotime($transfer->date)):""}}"
                           id="datepicker-transfer-view-{{$transfer_repeater}}"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Transfer Time</label>
                    <input type="text" class="form-control timepicker timepicker-transfer" name="transfers[time][{{($transfer_repeater-1)}}]" value="{{$transfer->time}}"
                           id="timepicker-transfer-view-{{$transfer_repeater}}"/>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">

                <div class="form-group clearfix">
                    <div class="col-sm-1"></div>
                    @foreach ($transfer_image_array as $key => $transfer_image)
                    @if ($transfer->image == ($transfer_image.'.jpg'))
                            <div class="icheck-primary col-sm-2" style="float: left">
                                <input checked type="radio" id="radioPrimaryTransfer-{{$key}}-{{$transfer_repeater}}" name="transfers[image][{{($transfer_repeater-1)}}]" value="{{$transfer_image}}.jpg">
                                <label for="radioPrimaryTransfer-{{$key}}-{{$transfer_repeater}}">
                                    <img src="{{url('img/'.$transfer_image.'.jpg')}}" style="width:70px" />
                                </label>
                            </div>
                        @else
                            <div class="icheck-primary col-sm-3" style="float: left">
                                <input type="radio" id="radioPrimaryTransfer-{{$key}}-{{$transfer_repeater}}" name="transfers[image][{{($transfer_repeater-1)}}]" value="{{$transfer_image}}.jpg">
                                <label for="radioPrimaryTransfer-{{$key}}-{{$transfer_repeater}}">
                                    <img src="{{url('img/'.$transfer_image.'.jpg')}}" style="width:70px" />
                                </label>
                            </div>
                        @endif

                    @endforeach
                    <div class="col-sm-1"></div>
                </div>
            </div>
        </div>
        @if(Auth::guard('admin')->user()->hasAnyPermission(['packages.edit.en']))
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>English Type</label>
                    <input class="form-control" type="text" name="transfers[type_en][{{($transfer_repeater-1)}}]" value="{{$transfer->type_en}}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>English Pickup Location</label>
                    <input class="form-control" type="text" name="transfers[pickup_location_en][{{($transfer_repeater-1)}}]" value="{{$transfer->pickup_location_en}}">
                </div>

            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>English Drop Off Location</label>
                    <input class="form-control" type="text" name="transfers[drop_off_location_en][{{($transfer_repeater-1)}}]"  value="{{$transfer->drop_off_location_en}}">
                </div>
            </div>
        </div>
        @endif
        @if(Auth::guard('admin')->user()->hasAnyPermission(['packages.edit.ar']))
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Arabic Type</label>
                    <input class="form-control" type="text" name="transfers[type_ar][{{($transfer_repeater-1)}}]" value="{{$transfer->type_ar}}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Arabic Pickup Location</label>
                    <input class="form-control" type="text" name="transfers[pickup_location_ar][{{($transfer_repeater-1)}}]" value="{{$transfer->pickup_location_ar}}">
                </div>

            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Arabic Drop Off Location</label>
                    <input class="form-control" type="text" name="transfers[drop_off_location_ar][{{($transfer_repeater-1)}}]" value="{{$transfer->drop_off_location_ar}}">
                </div>
            </div>
        </div>
            @endif
    </div>
</div>
