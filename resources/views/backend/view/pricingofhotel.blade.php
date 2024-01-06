<div class="card card-default div-pricing-details-{{$package_hotel_repeater}}">
    <input type="hidden" name="hotel[pricing][{{$package_hotel_repeater}}][pricing][]" value="1">
    <div class="card-header">
        <h5 class="card-title">
            Pricing Details
        </h5>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget-custom="remove"><i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            @if(Auth::guard('admin')->user()->hasAnyPermission(['packages.edit.en']))
                <div class="col-md-6">
                    <div class="form-group">
                        <label>English Cost</label>
                        <input class="form-control" type="text"
                               name="hotel[pricing][{{$package_hotel_repeater}}][cost_en][]"
                               value="{{$hotelPricingDetail->cost_en}}">
                    </div>
                </div>
            @endif
            @if(Auth::guard('admin')->user()->hasAnyPermission(['packages.edit.ar']))
                <div class="col-md-6">
                    <div class="form-group">
                        <label>التكلفة بالعربي</label>
                        <input class="form-control" type="text"
                               name="hotel[pricing][{{$package_hotel_repeater}}][cost_ar][]"
                               value="{{$hotelPricingDetail->cost_ar}}">
                    </div>
                </div>
            @endif
        </div>
        <div class="row">
            @if(Auth::guard('admin')->user()->hasAnyPermission(['packages.edit.en']))
                <div class="col-md-6">
                    <div class="form-group">
                        <label>English Value</label>
                        <input class="form-control" type="text"
                               name="hotel[pricing][{{$package_hotel_repeater}}][value_en][]"
                               value="{{$hotelPricingDetail->value_en}}">
                    </div>
                </div>
            @endif
            @if(Auth::guard('admin')->user()->hasAnyPermission(['packages.edit.ar']))
                <div class="col-md-6">
                    <div class="form-group">
                        <label>لقيمة بالعربي</label>
                        <input class="form-control" type="text"
                               name="hotel[pricing][{{$package_hotel_repeater}}][value_ar][]"
                               value="{{$hotelPricingDetail->value_ar}}">
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
