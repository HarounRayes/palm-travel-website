<div class="card card-default div-exclusion">
    <input type="hidden" name="exclusions[exclusions][]" value="1">
    <div class="card-header">
        <h5 class="card-title">
            Exclusion ({{($count_exclusion+1)}})
        </h5>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget-custom="remove"><i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            @if(Auth::guard('admin')->user()->hasAnyPermission(['packages.create.en','activities.tours.create.en']))
                <div class="col-md-12">
                    <div class="form-group">
                        <label>English</label>
                        <input class="form-control" type="text" name="exclusions[value_en][]">
                    </div>
                </div>
            @endif
            @if(Auth::guard('admin')->user()->hasAnyPermission(['packages.create.ar','activities.tours.create.ar']))
                <div class="col-md-12">
                    <div class="form-group">
                        <label>عربي</label>
                        <input class="form-control" type="text" name="exclusions[value_ar][]">
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
