<div class="card card-default div-day">
    <input type="hidden" name="days[days][]" value="1">
    <div class="card-header">
        <h5 class="card-title" style="width: 100%">
            Day ({{($count_day+1)}})
            <span class="float-right">
                <input type="checkbox" value="1" name="days[open_day][]"> Show open
            </span>
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
                        <label>English Day Title</label>
                        <input class="form-control" type="text" name="days[title_en][]">
                    </div>
                </div>
            @endif
            @if(Auth::guard('admin')->user()->hasPermissionTo('packages.create.ar'))
                <div class="col-md-6">
                    <div class="form-group">
                        <label>العنوان بالعربي</label>
                        <input class="form-control" type="text" name="days[title_ar][]">

                    </div>
                </div>
            @endif
        </div>
        <div class="row">
            @if(Auth::guard('admin')->user()->hasPermissionTo('packages.create.en'))
                <div class="col-md-6">
                    <div class="form-group">
                        <label>English Day Description</label>
                        <textarea class="form-control textarea3" name="days[description_en][]"></textarea>
                    </div>
                </div>
            @endif
            @if(Auth::guard('admin')->user()->hasPermissionTo('packages.create.ar'))
                <div class="col-md-6">
                    <div class="form-group">
                        <label>الوصف بالعربي</label>
                        <textarea class="form-control textarea3" name="days[description_ar][]"></textarea>
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
                                       onclick="add_day_tour({{$count_day}})">Tour</h3>
                        </div>
                        <div class="card-body" id='div-container-day-tour-{{$count_day}}'>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

