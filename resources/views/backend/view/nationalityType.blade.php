<div class="card card-default div-type">
    <div class="card-header">
        <h5 class="card-title">
            {{$type->type->name_en}}
            <input type="hidden" name="type[type_id][{{$type_repeater}}]" value="{{$type->type->id}}">
        </h5>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget-custom="remove"><i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <div class="form-group clearfix">
                        <div class="icheck-primary d-inline">
                            @if($type->is_default)
                                <input checked type="checkbox" id="checkboxPrimary1{{$type_repeater}}"
                                       name="type[is_default][{{$type_repeater}}]" value="1">
                            @else
                                <input type="checkbox" id="checkboxPrimary1{{$type_repeater}}"
                                       name="type[is_default][{{$type_repeater}}]" value="0">
                            @endif
                            <label for="checkboxPrimary1{{$type_repeater}}">
                                Is Default link type
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="form-group clearfix">
                        <div class="icheck-primary d-inline">
                            @if($type->checkout)
                                <input checked type="checkbox" id="checkboxPrimary2{{$type_repeater}}"
                                       name="type[checkout][{{$type_repeater}}]" value="1">
                            @else
                                <input type="checkbox" id="checkboxPrimary2{{$type_repeater}}"
                                       name="type[checkout][{{$type_repeater}}]" value="0">
                            @endif
                            <label for="checkboxPrimary2{{$type_repeater}}">
                                Is checkoutable
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Price Per Adult</label>
                    <input class="form-control" type="number" min="1" name="type[adult_price][{{$type_repeater}}]"
                           value="{{$type->adult_price}}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Price Per Child</label>
                    <input class="form-control" type="number" min="1" name="type[child_price][{{$type_repeater}}]"
                           value="{{$type->child_price}}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Price Per Infant</label>
                    <input class="form-control" type="number" min="1" name="type[infant_price][{{$type_repeater}}]"
                           value="{{$type->infant_price}}">
                </div>
            </div>
        </div>
        <hr>
        <div class="card-body">
            <div class="row">
                @if(Auth::guard('admin')->user()->hasPermissionTo('visa.uae.nationalities.edit.en'))
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>English Processing Time</label>
                            <textarea class="form-control textarea"
                                      name="type[processing_time_en][{{$type_repeater}}]">{{$type->processing_time_en}}</textarea>
                        </div>
                    </div>
                @endif
                @if(Auth::guard('admin')->user()->hasPermissionTo('visa.uae.nationalities.edit.ar'))
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Arabic Processing Time</label>
                            <textarea class="form-control textarea"
                                      name="type[processing_time_ar][{{$type_repeater}}]">{{$type->processing_time_ar}}</textarea>

                        </div>
                    </div>
                @endif
            </div>
        </div>
        <hr>
        <div class="card-body">
            <div class="row">
                @if(Auth::guard('admin')->user()->hasPermissionTo('visa.uae.nationalities.edit.en'))
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>English Visa Validity</label>
                            <textarea class="form-control textarea"
                                      name="type[visa_validity_en][{{$type_repeater}}]">{{$type->visa_validity_en}}</textarea>
                        </div>
                    </div>
                @endif
                @if(Auth::guard('admin')->user()->hasPermissionTo('visa.uae.nationalities.edit.ar'))
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Arabic Visa Validity</label>
                            <textarea class="form-control textarea"
                                      name="type[visa_validity_ar][{{$type_repeater}}]">{{$type->visa_validity_ar}}</textarea>

                        </div>
                    </div>
                @endif
            </div>
        </div>
        <hr>
        <div class="card-body">
            <div class="row">
                @if(Auth::guard('admin')->user()->hasPermissionTo('visa.uae.nationalities.edit.en'))
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>English Stay Validity</label>
                            <textarea class="form-control textarea"
                                      name="type[stay_validity_en][{{$type_repeater}}]">{{$type->stay_validity_en}}</textarea>
                        </div>
                    </div>
                @endif
                @if(Auth::guard('admin')->user()->hasPermissionTo('visa.uae.nationalities.edit.ar'))
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Arabic Stay Validity</label>
                            <textarea class="form-control textarea"
                                      name="type[stay_validity_ar][{{$type_repeater}}]">{{$type->stay_validity_ar}}</textarea>

                        </div>
                    </div>
                @endif
            </div>
        </div>
        <hr>
        <div class="card-body">
            <div class="row">
                @if(Auth::guard('admin')->user()->hasPermissionTo('visa.uae.nationalities.edit.en'))
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>English Term and Condition</label>
                            <textarea class="form-control textarea"
                                      name="type[term_and_condition_en][{{$type_repeater}}]">{{$type->term_and_condition_en}}</textarea>
                        </div>
                    </div>
                @endif
                @if(Auth::guard('admin')->user()->hasPermissionTo('visa.uae.nationalities.edit.ar'))
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Arabic Term and Condition</label>
                            <textarea class="form-control textarea"
                                      name="type[term_and_condition_ar][{{$type_repeater}}]">{{$type->term_and_condition_ar}}</textarea>

                        </div>
                    </div>
                @endif
            </div>
        </div>
        <hr>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-sm-1">
                                        <label>Requirement</label>
                                    </div>
                                    <div class="col-sm-12">

                                        <select name="type[requirements][{{$type_repeater}}][]" class="select2bs4"
                                                multiple="multiple"
                                                data-placeholder="Select Requirement" style="width: 100%;">
                                            <option value="">Select Requirement</option>
                                            @foreach($requirements as $requirement)
                                                @if(in_array($requirement->id,$type->requirements_ids()))
                                                    <option
                                                        value="{{$requirement->id}}"
                                                        selected>{{$requirement->name_en}}</option>
                                                @else
                                                    <option
                                                        value="{{$requirement->id}}">{{$requirement->name_en}}</option>
                                                @endif
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
