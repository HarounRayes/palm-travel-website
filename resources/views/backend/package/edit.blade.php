@extends('backend.layouts.app')

@section('content')
    <?php
    if ($package->publish == '1') {
        $publishtrue = 'checked';
        $publishfalse = '';
        $style = 'display: none';
    } else {
        $publishfalse = 'checked';
        $publishtrue = '';
        $style = 'display: block';
    }

    ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Package </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a
                                href="{{route('admin.packages.index',['country' => $package->country])}}">Packages</a>
                        </li>
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
                <form id="demo-form2" method="POST" action="{{ route('admin.packages.update',$package->id) }}"
                      enctype="multipart/form-data" style="width: 100%">
                    @csrf
                    @method('patch')
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header">
                            <h3 class="card-title">Basic Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <div class="form-group clearfix">
                                        <div class="icheck-primary d-inline">
                                            <input {{$publishtrue}} type="radio" id="radioPrimary1" checked
                                                   name="publish" value="1"
                                                   onclick="hideDiv('publish')">
                                            <label for="radioPrimary1">
                                                Any Date
                                            </label>
                                        </div>
                                        <div class="icheck-primary d-inline">
                                            <input {{$publishfalse}} type="radio" id="radioPrimary2" name="publish"
                                                   value="0"
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
                                               class="form-control datetimepicker-input datepicker"
                                               value="{{date("d-m-Y", strtotime($package->publish_date))}}"/>
                                    </div>
                                </div>
                                <div class=" col-4 col-xs-4">
                                    <div class="form-group ">
                                        <label for="disabledinput" class="control-label">
                                            End Date
                                        </label>
                                        <input name="suppress_date" type="text" id="suppress_date" required
                                               class="form-control datetimepicker-input datepicker"
                                               value="{{date("d-m-Y", strtotime($package->suppress_date))}}"/>
                                    </div>
                                </div>

                                <div class=" col-4 col-xs-4 float-left" id='div-of-publish' style="{{$style}}">
                                    <label for="disabledinput" class="control-label">
                                        Date of package
                                    </label>
                                    <input name="date" type="text" id="date"
                                           value="{{date("d-m-Y", strtotime($package->date))}}"
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
                                                    required="true"
                                                    onchange="select_city_of_country(this.value)" style="width: 100%;">
                                                <option value="">Select Country</option>
                                                @foreach($countries as $country)
                                                    @if($package->country == $country->id)
                                                        <?php $selected_country = 'selected="true"' ?>
                                                    @else
                                                        <?php $selected_country = '' ?>
                                                    @endif
                                                    <option
                                                        {{$selected_country}} value="{{$country->id}}">{{$country->name_en}}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-6 col-md-6" id="city-of-country" style="float: left">
                                    <label>City</label>
                                    @if($cities)
                                        <select class="form-control select2bs4" id="city" name="city" required="true"
                                                style="width: 100%;">
                                            <option value="">Select City</option>
                                            @foreach($cities as $city)
                                                @if($package->city == $city->id)
                                                    <?php $selected_city = 'selected="true"' ?>
                                                @else
                                                    <?php $selected_city = '' ?>
                                                @endif
                                                <option
                                                    {{$selected_city}} value="{{$city->id}}">{{$city->name_en}}</option>
                                            @endforeach
                                        </select>
                                    @endif

                                </div>

                            </div>
                            <div class="row">
                                <div class="col-6 col-md-6">
                                    <div class="form-group clearfix">
                                        <label for="disabledinput" class="control-label">Maximum number</label>
                                        <input name="number" type="number" id="number" class="form-control"
                                               value="{{$package->number}}" min="0"/>
                                    </div>
                                </div>
                                <div class="col-6 col-md-6">
                                    <div class="form-group clearfix">
                                        <label for="disabledinput" class="control-label">Package Order</label>
                                        <input name="package_order" type="number" id="package_order"
                                               value="{{$package->package_order}}" class="form-control" min="0"/>
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
                                                    @if(in_array($type->id,$package->typesId())))
                                                    <option value="{{$type->id}}" selected="true">
                                                        {{$type->name_en}}
                                                    </option>
                                                    @else
                                                        <option value="{{$type->id}}">{{$type->name_en}}</option>
                                                    @endif
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
                                                    @if(in_array($offer->id,$package->offersId())))
                                                    <option value="{{$offer->id}}" selected="true">
                                                        {{$offer->name_en}}
                                                    </option>
                                                    @else
                                                        <option value="{{$offer->id}}">{{$offer->name_en}}</option>
                                                    @endif
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
                                        <input name="video" type="text" id="video" class="form-control"
                                               value="{{$package->video}}"/>
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
                                    @if(isset($package->map))
                                        <img style="width: 150px;"
                                             src="{{ url('storage/app/public/images/package/'.$package->map) }}"/>
                                    @endif
                                </div>
                                <?php
                                if (isset($package->hotels) && $package->hotels == '1'){
                                    $hotelsCheckbox = 'checked';
                                }else{
                                    $hotelsCheckbox = '';
                                }
                                if (isset($package->flight) && $package->flight == '1'){
                                    $flightCheckbox = 'checked';
                                }else{
                                    $flightCheckbox = '';
                                }
                                if (isset($package->transfer) && $package->transfer == '1'){
                                    $transferCheckbox = 'checked';
                                }else{
                                    $transferCheckbox = '';
                                }
                                if (isset($package->activity) && $package->activity == '1'){
                                    $activityCheckbox = 'checked';
                                }else{
                                    $activityCheckbox = '';
                                }
                                ?>
                                <div class="col-sm-6">
                                    <!-- checkbox -->
                                    <br><br>
                                    <div class="form-group clearfix">
                                        <div class="icheck-primary d-inline">
                                            <input {{$flightCheckbox}} type="checkbox" id="checkboxPrimary1" name="flight" value="1">
                                            <label for="checkboxPrimary1">
                                                Flight
                                            </label>
                                        </div>
                                        <div class="icheck-primary d-inline">
                                            <input {{$hotelsCheckbox}} type="checkbox" id="checkboxPrimary2" name="hotels" value="1">
                                            <label for="checkboxPrimary2">
                                                Hotels
                                            </label>
                                        </div>
                                        <div class="icheck-primary d-inline">
                                            <input {{$transferCheckbox}} type="checkbox" id="checkboxPrimary3" name="transfer" value="1">
                                            <label for="checkboxPrimary3">
                                                Transfer
                                            </label>
                                        </div>
                                        <div class="icheck-primary d-inline">
                                            <input {{$activityCheckbox}} type="checkbox" id="checkboxPrimary4" name="activity" value="1">
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
                                @if(Auth::guard('admin')->user()->hasRole('super-admin') || Auth::guard('admin')->user()->hasAllPermissions(['packages.edit.en','packages.edit.ar']))
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
                                @elseif(Auth::guard('admin')->user()->hasAnyPermission(['packages.edit.en']))
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
                                @elseif(Auth::guard('admin')->user()->hasAnyPermission(['packages.edit.ar']))
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
                                @if(Auth::guard('admin')->user()->hasAnyPermission(['packages.edit.en']))
                                <div class="tab-pane {{$active_en}}" id="custom-tabs-four-home" role="tabpanel"
                                     aria-labelledby="custom-tabs-four-home-tab">
                                    <div class="row">
                                        <div class="col-6 col-md-6">
                                            <div class="form-group clearfix">
                                                <label>Package Title <span class="required">*</span></label>
                                                <input type="text" name="name_en" class="form-control"
                                                       value="{{$package->name_en}}">
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
                                                @if(isset($package->image_en))
                                                    <img style="width: 150px;"
                                                         src="{{ url('storage/app/public/images/package/'.$package->image_en) }}"/>
                                                @endif
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
                                                @if(isset($package->package_image_header_en))
                                                    <img style="width: 150px;"
                                                         src="{{ url('storage/app/public/images/package/'.$package->package_image_header_en) }}"/>
                                                @endif
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
                                                @if(isset($package->pdf_en))
                                                    <p>{{$package->pdf_en}}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-6">
                                            <a href="{{ url('storage/app/public/pdf/'.$package->pdf_en) }}" target="_blank">
                                                {{$package->pdf_en}}
                                            </a>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12 col-md-12">
                                            <div class="form-group clearfix">
                                                <label>Overview</label>
                                                <textarea class="textarea" name="overview_en"
                                                          style="max-width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$package->overview_en}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <?php
                                        if (isset($package->open_term) && $package->open_term == '1') {
                                            $open_term_checked = ' checked';
                                        } else {
                                            $open_term_checked = '';
                                        }
                                        ?>
                                        <div class="col-12 col-md-12">
                                            <div class="form-group clearfix">
                                                <label style="width: 100%;">Terms Condition
                                                    <span class="float-right">
                                                        <input {{$open_term_checked}} type="checkbox" value="1"
                                                               name="open_term"> Show open
                                                    </span>
                                                </label>
                                                <textarea class="textarea" name="terms_condition_en"
                                                          style="max-width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$package->terms_condition_en}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <?php
                                        if (isset($package->open_cancellation) && $package->open_cancellation == '1') {
                                            $open_cancellation_checked = 'checked';
                                        } else {
                                            $open_cancellation_checked = '';
                                        }
                                        ?>
                                        <div class="col-12 col-md-12">
                                            <div class="form-group clearfix">
                                                <label style="width: 100%;">Cancellation Policy
                                                    <span class="float-right">
                                                        <input {{$open_cancellation_checked}} type="checkbox" value="1"
                                                               name="open_cancellation"> Show open
                                                    </span>
                                                </label>
                                                <textarea class="textarea" name="cancellation_policy_en"
                                                          style="max-width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$package->cancellation_policy_en}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <?php
                                        if (isset($package->open_aditional_info) && $package->open_aditional_info == '1') {
                                            $open_aditional_info_checked = ' checked';
                                        } else {
                                            $open_aditional_info_checked = '';
                                        }
                                        ?>
                                        <div class="col-12 col-md-12">
                                            <div class="form-group clearfix">
                                                <label style="width: 100%;">Additional Info
                                                    <span class="float-right">
                                                        <input {{$open_aditional_info_checked}} type="checkbox"
                                                               value="1" name="open_additional_info"> Show open
                                                    </span>
                                                </label>
                                                <textarea class="textarea" name="additional_info_en"
                                                          style="max-width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$package->additional_info_en}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                    @if(Auth::guard('admin')->user()->hasAnyPermission(['packages.edit.ar']))
                                <div class="tab-pane {{$active_ar}}" id="custom-tabs-four-profile" role="tabpanel"
                                     aria-labelledby="custom-tabs-four-home-tab" style="text-align: right;">
                                    <div class="row">
                                        <div class="col-6 col-md-6"></div>
                                        <div class="col-6 col-md-6">
                                            <div class="form-group clearfix">
                                                <label>االعنوان<span class="required">*</span></label>
                                                <input type="text" name="name_ar" class="form-control"
                                                       value="{{$package->name_ar}}">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-6 col-md-6">
                                            <div class="form-group clearfix">
                                                <label>الوجهة</label>
                                                <input type="text" name="destination_ar" class="form-control"
                                                       value="{{$package->destination_ar}}">
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-6">
                                            <div class="form-group clearfix">
                                                <label>التصنيف</label>
                                                <input type="text" name="category_ar" class="form-control"
                                                       value="{{$package->category_ar}}">
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
                                                @if(isset($package->image_ar))
                                                    <img style="width: 150px;"
                                                         src="{{ url('storage/app/public/images/package/'.$package->image_ar) }}"/>
                                                @endif
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
                                                @if(isset($package->package_image_header_ar))
                                                    <img style="width: 150px;"
                                                         src="{{ url('storage/app/public/images/package/'.$package->package_image_header_ar) }}"/>
                                                @endif
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
                                                @if(isset($package->pdf_ar))
                                                    {{$package->pdf_ar}}
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-6">
                                            <a href="{{ url('storage/app/public/pdf/'.$package->pdf_ar) }}" target="_blank">
                                                {{$package->pdf_ar}}
                                            </a>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12 col-md-12">
                                            <div class="form-group clearfix">
                                                <label>لمحة عامة</label>
                                                <textarea class="textarea" name="overview_ar"
                                                          style="max-width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$package->overview_ar}}</textarea>
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
                                                          style="max-width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$package->terms_condition_ar}}</textarea>
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
                                                          style="max-width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$package->cancellation_policy_ar}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12 col-md-12">
                                            <div class="form-group clearfix">
                                                <label style="width: 100%;">المعلومات الإضافية </label>
                                                <textarea class="textarea" name="additional_info_ar"
                                                          style="max-width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$package->additional_info_ar}}</textarea>
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
                            <div class="row">
                                <div class="col-sm-1">
                                    <label>Hotels
                                    </label>
                                </div>
                                <div class="col-sm-10">
                                    @if($all_hotels)
                                        <select class="form-control select2bs4" id="package_hotel" style="width: 100%;">
                                            <option value="">Select Hotel</option>
                                            @foreach($all_hotels as $select_list_hotel)
                                                <option value="{{$select_list_hotel->id}}">{{$select_list_hotel->name_en}}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                </div>
                                <div class="col-sm-1">
                                    <input type="button" class="btn btn-primary btn-sm " value="+" style="width: 50px" onclick="add_hotel()">
                                </div>
                            </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" id="div-container-hotel">
                                        @if(isset($package->packageHotels))
                                            <?php $package_hotel_repeater = 0 ?>
                                            @foreach($package->packageHotels as $packageHotel)
                                                @include('backend.view.hotel')
                                                <?php $package_hotel_repeater++;?>
                                            @endforeach
                                        @endif

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
                            @if(isset($package->transfers))
                                <?php $transfer_repeater = 1 ?>
                                @foreach($package->transfers as $transfer)
                                    @include('backend.view.transfer')
                                    <?php $transfer_repeater++;?>
                                @endforeach
                            @endif
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
                            @if(isset($package->flights))
                                <?php $flight_repeater = 1 ?>
                                @foreach($package->flights as $flight)
                                    @include('backend.view.flight')
                                    <?php $flight_repeater++;?>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header">
                            <?php
                            if (isset($package->open_include) && $package->open_include == '1') {
                                $open_include_checked = ' checked';
                            } else {
                                $open_include_checked = '';
                            }
                            ?>
                            <h3 class="card-title" style="width: 100%">
                                <input type="button" class="btn btn-primary btn-sm " value="+" style="width: 50px"
                                       onclick="add_inclusion()">
                                Inclusions
                                <span class="float-right">
                                     <input {{$open_include_checked}} type="checkbox" value="1" name="open_include"> Show open
                                </span>
                            </h3>
                        </div>
                        <div class="card-body" id='div-container-inclusion'>
                            @if(isset($package->inclusions))
                                <?php $inclusion_repeater = 1 ?>
                                @foreach($package->inclusions as $inclusion)
                                    @include('backend.view.inclusion')
                                    <?php $inclusion_repeater++ ?>
                                @endforeach
                                @endif
                        </div>
                    </div>
                    <div class="card card-primary card-outline card-outline-tabs">
                        <?php
                        if (isset($package->open_not_include) && $package->open_not_include == '1') {
                            $open_not_include_checked = ' checked';
                        } else {
                            $open_not_include_checked = '';
                        }
                        ?>
                        <div class="card-header">
                            <h3 class="card-title" style="width: 100%">
                                <input type="button" class="btn btn-primary btn-sm " value="+" style="width: 50px"
                                       onclick="add_exclusion()">
                                Exclusions
                                <span class="float-right">
                                     <input {{$open_not_include_checked}} type="checkbox" value="1"
                                            name="open_not_include"> Show open
                                </span>
                            </h3>
                        </div>
                        <div class="card-body" id="div-container-exclusion">
                            @if(isset($package->exclusions))
                                <?php $exclusion_repeater = 1 ?>
                                @foreach($package->exclusions as $exclusion)
                                    @include('backend.view.exclusion')
                                    <?php $exclusion_repeater++ ?>
                                @endforeach
                            @endif
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
                            @if(isset($package->labels))
                                <?php $label_repeater = 1 ?>
                                @foreach($package->labels as $label)
                                    @include('backend.view.label')
                                    <?php $label_repeater++ ?>
                                @endforeach
                            @endif
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
                            @if(isset($package->days))
                                <?php $day_repeater =1;?>
                                @foreach($package->days as $day)
                                    @include('backend.view.day')
                                    <?php $day_repeater++;?>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="form-group clearfix" style="padding: 15px;">
                            <input type="submit" name="action" value="Update" class="btn btn-success"/>
                            <input type="submit" name="action" value="Draft" class="btn btn-info"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>


@endsection
