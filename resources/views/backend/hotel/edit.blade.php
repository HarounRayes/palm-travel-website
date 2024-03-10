@extends('backend.layouts.app')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Hotel </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a
                                href="{{route('admin.hotels.index',['country' => $country->id])}}">Countries</a></li>
                        <li class="breadcrumb-item active">Edit Hotel</li>
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
                <form id="demo-form2" method="POST" action="{{ route('admin.hotels.update',$hotel->id) }}"
                      enctype="multipart/form-data" style="width: 100%">
                    @csrf
                    @method('patch')
                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="form-group">
                                <div class="col-6 col-md-6" style="float: left">
                                    <label>Country</label>
                                    <select class="form-control" disabled="true">
                                        <option selected value="{{$country->id}}">{{$country->name_en}}</option>
                                    </select>
                                </div>
                                <div class="col-6 col-md-6" style="float: left">
                                    <label>Star rate</label>
                                    <input class="form-control" type="number" name="star_rate"
                                           value="{{$hotel->star_rate}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-6 col-md-6" style="float: left">

                                    <label>Website Link</label>
                                    <input type="text" name="website_link" class="form-control"
                                           value="{{$hotel->website_link}}">
                                </div>
                                <div class="col-6 col-md-6" style="float: left">

                                    <label for="exampleInputFile">Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="exampleInputFile"
                                                   name="image">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                    </div>
                                    @if(isset($hotel->image))
                                        <img style="width: 100px;"
                                             src="{{ url('storage/app/public/images/hotel/'.$hotel->image) }}"/>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header p-0 border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                    @if(Auth::guard('admin')->user()->hasRole('super-admin') || Auth::guard('admin')->user()->hasAllPermissions(['hotels.edit.en','hotels.edit.ar']))
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
                                    @elseif (Auth::guard('admin')->user()->hasPermissionTo('hotels.edit.en'))
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
                                    @elseif (Auth::guard('admin')->user()->hasPermissionTo('hotels.edit.ar'))
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
                                    @if (Auth::guard('admin')->user()->hasPermissionTo('hotels.edit.en'))
                                        <div class="tab-pane {{$active_en}}" id="custom-tabs-four-home" role="tabpanel"
                                             aria-labelledby="custom-tabs-four-home-tab">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label>Hotel name <span class="required">*</span></label>
                                                    <input type="text" name="name_en" class="form-control"
                                                           value="{{$hotel->name_en}}">
                                                </div>

                                                <div class="form-group">
                                                    <label>Hotel Information</label>
                                                    <textarea class="textarea" name="info_en"
                                                              style="max-width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$hotel->info_en}}</textarea>
                                                </div>

                                            </div>
                                        </div>
                                    @endif
                                    @if (Auth::guard('admin')->user()->hasPermissionTo('hotels.edit.ar'))
                                        <div class="tab-pane {{$active_ar}}" id="custom-tabs-four-profile"
                                             role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                                            <div class="col-md-4" style="float: left;height: 100px"></div>
                                            <div class="col-md-8" style="direction: rtl;text-align: right;float: left">
                                                <div class="form-group">
                                                    <label>اسم الفندق <span class="required">*</span></label>
                                                    <input type="text" name="name_ar" class="form-control"
                                                           value="{{$hotel->name_ar}}">
                                                </div>

                                                <div class="form-group">
                                                    <label>معلومات الفندق</label>
                                                    <textarea class="textarea" name="info_ar"
                                                              style="max-width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$hotel->info_ar}}</textarea>
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
