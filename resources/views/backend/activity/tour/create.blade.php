@extends('backend.layouts.app')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <h1>Add Activity Tour to ({{$country_tour->name_en}}) </h1>
                </div>
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.activitytours.index')}}">Tours</a></li>
                        <li class="breadcrumb-item active">Add Tour</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
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
                <form id="demo-form2" method="POST" action="{{ route('admin.activitytours.store') }}"
                      enctype="multipart/form-data" style="width: 100%">
                    @csrf
                    <input type="hidden" value="{{$country_tour->id}}" name="activity_country_id">
                    <div class="card card-primary card-outline card-outline-tabs">

                        <div class="card-body">
                            <div class="row">
                                <div class=" col-4 col-xs-4 ">
                                    <div class="form-group clearfix">

                                        <label for="disabledinput" class="control-label">
                                            Date From
                                        </label>
                                        <input name="date" type="text" id="date" required
                                               class="form-control datetimepicker-input datepicker"/>
                                    </div>
                                </div>
                                <div class=" col-4 col-xs-4 ">
                                    <div class="form-group clearfix">

                                        <label for="disabledinput" class="control-label">
                                             Date To
                                        </label>
                                        <input name="cancellation_date" type="text" id="cancellation_date" required
                                               class="form-control datetimepicker-input datepicker"/>
                                    </div>
                                </div>
                                <div class=" col-4 col-xs-4 ">
                                    <div class="form-group clearfix">
                                        <label for="disabledinput" class="control-label">
                                            Price
                                        </label>
                                        <input name="price" type="number" id="price" required class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            {{--                            <div class="row">--}}
                            {{--                                <div class="col-6 col-md-6">--}}
                            {{--                                   --}}
                            {{--                                </div>--}}
                            {{--                                <div class="col-6 col-md-6" id="city-of-country" style="float: left"></div>--}}
                            {{--                            </div>--}}
                            <hr>
                            <div class="row">
                                <div class="col-4 col-xs-4">
                                    <div class="form-group clearfix">
                                        <label>City</label>
                                        @if($cities)
                                            <select class="form-control select2bs4" id="activity_city_id"
                                                    name="activity_city_id"
                                                    required="true"
                                                    style="width: 100%;">
                                                <option value="">Select City</option>
                                                @foreach($cities as $city)
                                                    <option value="{{$city->id}}">{{$city->name_en}}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                </div>
                                <div class=" col-4 col-xs-4 ">
                                    <div class="form-group clearfix">
                                        <label for="disabledinput" class="control-label">
                                            Activity duration
                                        </label>
                                        <select class="form-control" id="activity_duration" name="activity_duration"
                                                required="true">
                                            <option value="">Select</option>
                                            <option value="half">Half</option>
                                            <option value="full">Full</option>
                                        </select>
                                    </div>
                                </div>
                                <div class=" col-4 col-xs-4 ">
                                    <div class="form-group clearfix">
                                        <label for="disabledinput" class="control-label">
                                            Activity for
                                        </label>
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

                            </div>
                        </div>
                    </div>
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header">
                            <h3 class="card-title" style="width: 100%">
                                Categories
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-1">
                                    <label>Category </label>
                                </div>
                                <div class="col-sm-10">
                                    @if($categories)
                                        <select class="form-control select2bs4" id="tour_category" required="true"
                                                style="width: 100%;">
                                            <option value="">Select Categoty</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name_en}}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                </div>
                                <div class="col-sm-1">
                                    <input type="button" class="btn btn-primary btn-sm " value="+" style="width: 50px"
                                           onclick="add_category()">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" id="div-container-category">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header p-0 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                @if(Auth::guard('admin')->user()->hasRole('super-admin') || Auth::guard('admin')->user()->hasAllPermissions(['activities.tours.create.en','activities.tours.create.ar']))
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
                                @elseif (Auth::guard('admin')->user()->hasPermissionTo('activities.tours.create.en'))
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
                                @elseif (Auth::guard('admin')->user()->hasPermissionTo('activities.tours.create.ar'))
                                    <?php
                                    $active_en = '';
                                    $active_ar = 'fade show active';
                                    ?>
                                    <li class="nav-item ">
                                        <a class="nav-link active" id="custom-tabs-four-profile-tab"
                                           data-toggle="pill" href="#custom-tabs-four-profile" role="tab"
                                           aria-controls="custom-tabs-four-profile" aria-selected="false">
                                            عربي
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        <div class="card-body">

                            <div class="tab-content" id="custom-tabs-four-tabContent">
                                @if (Auth::guard('admin')->user()->hasPermissionTo('activities.tours.create.en'))
                                    <div class="tab-pane {{$active_en}}" id="custom-tabs-four-home" role="tabpanel"
                                         aria-labelledby="custom-tabs-four-home-tab">
                                        <div class="row">
                                            <div class="col-6 col-md-6">
                                                <div class="form-group clearfix">
                                                    <label>Title <span class="required">*</span></label>
                                                    <input type="text" name="name_en" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <hr>
                                        <div class="row">
                                            <div class="col-12 col-md-12">
                                                <div class="form-group clearfix">
                                                    <label style="width: 100%;">Introduction
                                                    </label>
                                                    <textarea class="textarea" name="intro_en"
                                                              style="max-width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-12 col-md-12">
                                                <div class="form-group clearfix">
                                                    <label>Overview</label>
                                                    <textarea class="textarea" name="overview_en" id="overview_en"
                                                              style="max-width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>

                                        <div class="row">
                                            <div class="col-12 col-md-12">
                                                <div class="form-group clearfix">
                                                    <label style="width: 100%;">Term
                                                    </label>
                                                    <textarea class="textarea" name="term_en"
                                                              style="max-width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-12 col-md-12">
                                                <div class="form-group clearfix">
                                                    <label style="width: 100%;">Information
                                                    </label>
                                                    <textarea class="textarea" name="info_en"
                                                              style="max-width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-12 col-md-12">
                                                <div class="form-group clearfix">
                                                    <label style="width: 100%;">Cancellation Deadline
                                                    </label>
                                                    <textarea class="textarea" name="deadline_en"
                                                              style="max-width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
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

                                        </div>
                                    </div>
                                @endif
                                @if (Auth::guard('admin')->user()->hasPermissionTo('activities.tours.create.ar'))
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
                                            <div class="col-12 col-md-12">
                                                <div class="form-group clearfix">
                                                    <label style="width: 100%;">المقدمة
                                                    </label>
                                                    <textarea class="textarea" name="intro_ar"
                                                              style="max-width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-12 col-md-12">
                                                <div class="form-group clearfix">
                                                    <label>لمحة عامة</label>
                                                    <textarea class="textarea" name="overview_ar" id="overview_ar"
                                                              style="max-width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>

                                        <div class="row">
                                            <div class="col-12 col-md-12">
                                                <div class="form-group clearfix">
                                                    <label style="width: 100%;">الشروط
                                                    </label>
                                                    <textarea class="textarea" name="term_ar"
                                                              style="max-width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-12 col-md-12">
                                                <div class="form-group clearfix">
                                                    <label style="width: 100%;">المعلومات</label>
                                                    <textarea class="textarea" name="info_ar"
                                                              style="max-width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-12 col-md-12">
                                                <div class="form-group clearfix">
                                                    <label style="width: 100%;">شروط الإلغاء
                                                    </label>
                                                    <textarea class="textarea" name="deadline_ar"
                                                              style="max-width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-6 col-md-6"></div>
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
                                <input type="button" class="btn btn-primary btn-sm " value="+" style="width: 50px"
                                       onclick="add_inclusion()">
                                Inclusions
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
                            </h3>
                        </div>
                        <div class="card-body" id="div-container-exclusion">
                        </div>
                    </div>
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="form-group clearfix" style="padding: 15px;">
                            <input type="submit" class="btn btn-success" value="Save"/>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </section>
@endsection
