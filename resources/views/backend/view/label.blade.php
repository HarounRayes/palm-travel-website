<div class="card card-default div-label">
    <input type="hidden" name="labels[labels][]" value="1">
    <div class="card-header">
        <h5 class="card-title">
            Label ({{$label_repeater}})
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
                        <label>English Value</label>
                        <input class="form-control" type="text" name="labels[value_en][]" value="{{$label->value_en}}">
                    </div>
                </div>
            @endif
            @if(Auth::guard('admin')->user()->hasAnyPermission(['packages.edit.ar']))
                <div class="col-md-6">
                    <div class="form-group">
                        <label>القيمة بالعربي</label>
                        <input class="form-control" type="text" name="labels[value_ar][]" value="{{$label->value_ar}}">
                    </div>
                </div>
            @endif
        </div>
        <div class="row">
            @if(Auth::guard('admin')->user()->hasAnyPermission(['packages.edit.en']))
                <div class="col-md-6">
                    <div class="form-group">
                        <label>English Color</label>
                        <input class="form-control my-colorpicker1" type="text" name="labels[color_en][]"
                               value="{{$label->color_en}}">
                    </div>
                </div>
            @endif
            @if(Auth::guard('admin')->user()->hasAnyPermission(['packages.edit.ar']))
                <div class="col-md-6">
                    <div class="form-group">
                        <label>اللون بالعربي</label>
                        <input class="form-control my-colorpicker1" type="text" name="labels[color_ar][]"
                               value="{{$label->color_ar}}">
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
