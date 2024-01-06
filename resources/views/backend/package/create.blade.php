@extends('backend.layouts.app')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Package </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.packages.index')}}">Countries</a></li>
                        <li class="breadcrumb-item active">Add Package</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="card card-primary card-outline card-outline-tabs">
                        @if($errors->count() != 0)
                            <div class="form-group clearfix">
                                <div class="col-8 col-md-8">
                                    @foreach ($errors->all() as $error)
                                        <p>{{$error}}</p>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <form id="demo-form2" method="POST" action="{{ route('admin.packages.store') }}"
                      enctype="multipart/form-data" style="width: 100%">
                    @csrf
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header">
                            <h3 class="card-title">Basic Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <div class="form-group clearfix">
                                        <div class="icheck-primary d-inline">
                                            <input type="radio" id="radioPrimary1" checked name="publish" value="1"
                                                   onclick="hideDiv('publish')">
                                            <label for="radioPrimary1">
                                                Any Date
                                            </label>
                                        </div>
                                        <div class="icheck-primary d-inline">
                                            <input type="radio" id="radioPrimary2" name="publish" value="0"
                                                   onclick="showDiv('publish')">
                                            <label for="radioPrimary2">
                                                Fixed Date
                                            </label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class=" col-4 col-xs-4 ">
                                    <div class="form-group clearfix">

                                        <label for="disabledinput" class="control-label">
                                            Start Date
                                        </label>
                                        <input name="publish_date" type="text" id="publish_date" required
                                               class="form-control datetimepicker-input datepicker"/>
                                    </div>
                                </div>
                                <div class=" col-4 col-xs-4">
                                    <div class="form-group ">
                                        <label for="disabledinput" class="control-label">
                                            End Date
                                        </label>
                                        <input name="suppress_date" type="text" id="suppress_date" required
                                               class="form-control datetimepicker-input datepicker"/>
                                    </div>
                                </div>
                                <div class=" col-4 col-xs-4 float-left" id='div-of-publish'
                                     style="display: none">
                                    <label for="disabledinput" class="control-label">
                                        Date of package
                                    </label>
                                    <input name="date" type="text" id="date"
                                           class="form-control datetimepicker-input datepicker"/>
                                </div>

                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-6 col-md-6">
                                    <div class="form-group clearfix">
                                        <label>Country</label>
                                        @if($countries)
                                            <select class="form-control select2bs4" id="country" name="country"
                                                    required="true" onchange="select_city_of_country(this.value)"
                                                    style="width: 100%;">
                                                <option value="">Select Country</option>
                                                @foreach($countries as $country)
                                                    <option value="{{$country->id}}">{{$country->name_en}}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-6 col-md-6" id="city-of-country" style="float: left"></div>

                            </div>
                            <div class="row">
                                <div class="col-6 col-md-6">
                                    <div class="form-group clearfix">
                                        <label for="disabledinput" class="control-label">Maximum number</label>
                                        <input name="number" type="number" id="number" class="form-control"
                                               min="0"/>
                                    </div>
                                </div>
                                <div class="col-6 col-md-6">
                                    <div class="form-group clearfix">
                                        <label for="disabledinput" class="control-label">Package Order</label>
                                        <input name="package_order" type="number" id="package_order"
                                               class="form-control" min="0"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-6">
                                    <div class="form-group clearfix">
                                        <label for="disabledinput" class="control-label">Type</label>
                                        @if($types)
                                            <select name="types[]" class="select2bs4" multiple="multiple"
                                                    data-placeholder="Select types" style="width: 100%;">
                                                <option value="">Select Type</option>
                                                @foreach($types as $type)
                                                    <option value="{{$type->id}}">{{$type->name_en}}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-6 col-md-6">
                                    <div class="form-group clearfix">
                                        <label for="disabledinput" class="control-label">Offers</label>
                                        @if($offers)
                                            <select name="offers[]" class="select2bs4" multiple="multiple"
                                                    data-placeholder="Select offers" style="width: 100%;">
                                                <option value="">Select Offer</option>
                                                @foreach($offers as $offer)
                                                    <option value="{{$offer->id}}">{{$offer->name_en}}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <div class="form-group clearfix">
                                        <label for="disabledinput" class="control-label">Video Link</label>
                                        <input name="video" type="text" id="video" class="form-control"/>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-6 col-md-6">
                                    <div class="form-group clearfix">
                                        <label for="exampleInputFile">Map image</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="exampleInputFile"
                                                       name="map">
                                                <label class="custom-file-label" for="exampleInputFile">Choose
                                                    file</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <!-- checkbox -->
                                    <br><br>
                                    <div class="form-group clearfix">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" id="checkboxPrimary1" name="flight" value="1">
                                            <label for="checkboxPrimary1">
                                                Flight
                                            </label>
                                        </div>
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" id="checkboxPrimary2" name="hotels" value="1">
                                            <label for="checkboxPrimary2">
                                                Hotels
                                            </label>
                                        </div>
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" id="checkboxPrimary3" name="transfer" value="1">
                                            <label for="checkboxPrimary3">
                                                Transfer
                                            </label>
                                        </div>
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" id="checkboxPrimary4" name="activity" value="1">
                                            <label for="checkboxPrimary4">
                                                Activity
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header p-0 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                @if(Auth::guard('admin')->user()->hasRole('super-admin') || Auth::guard('admin')->user()->hasAllPermissions(['packages.create.en','packages.create.ar']))
                                    <?php
                                    $active_ar = '';
                                    $active_en = 'fade show active';
                                    ?>
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill"
                                           href="#custom-tabs-four-home" role="tab"
                                           aria-controls="custom-tabs-four-home" aria-selected="true">
                                            English
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill"
                                           href="#custom-tabs-four-profile" role="tab"
                                           aria-controls="custom-tabs-four-profile" aria-selected="false">
                                            عربي
                                        </a>
                                    </li>
                                @elseif(Auth::guard('admin')->user()->hasAnyPermission(['packages.create.en']))
                                    <?php
                                    $active_en = 'fade show active';
                                    $active_ar = '';
                                    ?>
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill"
                                           href="#custom-tabs-four-home" role="tab"
                                           aria-controls="custom-tabs-four-home" aria-selected="true">
                                            English
                                        </a>
                                    </li>
                                @elseif(Auth::guard('admin')->user()->hasAnyPermission(['packages.create.ar']))
                                    <?php
                                    $active_en = '';
                                    $active_ar = 'fade show active';
                                    ?>
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-four-profile-tab" data-toggle="pill"
                                           href="#custom-tabs-four-profile" role="tab"
                                           aria-controls="custom-tabs-four-profile" aria-selected="false">
                                            عربي
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        <div class="card-body">

                            <div class="tab-content" id="custom-tabs-four-tabContent">
                                @if(Auth::guard('admin')->user()->hasAnyPermission(['packages.create.en']))
                                    <div class="tab-pane {{$active_en}}" id="custom-tabs-four-home" role="tabpanel"
                                         aria-labelledby="custom-tabs-four-home-tab">
                                        <div class="row">
                                            <div class="col-6 col-md-6">
                                                <div class="form-group clearfix">
                                                    <label>Package Title <span class="required">*</span></label>
                                                    <input type="text" name="name_en" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-6 col-md-6">
                                                <div class="form-group clearfix">
                                                    <label for="exampleInputFile">Image <span
                                                            class="required">*</span></label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                   id="exampleInputFile" name="image_en">
                                                            <label class="custom-file-label" for="exampleInputFile">Choose
                                                                file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-6">
                                                <div class="form-group clearfix">
                                                    <label for="exampleInputFile">Header Image</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                   id="exampleInputFile" name="package_image_header_en">
                                                            <label class="custom-file-label" for="exampleInputFile">Choose
                                                                file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-6 col-md-6">
                                                <div class="form-group clearfix">
                                                    <label for="exampleInputFile">Pdf</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                   id="exampleInputFile" name="pdf_en">
                                                            <label class="custom-file-label" for="exampleInputFile">Choose
                                                                file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-12 col-md-12">
                                                <div class="form-group clearfix">
                                                    <label>Overview</label>
                                                    <textarea class="textarea" name="overview_en"
                                                              style="max-width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-12 col-md-12">
                                                <div class="form-group clearfix">
                                                    <label style="width: 100%;">Terms Condition
                                                        <span class="float-right">
                                                        <input type="checkbox" value="1" name="open_term"> Show open
                                                    </span>
                                                    </label>
                                                    <textarea class="textarea" name="terms_condition_en"
                                                              style="max-width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-12 col-md-12">
                                                <div class="form-group clearfix">
                                                    <label style="width: 100%;">Cancellation Policy
                                                        <span class="float-right">
                                                        <input type="checkbox" value="1" name="open_cancellation"> Show open
                                                    </span>
                                                    </label>
                                                    <textarea class="textarea" name="cancellation_policy_en"
                                                              style="max-width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-12 col-md-12">
                                                <div class="form-group clearfix">
                                                    <label style="width: 100%;">Additional Info
                                                        <span class="float-right">
                                                        <input type="checkbox" value="1" name="open_additional_info"> Show open
                                                    </span>
                                                    </label>
                                                    <textarea class="textarea" name="additional_info_en"
                                                              style="max-width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if(Auth::guard('admin')->user()->hasAnyPermission(['packages.create.ar']))
                                    <div class="tab-pane {{$active_ar}}" id="custom-tabs-four-profile" role="tabpanel"
                                         aria-labelledby="custom-tabs-four-home-tab" style="text-align: right;">
                                        <div class="row">
                                            <div class="col-6 col-md-6"></div>
                                            <div class="col-6 col-md-6">
                                                <div class="form-group clearfix">
                                                    <label>االعنوان<span class="required">*</span></label>
                                                    <input type="text" name="name_ar" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-6 col-md-6">
                                                <div class="form-group clearfix">
                                                    <label>الوجهة</label>
                                                    <input type="text" name="destination_ar" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-6">
                                                <div class="form-group clearfix">
                                                    <label>التصنيف</label>
                                                    <input type="text" name="category_ar" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-6 col-md-6">
                                                <div class="form-group clearfix">
                                                    <label for="exampleInputFile">الصورة <span
                                                            class="required">*</span></label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                   id="exampleInputFile" name="image_ar">
                                                            <label class="custom-file-label" for="exampleInputFile">Choose
                                                                file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-6">
                                                <div class="form-group clearfix">
                                                    <label for="exampleInputFile">صورة الهيدر</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                   id="exampleInputFile" name="package_image_header_ar">
                                                            <label class="custom-file-label" for="exampleInputFile">Choose
                                                                file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-6 col-md-6"></div>

                                            <div class="col-6 col-md-6">
                                                <div class="form-group clearfix">
                                                    <label for="exampleInputFile">Pdf</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                   id="exampleInputFile" name="pdf_ar">
                                                            <label class="custom-file-label" for="exampleInputFile">Choose
                                                                file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-12 col-md-12">
                                                <div class="form-group clearfix">
                                                    <label>لمحة عامة</label>
                                                    <textarea class="textarea" name="overview_ar"
                                                              style="max-width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-12 col-md-12">
                                                <div class="form-group clearfix">
                                                    <label style="width: 100%;">الشروط والأحكام
                                                    </label>
                                                    <textarea class="textarea" name="terms_condition_ar"
                                                              style="max-width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-12 col-md-12">
                                                <div class="form-group clearfix">
                                                    <label style="width: 100%;">سياسة الإلغاء
                                                    </label>
                                                    <textarea class="textarea" name="cancellation_policy_ar"
                                                              style="max-width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-12 col-md-12">
                                                <div class="form-group clearfix">
                                                    <label style="width: 100%;">المعلومات الإضافية </label>
                                                    <textarea class="textarea" name="additional_info_ar"
                                                              style="max-width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header">
                            <h3 class="card-title" style="width: 100%">
                                Hotels
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" id='hotel-of-country'>
                                        Please select country
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" id="div-container-hotel">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header">
                            <h3 class="card-title" style="width: 100%">
                                <input type="button" class="btn btn-primary btn-sm " value="+" style="width: 50px"
                                       onclick="add_transfer()">
                                Transfer
                            </h3>
                        </div>
                        <div class="card-body" id='div-container-transfer'>
                        </div>
                    </div>
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header">
                            <h3 class="card-title" style="width: 100%">
                                <input type="button" class="btn btn-primary btn-sm " value="+" style="width: 50px"
                                       onclick="add_flight()">
                                Flight
                            </h3>
                        </div>
                        <div class="card-body" id='div-container-flight'>
                        </div>
                    </div>
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header">
                            <h3 class="card-title" style="width: 100%">
                                <input type="button" class="btn btn-primary btn-sm " value="+" style="width: 50px"
                                       onclick="add_inclusion()">
                                Inclusions
                                <span class="float-right">
                                     <input type="checkbox" value="1" name="open_include"> Show open
                                </span>
                            </h3>
                        </div>
                        <div class="card-body" id='div-container-inclusion'>
                        </div>
                    </div>
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header">
                            <h3 class="card-title" style="width: 100%">
                                <input type="button" class="btn btn-primary btn-sm " value="+" style="width: 50px"
                                       onclick="add_exclusion()">
                                Exclusions
                                <span class="float-right">
                                     <input type="checkbox" value="1" name="open_not_include"> Show open
                                </span>
                            </h3>
                        </div>
                        <div class="card-body" id="div-container-exclusion">
                        </div>
                    </div>
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header">
                            <h3 class="card-title" style="width: 100%">
                                <input type="button" class="btn btn-primary btn-sm " value="+" style="width: 50px"
                                       onclick="add_label()">
                                Labels
                            </h3>
                        </div>
                        <div class="card-body" id="div-container-label">
                        </div>
                    </div>
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header">
                            <h3 class="card-title" style="width: 100%">
                                <input type="button" class="btn btn-primary btn-sm " value="+" style="width: 50px"
                                       onclick="add_day()">
                                Days
                            </h3>
                        </div>
                        <div class="card-body" id="div-container-day">
                        </div>
                    </div>
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="form-group clearfix" style="padding: 15px;">
                            <input type="submit" name="action" value="Save" class="btn btn-success"/>
                            <input type="submit" name="action" value="Draft" class="btn btn-info"/>
                        </div>
                    </div>


                </form>

            </div>

        </div>
    </section>


@endsection
