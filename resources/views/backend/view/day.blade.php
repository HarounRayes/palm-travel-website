<div class="card card-default div-day">
    <input type="hidden" name="days[days][{{($day_repeater-1)}}]" value="1">
    <div class="card-header">
        <h5 class="card-title" style="width: 100%">
            Day ({{$day_repeater}})
            <span class="float-right">
                <?php
                if (isset($day->open_day) && $day->open_day == '1') {
                    $open_day_checked = 'checked';
                } else {
                    $open_day_checked = '';
                }
                ?>
                <input {{$open_day_checked}} type="checkbox" value="1" name="days[open_day][{{($day_repeater-1)}}]"> Show open
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
            @if(Auth::guard('admin')->user()->hasAnyPermission(['packages.edit.en']))
                <div class="col-md-6">
                    <div class="form-group">
                        <label>English Day Title</label>
                        <input class="form-control" type="text" name="days[title_en][{{($day_repeater-1)}}]" value="{{$day->day_title_en}}">
                    </div>
                </div>
            @endif
            @if(Auth::guard('admin')->user()->hasAnyPermission(['packages.edit.ar']))
                <div class="col-md-6">
                    <div class="form-group">
                        <label>العنوان بالعربي</label>
                        <input class="form-control" type="text" name="days[title_ar][{{($day_repeater-1)}}]" value="{{$day->day_title_ar}}">

                    </div>
                </div>
            @endif
        </div>
        <div class="row">
            @if(Auth::guard('admin')->user()->hasAnyPermission(['packages.edit.en']))
                <div class="col-md-6">
                    <div class="form-group">
                        <label>English Day Description</label>
                        <textarea class="form-control textarea3 textarea"
                                  name="days[description_en][{{($day_repeater-1)}}]">{{$day->day_description_en}}</textarea>
                    </div>
                </div>
            @endif
            @if(Auth::guard('admin')->user()->hasAnyPermission(['packages.edit.ar']))
                <div class="col-md-6">
                    <div class="form-group">
                        <label>الوصف بالعربي</label>
                        <textarea class="form-control textarea3 textarea"
                                  name="days[description_ar][{{($day_repeater-1)}}]">{{$day->day_description_ar}}</textarea>
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
                                       onclick="add_day_tour({{($day_repeater-1)}})">Tour</h3>

                        </div>
                        <div class="card-body" id='div-container-day-tour-{{($day_repeater-1)}}'>
                            @if($day->dayToursByPackage())
                                <?php $day_tour_repeater = 1;?>
                                @foreach($day->dayToursByPackage() as $daytour)
                                    @include('backend.view.daytour')
                                    <?php $day_tour_repeater++;?>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

