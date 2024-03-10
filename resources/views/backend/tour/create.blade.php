@extends('backend.layouts.app')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="float-left col-sm-6">
                    <h1>Add Tour </h1>
                </div>
                <div class="float-left col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.tours.index',['country' => $country->id])}}">Tours of ({{$country->name_en}})
                              </a></li>
                        <li class="breadcrumb-item active">Add Tour</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 float-left col-sm-12">
                    <div class="card card-primary card-outline card-outline-tabs">
                        @if($errors->count() != 0)
                            <div class="form-group" >
                                <div class="col-8 col-md-8">
                                    @foreach ($errors->all() as $error)
                                        <p>{{$error}}</p>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <form id="demo-form2" method="POST" action="{{ route('admin.tours.store') }}" enctype="multipart/form-data" style="width: 100%">
                    @csrf
                  <input type="hidden" value="{{$country->id}}" name="country_id">
                    <div class="col-12 float-left col-sm-12">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="form-group" >
                                <div class="col-6 col-md-6" style="float: left">
                                    <label>City</label>
                                    <select name="city_id" class="form-control">
                                        <option value="">Select City</option>
                                        @if($cities)
                                            @foreach($cities as $city)
                                                <option value="{{$city->id}}">{{$city->name_en}}</option>
                                                @endforeach
                                            @endif
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <div class="float-left col-sm-1" >
                                    <input type="checkbox" class="form-control" name="is_car" value='1' style="margin-top:40px;"/>
                                </div>
                                <div class="float-left col-sm-2" >
                                    <label for="disabledinput" class="control-label">
                                        Price for (1 - 4)
                                    </label>
                                    <div class="control-label">
                                        <input name="price_1" type="number" id="price_1" class="form-control" />
                                    </div>
                                </div>

                                <div class="float-left col-sm-2" >
                                    <label for="disabledinput" class="control-label">
                                        Price for (1 - 8)
                                    </label>
                                    <div class="control-label">
                                        <input name="price_2" type="number" id="price_2" class="form-control" />
                                    </div>
                                </div>
                                <div class="float-left col-sm-2" >
                                    <label for="disabledinput" class="control-label">
                                        Price for (1 - 12)
                                    </label>
                                    <div class="control-label">
                                        <input name="price_3" type="number" id="price_3" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="float-left col-sm-1" >
                                    <input type="checkbox" class="form-control" name="is_bus" value='1' style="margin-top:40px;"/>
                                </div>
                                <div class="float-left col-sm-2" >
                                    <label for="disabledinput" class="control-label">
                                        Price for 1 Adult
                                    </label>
                                    <div class="control-label">
                                        <input name="price_bus" type="number" id="price_bus" class="form-control" />
                                    </div>
                                </div>
                                <div class="float-left col-sm-2" >
                                    <label for="disabledinput" class="control-label">
                                        Price for (0 - 2)
                                    </label>
                                    <div class="control-label">
                                        <input name="child_0_2" type="number" id="child_0_2" class="form-control" />
                                    </div>
                                </div>
                                <div class="float-left col-sm-2" >
                                    <label for="disabledinput" class="control-label">
                                        Price for (2 - 12)
                                    </label>
                                    <div class="control-label">
                                        <input name="child_2_12" type="number" id="child_2_12" class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 float-left col-sm-12">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header p-0 border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                    @if(Auth::guard('admin')->user()->hasRole('super-admin') || Auth::guard('admin')->user()->hasAllPermissions(['tours.create.en','tours.create.ar']))
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
                                    @elseif (Auth::guard('admin')->user()->hasPermissionTo('tours.create.en'))
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
                                    @elseif (Auth::guard('admin')->user()->hasPermissionTo('tours.create.ar'))
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
                                    @if (Auth::guard('admin')->user()->hasPermissionTo('tours.create.en'))
                                    <div class="tab-pane {{$active_en}}" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                                        <div class="col-md-8" >
                                            <div class="form-group" >
                                                <label>Tour Name<span class="required">*</span></label>
                                                <input type="text" name="name_en" class="form-control">
                                            </div>

                                            <div class="form-group" >
                                                <label>Description</label>
                                                <textarea class="textarea" name="text_en"
                                                          style="max-width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputFile">Image</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="exampleInputFile" name="image_en">
                                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                        @if (Auth::guard('admin')->user()->hasPermissionTo('tours.create.ar'))
                                    <div class="tab-pane {{$active_ar}}" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                                        <div class="col-md-4" style="float: left;height: 100px"></div>
                                        <div class="col-md-8" style="direction: rtl;text-align: right;float: left">
                                            <div class="form-group" >
                                                <label>اسم الرحلة <span class="required">*</span></label>
                                                <input type="text" name="name_ar" class="form-control">
                                            </div>

                                            <div class="form-group" >
                                                <label>الوصف</label>
                                                <textarea class="textarea" name="text_ar"
                                                          style="max-width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputFile">الصورة</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="exampleInputFile" name="image_ar">
                                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
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
                    <div class="col-12 float-left col-sm-12">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="form-group" style="padding: 15px;">
                                <input type="submit" class="btn btn-success" value="Save" />
                            </div>
                        </div>
                    </div>

                </form>

            </div>

        </div>
    </section>


@endsection
