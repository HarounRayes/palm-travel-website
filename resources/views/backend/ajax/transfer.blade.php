<div class="card card-default div-transfer">
    <input type="hidden" name="transfers[transfers][]" value="{{$count_transfer}}">
    <div class="card-header">
        <h5 class="card-title" style="width: 100%">
            Transfer ({{($count_transfer+1)}})
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
                    <input type="text" class="form-control datepicker-transfer" name="transfers[date][{{$count_transfer}}]"
                           id="datepicker-transfer-add-{{$count_transfer}}"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Transfer Time</label>
                    <input type="text" class="form-control timepicker-transfer" name="transfers[time][{{$count_transfer}}]"
                           id="timepicker-transfer-add-{{$count_transfer}}"/>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">

                <div class="form-group clearfix">
                    <div class="col-sm-1"></div>
                    <div class="icheck-primary col-sm-2" style="float: left">
                        <input type="radio" id="radioPrimaryTransfer1-{{$count_transfer+1}}" name="transfers[image][{{$count_transfer}}]" value="car.jpg">
                        <label for="radioPrimaryTransfer1-{{$count_transfer+1}}">
                            <img src="{{url('img/car.jpg')}}" style="width:70px" />
                        </label>
                    </div>
                    <div class="icheck-primary col-sm-2" style="float: left">
                        <input type="radio" id="radioPrimaryTransfer2-{{$count_transfer+1}}" name="transfers[image][{{$count_transfer}}]" value="bus.jpg">
                        <label for="radioPrimaryTransfer2-{{$count_transfer+1}}">
                            <img src="{{url('img/bus.jpg')}}" style="width:70px" />
                        </label>
                    </div>
                    <div class="icheck-primary col-sm-2" style="float: left">
                        <input type="radio" id="radioPrimaryTransfer3-{{$count_transfer+1}}" name="transfers[image][{{$count_transfer}}]" value="boat.jpg">
                        <label for="radioPrimaryTransfer3-{{$count_transfer+1}}">
                            <img src="{{url('img/boat.jpg')}}" style="width:70px" />
                        </label>
                    </div>
                    <div class="icheck-primary col-sm-2" style="float: left">
                        <input type="radio" id="radioPrimaryTransfer4-{{$count_transfer+1}}" name="transfers[image][{{$count_transfer}}]" value="train.jpg">
                        <label for="radioPrimaryTransfer4-{{$count_transfer+1}}">
                            <img src="{{url('img/train.jpg')}}" style="width:70px" />
                        </label>
                    </div>
                    <div class="icheck-primary col-sm-2" style="float: left">
                        <input type="radio" id="radioPrimaryTransfer5-{{$count_transfer+1}}" name="transfers[image][{{$count_transfer}}]" value="airplane.jpg">
                        <label for="radioPrimaryTransfer5-{{$count_transfer+1}}">
                            <img src="{{url('img/airplane.jpg')}}" style="width:70px" />
                        </label>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </div>
        </div>
        @if(Auth::guard('admin')->user()->hasPermissionTo('packages.create.en'))
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>English Type</label>
                    <input class="form-control" type="text" name="transfers[type_en][{{$count_transfer}}]">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>English Pickup Location</label>
                    <input class="form-control" type="text" name="transfers[pickup_location_en][{{$count_transfer}}]">
                </div>

            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>English Drop Off Location</label>
                    <input class="form-control" type="text" name="transfers[drop_off_location_en][{{$count_transfer}}]">
                </div>
            </div>
        </div>
        @endif
        @if(Auth::guard('admin')->user()->hasPermissionTo('packages.create.ar'))
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Arabic Type</label>
                    <input class="form-control" type="text" name="transfers[type_ar][{{$count_transfer}}]">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Arabic Pickup Location</label>
                    <input class="form-control" type="text" name="transfers[pickup_location_ar][{{$count_transfer}}]">
                </div>

            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Arabic Drop Off Location</label>
                    <input class="form-control" type="text" name="transfers[drop_off_location_ar][{{$count_transfer}}]">
                </div>
            </div>
        </div>
            @endif
    </div>
</div>
