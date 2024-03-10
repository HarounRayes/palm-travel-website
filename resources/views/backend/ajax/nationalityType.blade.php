<div class="card card-default div-type">
    <div class="card-header">
        <h5 class="card-title">
            {{$type->name_en}}
            <input type="hidden" name="type[type_id][{{$count_type}}]" value="{{$type->id}}">
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
                            <input type="checkbox" id="checkboxPrimary1{{$count_type}}"
                                   name="type[is_default][{{$count_type}}]" value="1">
                            <label for="checkboxPrimary1{{$count_type}}">
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
                            <input type="checkbox" id="checkboxPrimary2{{$count_type}}"
                                   name="type[checkout][{{$count_type}}]" value="0">
                            <label for="checkboxPrimary2{{$count_type}}">
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
                    <input class="form-control" type="number" min="1" name="type[adult_price][{{$count_type}}]">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Price Per Child</label>
                    <input class="form-control" type="number" min="1" name="type[child_price][{{$count_type}}]">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Price Per Infant</label>
                    <input class="form-control" type="number" min="1" name="type[infant_price][{{$count_type}}]">
                </div>
            </div>
        </div>
        <hr>
        <div class="card-body">
            <div class="row">
                @if(Auth::guard('admin')->user()->hasPermissionTo('visa.uae.nationalities.create.en'))
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>English Processing Time</label>
                            <textarea class="form-control textarea2"
                                      name="type[processing_time_en][{{$count_type}}]"></textarea>
                        </div>
                    </div>
                @endif
                @if(Auth::guard('admin')->user()->hasPermissionTo('visa.uae.nationalities.create.ar'))
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Arabic Processing Time</label>
                            <textarea class="form-control textarea2"
                                      name="type[processing_time_ar][{{$count_type}}]"></textarea>

                        </div>
                    </div>
                @endif
            </div>
        </div>
        <hr>
        <div class="card-body">
            <div class="row">
                @if(Auth::guard('admin')->user()->hasPermissionTo('visa.uae.nationalities.create.en'))
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>English Visa Validity</label>
                            <textarea class="form-control textarea2"
                                      name="type[visa_validity_en][{{$count_type}}]"></textarea>
                        </div>
                    </div>
                @endif
                @if(Auth::guard('admin')->user()->hasPermissionTo('visa.uae.nationalities.create.ar'))
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Arabic Visa Validity</label>
                            <textarea class="form-control textarea2"
                                      name="type[visa_validity_ar][{{$count_type}}]"></textarea>

                        </div>
                    </div>
                @endif
            </div>
        </div>
        <hr>
        <div class="card-body">
            <div class="row">
                @if(Auth::guard('admin')->user()->hasPermissionTo('visa.uae.nationalities.create.en'))
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>English Stay Validity</label>
                            <textarea class="form-control textarea2"
                                      name="type[stay_validity_en][{{$count_type}}]"></textarea>
                        </div>
                    </div>
                @endif
                @if(Auth::guard('admin')->user()->hasPermissionTo('visa.uae.nationalities.create.ar'))
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Arabic Stay Validity</label>
                            <textarea class="form-control textarea2"
                                      name="type[stay_validity_ar][{{$count_type}}]"></textarea>

                        </div>
                    </div>
                @endif
            </div>
        </div>
        <hr>
        <div class="card-body">
            <div class="row">
                @if(Auth::guard('admin')->user()->hasPermissionTo('visa.uae.nationalities.create.en'))
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>English Term and Condition</label>
                            <textarea class="form-control textarea2"
                                      name="type[term_and_condition_en][{{$count_type}}]"></textarea>
                        </div>
                    </div>
                @endif
                @if(Auth::guard('admin')->user()->hasPermissionTo('visa.uae.nationalities.create.ar'))
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Arabic Term and Condition</label>
                            <textarea class="form-control textarea2"
                                      name="type[term_and_condition_ar][{{$count_type}}]"></textarea>

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
                                        @if($requirements)
                                            <select name="type[requirements][{{$count_type}}][]" class="select-type"
                                                    multiple="multiple"
                                                    data-placeholder="Select Requirement" style="width: 100%;">
                                                <option value="">Select Requirement</option>
                                                @foreach($requirements as $requirement)
                                                    <option
                                                        value="{{$requirement->id}}">{{$requirement->name_en}}</option>
                                                @endforeach
                                            </select>
                                        @endif
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
