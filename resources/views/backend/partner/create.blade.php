@if(Auth::guard('admin')->user()->hasRole('super-admin') || Auth::guard('admin')->user()->hasAllPermissions(['partners.create.en','partners.create.ar']))
    <?php
    $active_ar = '';
    $active_en = 'fade show active';
    $ar_tab = $en_tab = true;
    ?>
@elseif (Auth::guard('admin')->user()->hasPermissionTo('partners.create.en'))
    <?php
    $active_ar = '';
    $active_en = 'fade show active';
    $ar_tab = false; $en_tab = true;
    ?>
@elseif (Auth::guard('admin')->user()->hasPermissionTo('partners.create.ar'))
    <?php
    $active_en = '';
    $active_ar = 'fade show active';
    $ar_tab = true; $en_tab = false;
    ?>
@endif

@extends('backend.layouts.app')
@section('content')
    <!-- header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Partner </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.partners.index')}}">Partners</a></li>
                        <li class="breadcrumb-item active">Add Partner</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <!-- Errors -->
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

                <form id="demo-form2" method="POST" action="{{ route('admin.partners.store') }}"
                      enctype="multipart/form-data" style="width: 100%">
                    @csrf
                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-outline card-outline-tabs">

                            <!-- Tabs -->
                            <div class="card-header p-0 border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                    @if($en_tab)
                                        <li class="nav-item">
                                            <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill"
                                               href="#custom-tabs-four-home" role="tab"
                                               aria-controls="custom-tabs-four-home" aria-selected="true">
                                                English
                                            </a>
                                        </li>
                                    @endif
                                    @if($ar_tab)
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill"
                                               href="#custom-tabs-four-profile" role="tab"
                                               aria-controls="custom-tabs-four-profile" aria-selected="false">
                                                عربي
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </div>

                            <!-- Tabs Content -->
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-four-tabContent">
                                    @if (Auth::guard('admin')->user()->hasPermissionTo('partners.create.en'))
                                        <div class="tab-pane {{$active_en}}" id="custom-tabs-four-home" role="tabpanel"
                                             aria-labelledby="custom-tabs-four-home-tab">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" name="name_en" class="form-control"
                                                           value="{{old('name_en')}}">
                                                </div>


                                            </div>
                                        </div>
                                    @endif
                                    @if (Auth::guard('admin')->user()->hasPermissionTo('partners.create.ar'))
                                        <div class="tab-pane {{$active_ar}}" id="custom-tabs-four-profile"
                                             role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                                            <div class="col-md-12" style="direction: rtl;text-align: right;float: left">
                                                <div class="form-group">
                                                    <label>الاسم</label>
                                                    <input type="text" name="name_ar" class="form-control"
                                                           value="{{old('name_ar')}}">
                                                </div>
                                            </div>

                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="col-md-12">
                                <!-- Image -->
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input"
                                                   id="image" name="image">
                                            <label class="custom-file-label" for="image">Choose
                                                file</label>
                                        </div>
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
