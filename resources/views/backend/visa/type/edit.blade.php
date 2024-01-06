@extends('backend.layouts.app')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Visa Type </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.types.index')}}">Visa Types</a></li>
                        <li class="breadcrumb-item active">ُEdit Visa Type</li>
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
                <form id="demo-form2" method="POST" action="{{ route('admin.types.update', $type->id) }}"
                      enctype="multipart/form-data" style="width: 100%">
                    @csrf
                    @method('patch')

                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header p-0 border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                    @if(Auth::guard('admin')->user()->hasRole('super-admin') || Auth::guard('admin')->user()->hasAllPermissions(['visa.types.edit.en','visa.types.edit.ar']))
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
                                    @elseif (Auth::guard('admin')->user()->hasPermissionTo('visa.types.edit.en'))
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
                                    @elseif (Auth::guard('admin')->user()->hasPermissionTo('visa.types.edit.ar'))
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
                                    @if (Auth::guard('admin')->user()->hasPermissionTo('visa.types.edit.en'))
                                        <div class="tab-pane {{$active_en}}" id="custom-tabs-four-home" role="tabpanel"
                                             aria-labelledby="custom-tabs-four-home-tab">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label>Title <span class="required">*</span></label>
                                                    <input type="text" name="name_en" class="form-control"
                                                           value="{{$type->name_en}}">
                                                </div>

                                                <div class="form-group">
                                                    <label>Visa Information</label>
                                                    <textarea class="textarea" name="info_en"
                                                              style="max-width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"> {{$type->info_en}}</textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputFile">Image</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                   id="exampleInputFile" name="image_en"
                                                                   value="{{$type->image_en}}">
                                                            <label class="custom-file-label" for="exampleInputFile">Choose
                                                                file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if(isset($type->image_en))
                                                    <div class="form-group">
                                                        <img src="{{ url('storage/app/public/images/visa/',$type->image_en) }}"
                                                             style="width: 150px"/>
                                                    </div>
                                                @endif
                                                <div class="form-group">
                                                    <label for="exampleInputFile">Header Image</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                   id="exampleInputFile" name="header_image_en"
                                                                   value="{{$type->header_image_en}}">
                                                            <label class="custom-file-label" for="exampleInputFile">Choose
                                                                file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if(isset($type->header_image_en))
                                                    <div class="form-group">
                                                        <img src="{{ url('storage/app/public/images/visa/',$type->header_image_en) }}"
                                                             style="width: 150px"/>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                    @if (Auth::guard('admin')->user()->hasPermissionTo('visa.types.edit.ar'))
                                        <div class="tab-pane {{$active_ar}}" id="custom-tabs-four-profile"
                                             role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                                            <div class="col-md-4" style="float: left;height: 100px"></div>
                                            <div class="col-md-8" style="direction: rtl;text-align: right;float: left">
                                                <div class="form-group">
                                                    <label>العنوان <span class="required">*</span></label>
                                                    <input type="text" name="name_ar" class="form-control"
                                                           value="{{$type->name_ar}}">
                                                </div>

                                                <div class="form-group">
                                                    <label>الوصف</label>
                                                    <textarea class="textarea" name="info_ar"
                                                              style="max-width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$type->info_ar}}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputFile">الصورة</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                   id="exampleInputFile" name="image_ar"
                                                                   value="{{$type->image_ar}}">
                                                            <label class="custom-file-label" for="exampleInputFile">Choose
                                                                file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if(isset($type->image_ar))
                                                    <div class="form-group">
                                                        <img src="{{ url('storage/app/public/images/visa/',$type->image_ar) }}"
                                                             style="width: 150px"/>
                                                    </div>
                                                @endif
                                                <div class="form-group">
                                                    <label for="exampleInputFile">صورة الهيدر</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                   id="exampleInputFile" name="header_image_ar"
                                                                   value="{{$type->header_image_ar}}">
                                                            <label class="custom-file-label" for="exampleInputFile">Choose
                                                                file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if(isset($type->header_image_ar))
                                                    <div class="form-group">
                                                        <img src="{{ url('storage/app/public/images/visa/',$type->header_image_ar) }}"
                                                             style="width: 150px"/>
                                                    </div>
                                                @endif
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
