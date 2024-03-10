@extends('backend.layouts.app')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Country </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.countries.index')}}">Countries</a></li>
                        <li class="breadcrumb-item active">Add Country</li>
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
                <form id="demo-form2" method="POST" action="{{ route('admin.countries.store') }}"
                      enctype="multipart/form-data" style="width: 100%">
                    @csrf

                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="form-group">
                                <div class="col-6 col-md-6" style="float: left">

                                    <label>Start Price</label>
                                    <input type="number" name="start_price" class="form-control"
                                           value="{{old('start_price')}}">
                                </div>
                                <div class="col-6 col-md-6" style="float: left">

                                    <label for="exampleInputFile">Flag <span class="required">*</span></label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="exampleInputFile"
                                                   name="flag" required>
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header p-0 border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                    @if(Auth::guard('admin')->user()->hasRole('super-admin') || Auth::guard('admin')->user()->hasAllPermissions(['countries.create.en','countries.create.ar']))
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
                                    @elseif (Auth::guard('admin')->user()->hasPermissionTo('countries.create.en'))
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
                                    @elseif (Auth::guard('admin')->user()->hasPermissionTo('countries.create.ar'))
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
                                    @if (Auth::guard('admin')->user()->hasPermissionTo('countries.create.en'))
                                        <div class="tab-pane {{$active_en}}" id="custom-tabs-four-home" role="tabpanel"
                                             aria-labelledby="custom-tabs-four-home-tab">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label>Country <span class="required">*</span></label>
                                                    <input type="text" name="name_en" class="form-control"
                                                           value="{{old('name_en')}}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Capital <span class="required">*</span></label>
                                                    <input type="text" name="capital_en" class="form-control"
                                                           value="{{old('capital_en')}}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Currency</label>
                                                    <input type="text" name="currency_en" class="form-control"
                                                           value="{{old('currency_en')}}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Convert Currency</label>
                                                    <input type="text" name="convert_currency_en" class="form-control"
                                                           value="{{old('convert_currency_en')}}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Official Language</label>
                                                    <input type="text" name="official_lang_en" class="form-control"
                                                           value="{{old('official_lang_en')}}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Visa Information</label>
                                                    <textarea class="textarea" name="visa_info_en"
                                                              style="max-width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{old('visa_info_en')}}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Introduction Text</label>
                                                    <textarea class="textarea" name="intro_en"
                                                              style="max-width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{old('intro_en')}}</textarea>
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
                                                <div class="form-group">
                                                    <label for="beexampleInputFile">Background Image</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                   id="beexampleInputFile" name="background_image_en">
                                                            <label class="custom-file-label" for="beexampleInputFile">Choose
                                                                file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if (Auth::guard('admin')->user()->hasPermissionTo('countries.create.ar'))
                                        <div class="tab-pane {{$active_ar}}" id="custom-tabs-four-profile"
                                             role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                                            <div class="col-md-4" style="float: left;height: 100px"></div>
                                            <div class="col-md-8" style="direction: rtl;text-align: right;float: left">
                                                <div class="form-group">
                                                    <label>البلد <span class="required">*</span></label>
                                                    <input type="text" name="name_ar" class="form-control"
                                                           value="{{old('name_ar')}}">
                                                </div>
                                                <div class="form-group">
                                                    <label> <span class="required">*</span>العاصمة</label>
                                                    <input type="text" name="capital_ar" class="form-control"
                                                           value="{{old('capital_ar')}}">
                                                </div>
                                                <div class="form-group">
                                                    <label>العملة</label>
                                                    <input type="text" name="currency_ar" class="form-control"
                                                           value="{{old('currency_ar')}}">
                                                </div>
                                                <div class="form-group">
                                                    <label>تحويل العملة</label>
                                                    <input type="text" name="convert_currency_ar" class="form-control"
                                                           value="{{old('convert_currency_ar')}}">
                                                </div>
                                                <div class="form-group">
                                                    <label>اللغة الرسمية</label>
                                                    <input type="text" name="official_lang_ar" class="form-control"
                                                           value="{{old('official_lang_ar')}}">
                                                </div>
                                                <div class="form-group">
                                                    <label>معلومات التأشيرة</label>
                                                    <textarea class="textarea" name="visa_info_ar"
                                                              style="max-width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{old('visa_info_ar')}}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>نص المقدمة</label>
                                                    <textarea class="textarea" name="intro_ar"
                                                              style="max-width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{old('intro_ar')}}</textarea>
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
                                                <div class="form-group">
                                                    <label for="baexampleInputFile">صورة الخلفية</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                   id="baexampleInputFile" name="background_image_ar">
                                                            <label class="custom-file-label" for="baexampleInputFile">اختر الملف</label>
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
