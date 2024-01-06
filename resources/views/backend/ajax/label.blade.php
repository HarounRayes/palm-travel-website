<div class="card card-default div-label">
    <input type="hidden" name="labels[labels][]" value="1">
    <div class="card-header">
        <h5 class="card-title">
            Label ({{($count_label+1)}})
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
                        <label>English Value</label>
                        <input class="form-control" type="text" name="labels[value_en][]">
                    </div>
                </div>
            @endif
            @if(Auth::guard('admin')->user()->hasPermissionTo('packages.create.ar'))
                <div class="col-md-6">
                    <div class="form-group">
                        <label>القيمة بالعربي</label>
                        <input class="form-control" type="text" name="labels[value_ar][]">
                    </div>
                </div>
            @endif

        </div>
        <div class="row">
            @if(Auth::guard('admin')->user()->hasPermissionTo('packages.create.en'))
                <div class="col-md-6">
                    <div class="form-group">
                        <label>English Color</label>
                        <input class="form-control my-colorpicker1" type="text" name="labels[color_en][]">
                    </div>
                </div>
            @endif
            @if(Auth::guard('admin')->user()->hasPermissionTo('packages.create.ar'))
                <div class="col-md-6">
                    <div class="form-group">
                        <label>اللون بالعربي</label>
                        <input class="form-control my-colorpicker1" type="text" name="labels[color_ar][]">
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
