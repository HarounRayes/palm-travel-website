@extends('backend.layouts.app')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit UAE Visa Nationality </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.uaeNationalities.index')}}">Nationalities
                            </a></li>
                        <li class="breadcrumb-item active">Edit Nationality</li>
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
                            <div class="form-group">
                                <div class="col-8 col-md-8">
                                    @foreach ($errors->all() as $error)
                                        <p>{{$error}}</p>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <form id="demo-form2" method="POST" action="{{ route('admin.uaeNationalities.update',$uae->id) }}"
                      enctype="multipart/form-data" style="width: 100%">
                    @csrf
                    @method('patch')
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <label>UAE Visa Required?</label>
                                    <div class="form-group clearfix">

                                        <div class="icheck-primary d-inline">
                                            @if($uae->is_visa)
                                                <input type="radio" id="radioPrimary1" name="is_visa" value="1"
                                                       onclick="visaVisibility(this.value)"
                                                       checked>
                                            @else
                                                <input type="radio" id="radioPrimary1" name="is_visa" value="1"
                                                       onclick="visaVisibility(this.value)">
                                            @endif
                                            <label for="radioPrimary1">
                                                Yes
                                            </label>
                                        </div>
                                        <div class="icheck-primary d-inline">
                                            @if(!$uae->is_visa)
                                                <input type="radio" id="radioPrimary2" name="is_visa" value="0"
                                                       onclick="visaVisibility(this.value)"
                                                       checked>
                                            @else
                                                <input type="radio" id="radioPrimary2" name="is_visa" value="0"
                                                       onclick="visaVisibility(this.value)">
                                            @endif
                                            <label for="radioPrimary2">
                                                No
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
                                @if(Auth::guard('admin')->user()->hasRole('super-admin') || Auth::guard('admin')->user()->hasAllPermissions(['visa.uae.nationalities.edit.en','visa.uae.nationalities.edit.ar']))
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
                                @elseif (Auth::guard('admin')->user()->hasPermissionTo('visa.uae.nationalities.edit.en'))
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
                                @elseif (Auth::guard('admin')->user()->hasPermissionTo('visa.uae.nationalities.edit.ar'))
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
                                @if (Auth::guard('admin')->user()->hasPermissionTo('visa.uae.nationalities.edit.en'))
                                    <div class="tab-pane {{$active_en}}" id="custom-tabs-four-home" role="tabpanel"
                                         aria-labelledby="custom-tabs-four-home-tab">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Name<span class="required">*</span></label>
                                                <input type="text" name="name_en" class="form-control"
                                                       value="{{$uae->name_en}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputFile">Image</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input"
                                                               id="exampleInputFile" name="image_en"
                                                               value="{{$uae->image_en}}">
                                                        <label class="custom-file-label" for="exampleInputFile">Choose
                                                            file</label>
                                                    </div>
                                                </div>
                                            </div>
                                            @if(isset($uae->image_en))
                                                <div class="form-group">
                                                    <img src="{{ url('storage/app/public/images/visa/',$uae->image_en) }}"
                                                         style="width: 150px"/>
                                                </div>
                                            @endif
                                            <div class="form-group">
                                                <label for="exampleInputFile">Header Image</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input"
                                                               id="exampleInputFile" name="header_image_en"
                                                               value="{{$uae->header_image_en}}">
                                                        <label class="custom-file-label" for="exampleInputFile">Choose
                                                            file</label>
                                                    </div>
                                                </div>
                                            </div>
                                            @if(isset($uae->header_image_en))
                                                <div class="form-group">
                                                    <img src="{{ url('storage/app/public/images/visa/',$uae->header_image_en) }}"
                                                         style="width: 150px"/>
                                                </div>
                                            @endif
                                        </div>
                                        @if(!$uae->is_visa)
                                            <div class="col-md-8 visa-text">
                                                @else
                                                    <div class="col-md-8 visa-text" style="display: none">
                                                        @endif
                                                        <div class="form-group">
                                                            <label>Description</label>
                                                            <textarea class="textarea" name="text_en"
                                                                      style="max-width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$uae->text_en}}</textarea>
                                                        </div>

                                                    </div>

                                            </div>
                                        @endif
                                        @if (Auth::guard('admin')->user()->hasPermissionTo('visa.uae.nationalities.edit.ar'))
                                            <div class="tab-pane {{$active_ar}}" id="custom-tabs-four-profile"
                                                 role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                                                <div class="col-md-4" style="float: left;height: 100px"></div>
                                                <div class="col-md-8"
                                                     style="direction: rtl;text-align: right;float: left">
                                                    <div class="form-group">
                                                        <label>الاسم <span class="required">*</span></label>
                                                        <input type="text" name="name_ar" class="form-control"
                                                               value="{{$uae->name_ar}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputFile">Image</label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input"
                                                                       id="exampleInputFile" name="image_ar"
                                                                       value="{{$uae->image_ar}}">
                                                                <label class="custom-file-label" for="exampleInputFile">Choose
                                                                    file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if(isset($uae->image_ar))
                                                        <div class="form-group">
                                                            <img src="{{ url('storage/app/public/images/visa/',$uae->image_ar) }}"
                                                                 style="width: 150px"/>
                                                        </div>
                                                    @endif
                                                    <div class="form-group">
                                                        <label for="exampleInputFile">Header Image</label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input"
                                                                       id="exampleInputFile" name="header_image_ar"
                                                                       value="{{$uae->header_image_ar}}">
                                                                <label class="custom-file-label" for="exampleInputFile">Choose
                                                                    file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if(isset($uae->header_image_ar))
                                                        <div class="form-group">
                                                            <img src="{{ url('storage/app/public/images/visa/',$uae->header_image_ar) }}"
                                                                 style="width: 150px"/>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-md-4" style="float: left;height: 100px"></div>
                                                @if(!$uae->is_visa)
                                                    <div class="col-md-8 visa-text"
                                                         style="direction: rtl;text-align: right;float: left">
                                                        @else
                                                            <div class="col-md-8 visa-text"
                                                                 style="direction: rtl;text-align: right;float: left;display: none">
                                                                @endif

                                                                <div class="form-group">
                                                                    <label>الوصف</label>
                                                                    <textarea class="textarea" name="text_ar"
                                                                              style="max-width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$uae->text_ar}}</textarea>
                                                                </div>
                                                            </div>

                                                    </div>
                                                @endif
                                            </div>
                                    </div>
                                    <!-- /.card -->
                            </div>
                            @if($uae->is_visa)
                                <div class="card card-primary card-outline card-outline-tabs visa-type">
                                    @else
                                        <div class="card card-primary card-outline card-outline-tabs visa-type"
                                             style="display: none">
                                            @endif
                                            <div class="card-header">
                                                <h3 class="card-title" style="width: 100%">
                                                    Types
                                                </h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group" id='hotel-of-country'>
                                                            <div class="row">
                                                                <div class="col-sm-11">
                                                                    @if($types)
                                                                        <select class="form-control select2bs4"
                                                                                id="type_id"
                                                                                style="width: 100%;">
                                                                            <option value="">Select Type</option>
                                                                            @foreach($types as $type)
                                                                                @if(in_array($type->id ,$uae->types_ids()))
                                                                                    <option disabled
                                                                                        value="{{$type->id}}">{{$type->name_en}}</option>
                                                                                    @else
                                                                                <option
                                                                                    value="{{$type->id}}">{{$type->name_en}}</option>
                                                                                @endif
                                                                            @endforeach
                                                                        </select>
                                                                    @endif
                                                                </div>
                                                                <div class="col-sm-1">
                                                                    <input type="button" class="btn btn-primary btn-sm "
                                                                           value="+"
                                                                           style="width: 50px" onclick="add_type()">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="div-container-type">
                                                            @if($uae->types->isNotEmpty())
                                                                <?php $type_repeater = 0 ?>
                                                                @foreach($uae->types as $type)
                                                                    @include('backend.view.nationalityType')
                                                                    <?php $type_repeater++ ?>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <div class="col-12 col-sm-12">
                                        <div class="card card-primary card-outline card-outline-tabs">
                                            <div class="form-group" style="padding: 15px;">
                                                <input type="submit" class="btn btn-success" value="Save"/>
                                            </div>
                                        </div>
                                    </div>

                </form>

            </div>

        </div>
    </section>


@endsection
