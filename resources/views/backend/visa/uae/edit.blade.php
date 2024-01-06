@extends('backend.layouts.app')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Visa Outbound </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.outbounds.index')}}">Visa Outbounds</a>
                        </li>
                        <li class="breadcrumb-item active">Edit Outbound</li>
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
                <form id="demo-form2" method="POST" action="{{ route('admin.uaes.update',$uae->id) }}"
                      enctype="multipart/form-data" style="width: 100%">
                    @csrf
                    @method('patch')
                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header p-0 border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                    @if(Auth::guard('admin')->user()->hasRole('super-admin') || Auth::guard('admin')->user()->hasAllPermissions(['visa.uae.edit.en','visa.uae.edit.ar']))
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
                                    @elseif (Auth::guard('admin')->user()->hasPermissionTo('visa.uae.edit.en'))
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
                                    @elseif (Auth::guard('admin')->user()->hasPermissionTo('visa.uae.edit.ar'))
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
                                    @if (Auth::guard('admin')->user()->hasPermissionTo('visa.uae.edit.en'))
                                        <div class="tab-pane {{$active_en}}" id="custom-tabs-four-home"
                                             role="tabpanel"
                                             aria-labelledby="custom-tabs-four-home-tab">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label>Country <span class="required">*</span></label>
                                                    <input type="text" name="name_en" class="form-control"
                                                           value="{{$uae->name_en}}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Introduction</label>
                                                    <textarea class="textarea" name="intro_en"
                                                              style="max-width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$uae->intro_en}}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea class="textarea" name="text_en"
                                                              style="max-width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$uae->text_en}}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Note</label>
                                                    <textarea class="textarea" name="note_en"
                                                              style="max-width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$uae->note_en}}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputFile">Image</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                   id="exampleInputFile" name="image_en">
                                                            <label class="custom-file-label" for="exampleInputFile">Choose
                                                                file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputFile">Header Image</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                   id="exampleInputFile" name="header_image_en">
                                                            <label class="custom-file-label" for="exampleInputFile">Choose
                                                                file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if (Auth::guard('admin')->user()->hasPermissionTo('visa.uae.edit.ar'))
                                        <div class="tab-pane {{$active_ar}}" id="custom-tabs-four-profile"
                                             role="tabpanel"
                                             aria-labelledby="custom-tabs-four-home-tab">
                                            <div class="col-md-4" style="float: left;height: 100px"></div>
                                            <div class="col-md-8" style="direction: rtl;text-align: right;float: left">
                                                <div class="form-group">
                                                    <label>البلد <span class="required">*</span></label>
                                                    <input type="text" name="name_ar" class="form-control"
                                                           value="{{$uae->name_ar}}">
                                                </div>
                                                <div class="form-group">
                                                    <label>المقدمة</label>
                                                    <textarea class="textarea" name="intro_ar"
                                                              style="max-width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$uae->intro_ar}}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>الوصف</label>
                                                    <textarea class="textarea" name="text_ar"
                                                              style="max-width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$uae->text_ar}}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>الملاحظات</label>
                                                    <textarea class="textarea" name="note_ar"
                                                              style="max-width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$uae->note_ar}}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputFile">الصورة</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                   id="exampleInputFile" name="image_ar">
                                                            <label class="custom-file-label" for="exampleInputFile">Choose
                                                                file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputFile">صورة الهيدر</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                   id="exampleInputFile" name="header_image_ar">
                                                            <label class="custom-file-label" for="exampleInputFile">Choose
                                                                file</label>
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
                    </div>
                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="form-group">

                                <div class="col-6 col-md-6" style="float: left">
                                    <label>Type</label>
                                    <select name="visa_type_id" class="form-control select2bs4" required>
                                        <option value="">Select Type</option>
                                        @foreach($types as $type)
                                            @if($type->id == $uae->visa_type_id)
                                                <option value="{{$type->id}}" selected>{{$type->name_en}}</option>
                                            @else
                                                <option value="{{$type->id}}">{{$type->name_en}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div id="nationalities-of-country">
                                <div class="col-12">
                                    <label>Country nationalities</label>
                                </div>
                                <div class="row" style="padding:20px">
                                    @foreach($nationalities as $nationality)

                                        @if(in_array($nationality->visa_nationality_id,$uae->nationalitiesIDs()))
                                            <div class="col-sm-4 section-preview"
                                                 style="border: 1px solid #e0e0e0;padding: 15px;margin-bottom: 10px">
                                                <div class="icheck-primary d-inline">
                                                    <input type="checkbox" id="checkboxPrimary-{{$nationality->visa_nationality_id}}"
                                                           value="{{$nationality->visa_nationality_id}}" checked
                                                           name="visanationality[{{$nationality->visa_nationality_id}}]"
                                                    >
                                                    <label for="checkboxPrimary-{{$nationality->visa_nationality_id}}">
                                                        {{$nationality->nationality->name_en}}
                                                    </label>
                                                    <input type="number"
                                                           class="form-control custom-control-input-number"
                                                           placeholder="Price" value="{{$uae->nationalityPrice($nationality->visa_nationality_id)}}" min="0"
                                                           name="visanationalityprice[{{$nationality->visa_nationality_id}}]"/>
                                                </div>

                                            </div>
                                        @else
                                                <div class="col-sm-4 section-preview"
                                                     style="border: 1px solid #e0e0e0;padding: 15px;margin-bottom: 10px">
                                                    <div class="icheck-primary d-inline">
                                                        <input type="checkbox" id="checkboxPrimary-{{$nationality->visa_nationality_id}}"
                                                               value="{{$nationality->visa_nationality_id}}"
                                                               name="visanationality[{{$nationality->visa_nationality_id}}]"
                                                        >
                                                        <label for="checkboxPrimary-{{$nationality->visa_nationality_id}}">
                                                            {{$nationality->nationality->name_en}}
                                                        </label>
                                                        <input type="number"
                                                               class="form-control custom-control-input-number"
                                                               placeholder="Price" value="{{$uae->nationalityPrice($nationality->visa_nationality_id)}}" min="0"
                                                               name="visanationalityprice[{{$nationality->visa_nationality_id}}]"/>
                                                    </div>

                                                </div>
                                        @endif


                                @endforeach
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
