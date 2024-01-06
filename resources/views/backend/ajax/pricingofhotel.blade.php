<div class="card card-default div-pricing-details-{{$count_hotel}}">
    <input type="hidden" name="hotel[pricing][{{$count_hotel}}][pricing][]" value="1">
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
            @if(Auth::guard('admin')->user()->hasPermissionTo('packages.create.en'))
                <div class="col-md-6">
                    <div class="form-group">
                        <label>English Cost</label>
                        <input class="form-control" type="text" name="hotel[pricing][{{$count_hotel}}][cost_en][]">
                    </div>
                </div>
            @endif
            @if(Auth::guard('admin')->user()->hasPermissionTo('packages.create.ar'))
                <div class="col-md-6">
                    <div class="form-group">
                        <label>التكلفة بالعربي</label>
                        <input class="form-control" type="text" name="hotel[pricing][{{$count_hotel}}][cost_ar][]">
                    </div>
                </div>
            @endif
        </div>
        <div class="row">
            @if(Auth::guard('admin')->user()->hasPermissionTo('packages.create.en'))
                <div class="col-md-6">
                    <div class="form-group">
                        <label>English Value</label>
                        <input class="form-control " type="text"
                               name="hotel[pricing][{{$count_hotel}}][value_en][]">
                    </div>
                </div>
            @endif
            @if(Auth::guard('admin')->user()->hasPermissionTo('packages.create.ar'))
                <div class="col-md-6">
                    <div class="form-group">
                        <label>لقيمة بالعربي</label>
                        <input class="form-control" type="text"
                               name="hotel[pricing][{{$count_hotel}}][value_ar][]">
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
