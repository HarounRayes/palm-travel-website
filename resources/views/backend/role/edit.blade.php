@extends('backend.layouts.app')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Role </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.roles.index')}}">Roles</a></li>
                        <li class="breadcrumb-item active">ُEdit Role</li>
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
                <form id="demo-form2" method="POST" action="{{ route('admin.roles.update', $role->id) }}" enctype="multipart/form-data" style="width: 100%">
                    @csrf
                    @method('patch')
                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Name <span class="required">*</span></label>
                                    <input type="text" name="name" class="form-control"
                                           value="{{$role->name}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header">
                                <h3 class="card-title">Package Permissions</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <select class="duallistbox" multiple="multiple"
                                                    name="permissions[]">
                                                <option value="packages.create.en" {{($role->hasPermissionTo('packages.create.en')?"selected":"")}}>
                                                    - Add Package English
                                                </option>
                                                <option value="packages.create.ar" {{($role->hasPermissionTo('packages.create.ar')?"selected":"")}}>
                                                    - Add Package Arabic
                                                </option>
                                                <option value="packages.edit.en" {{($role->hasPermissionTo('packages.edit.en')?"selected":"")}}>
                                                    - Edit Package English
                                                </option>
                                                <option value="packages.edit.ar" {{($role->hasPermissionTo('packages.edit.ar')?"selected":"")}}>
                                                    - Edit Package Arabic
                                                </option>
                                                <option value="packages.delete" {{($role->hasPermissionTo('packages.delete')?"selected":"")}}>
                                                    - Delete Package
                                                </option>
                                                <option value="packages.order" {{($role->hasPermissionTo('packages.order')?"selected":"")}}>
                                                    - Order Package
                                                </option>
                                                <option value="packages.slider" {{($role->hasPermissionTo('packages.slider')?"selected":"")}}>
                                                    - Slider Package
                                                </option>
                                            </select>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header">
                                <h3 class="card-title">Hotels Permissions</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <select class="duallistbox" multiple="multiple"
                                                    name="permissions[]">
                                                <option value="hotels.create.en" {{($role->hasPermissionTo('hotels.create.en')?"selected":"")}}>
                                                    - Add Hotel English
                                                </option>
                                                <option value="hotels.create.ar" {{($role->hasPermissionTo('hotels.create.ar')?"selected":"")}}>
                                                    - Add Hotel Arabic
                                                </option>
                                                <option value="hotels.edit.en" {{($role->hasPermissionTo('hotels.edit.en')?"selected":"")}}>
                                                    - Edit Hotel English
                                                </option>
                                                <option value="hotels.edit.ar" {{($role->hasPermissionTo('hotels.edit.ar')?"selected":"")}}>
                                                    - Edit Hotel Arabic
                                                </option>
                                                <option value="hotels.delete" {{($role->hasPermissionTo('hotels.delete')?"selected":"")}}>
                                                    - Delete Hotel
                                                </option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header">
                                <h3 class="card-title">Country Permissions</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <select class="duallistbox" multiple="multiple"
                                                    name="permissions[]">
                                                <option value="countries.create.en" {{($role->hasPermissionTo('countries.create.en')?"selected":"")}}>
                                                    - Add Country English
                                                </option>
                                                <option value="countries.create.ar" {{($role->hasPermissionTo('countries.create.ar')?"selected":"")}}>
                                                    - Add Country Arabic
                                                </option>
                                                <option value="countries.edit.en" {{($role->hasPermissionTo('countries.edit.en')?"selected":"")}}>
                                                    - Edit Country English
                                                </option>
                                                <option value="countries.edit.ar" {{($role->hasPermissionTo('countries.edit.ar')?"selected":"")}}>
                                                    - Edit Country Arabic
                                                </option>
                                                <option value="countries.delete" {{($role->hasPermissionTo('countries.delete')?"selected":"")}}>
                                                    - Delete Country
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header">
                                <h3 class="card-title">City Permissions</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <select class="duallistbox" multiple="multiple"
                                                    name="permissions[]">
                                                <option value="cities.create.en" {{($role->hasPermissionTo('cities.create.en')?"selected":"")}}>
                                                    - Add City English
                                                </option>
                                                <option value="cities.create.ar" {{($role->hasPermissionTo('cities.create.ar')?"selected":"")}}>
                                                    - Add City Arabic
                                                </option>
                                                <option value="cities.edit.en" {{($role->hasPermissionTo('cities.edit.en')?"selected":"")}}>
                                                    - Edit City English
                                                </option>
                                                <option value="cities.edit.ar" {{($role->hasPermissionTo('cities.edit.ar')?"selected":"")}}>
                                                    - Edit City Arabic
                                                </option>
                                                <option value="cities.delete" {{($role->hasPermissionTo('cities.delete')?"selected":"")}}>
                                                    - Delete City
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header">
                                <h3 class="card-title">Tours Permissions</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <select class="duallistbox" multiple="multiple"
                                                    name="permissions[]">
                                                <option value="tours.create.en" {{($role->hasPermissionTo('tours.create.en')?"selected":"")}}>
                                                    - Add Tour English
                                                </option>
                                                <option value="tours.create.ar" {{($role->hasPermissionTo('tours.create.ar')?"selected":"")}}>
                                                    - Add Tour Arabic
                                                </option>
                                                <option value="tours.edit.en" {{($role->hasPermissionTo('tours.edit.en')?"selected":"")}}>
                                                    - Edit Tour English
                                                </option>
                                                <option value="tours.edit.ar" {{($role->hasPermissionTo('tours.edit.ar')?"selected":"")}}>
                                                    - Edit Tour Arabic
                                                </option>
                                                <option value="tours.delete" {{($role->hasPermissionTo('tours.delete')?"selected":"")}}>
                                                    - Delete Tour
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header">
                                <h3 class="card-title">Blogs Permissions</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <select class="duallistbox" multiple="multiple"
                                                    name="permissions[]">
                                                <option value="blogs.create.en" {{($role->hasPermissionTo('blogs.create.en')?"selected":"")}}>
                                                    - Add Blog English
                                                </option>
                                                <option value="blogs.create.ar" {{($role->hasPermissionTo('blogs.create.ar')?"selected":"")}}>
                                                    - Add Blog Arabic
                                                </option>
                                                <option value="blogs.edit.en" {{($role->hasPermissionTo('blogs.edit.en')?"selected":"")}}>
                                                    - Edit Blog English
                                                </option>
                                                <option value="blogs.edit.ar" {{($role->hasPermissionTo('blogs.edit.ar')?"selected":"")}}>
                                                    - Edit Blog Arabic
                                                </option>
                                                <option value="blogs.delete" {{($role->hasPermissionTo('blogs.delete')?"selected":"")}}>
                                                    - Delete Blog
                                                </option>
                                                <option value="blogs.delete" {{($role->hasPermissionTo('blogs.info')?"selected":"")}}>
                                                    - General Information
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header">
                                <h3 class="card-title">Slider Permissions</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <select class="duallistbox" multiple="multiple"
                                                    name="permissions[]">
                                                <option value="sliders.create.en" {{($role->hasPermissionTo('sliders.create.en')?"selected":"")}}>
                                                    - Add Slider English
                                                </option>
                                                <option value="sliders.create.ar" {{($role->hasPermissionTo('sliders.create.ar')?"selected":"")}}>
                                                    - Add Slider Arabic
                                                </option>
                                                <option value="sliders.edit.en" {{($role->hasPermissionTo('sliders.edit.en')?"selected":"")}}>
                                                    - Edit Slider English
                                                </option>
                                                <option value="sliders.edit.ar" {{($role->hasPermissionTo('sliders.edit.ar')?"selected":"")}}>
                                                    - Edit Slider Arabic
                                                </option>
                                                <option value="sliders.delete" {{($role->hasPermissionTo('sliders.delete')?"selected":"")}}>
                                                    - Delete Slider
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header">
                                <h3 class="card-title">Pages Permissions</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <select class="duallistbox" multiple="multiple"
                                                    name="permissions[]">

                                                <option value="pages.edit.en" {{($role->hasPermissionTo('pages.edit.en')?"selected":"")}}>
                                                    - Edit Page English
                                                </option>
                                                <option value="pages.edit.ar" {{($role->hasPermissionTo('pages.edit.ar')?"selected":"")}}>
                                                    - Edit Page Arabic
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header">
                                <h3 class="card-title">Setting Permissions</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <select class="duallistbox" multiple="multiple"
                                                    name="permissions[]">

                                                <option value="setting.edit.en" {{($role->hasPermissionTo('setting.edit.en')?"selected":"")}}>
                                                    - Edit Setting English
                                                </option>
                                                <option value="setting.edit.ar" {{($role->hasPermissionTo('setting.edit.ar')?"selected":"")}}>
                                                    - Edit Setting Arabic
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header">
                                <h3 class="card-title">Visa Nationality Permissions</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <select class="duallistbox" multiple="multiple"
                                                    name="permissions[]">
                                                <option value="visa.nationalities.create.en" {{($role->hasPermissionTo('visa.nationalities.create.en')?"selected":"")}}>
                                                    - Add Nationality English
                                                </option>
                                                <option value="visa.nationalities.create.ar" {{($role->hasPermissionTo('visa.nationalities.create.ar')?"selected":"")}}>
                                                    - Add Nationality Arabic
                                                </option>
                                                <option value="visa.nationalities.edit.en" {{($role->hasPermissionTo('visa.nationalities.edit.en')?"selected":"")}}>
                                                    - Edit Nationality English
                                                </option>
                                                <option value="visa.nationalities.edit.ar" {{($role->hasPermissionTo('visa.nationalities.edit.ar')?"selected":"")}}>
                                                    - Edit Nationality Arabic
                                                </option>
                                                <option value="visa.nationalities.delete" {{($role->hasPermissionTo('visa.nationalities.delete')?"selected":"")}}>
                                                    - Delete Nationality
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header">
                                <h3 class="card-title">Visa Type Permissions</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <select class="duallistbox" multiple="multiple"
                                                    name="permissions[]">
                                                <option value="visa.types.create.en" {{($role->hasPermissionTo('visa.types.create.en')?"selected":"")}}>
                                                    - Add Type English
                                                </option>
                                                <option value="visa.types.create.ar" {{($role->hasPermissionTo('visa.types.create.ar')?"selected":"")}}>
                                                    - Add Type Arabic
                                                </option>
                                                <option value="visa.types.edit.en" {{($role->hasPermissionTo('visa.types.edit.en')?"selected":"")}}>
                                                    - Edit Type English
                                                </option>
                                                <option value="visa.types.edit.ar" {{($role->hasPermissionTo('visa.types.edit.ar')?"selected":"")}}>
                                                    - Edit Type Arabic
                                                </option>
                                                <option value="visa.types.delete" {{($role->hasPermissionTo('visa.types.delete')?"selected":"")}}>
                                                    - Delete Type
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header">
                                <h3 class="card-title">Visa Country Permissions</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <select class="duallistbox" multiple="multiple"
                                                    name="permissions[]">
                                                <option value="visa.countries.create.en" {{($role->hasPermissionTo('visa.countries.create.en')?"selected":"")}}>
                                                    - Add Country English
                                                </option>
                                                <option value="visa.countries.create.ar" {{($role->hasPermissionTo('visa.countries.create.ar')?"selected":"")}}>
                                                    - Add Country Arabic
                                                </option>
                                                <option value="visa.countries.edit.en" {{($role->hasPermissionTo('visa.countries.edit.en')?"selected":"")}}>
                                                    - Edit Country English
                                                </option>
                                                <option value="visa.countries.edit.ar" {{($role->hasPermissionTo('visa.countries.edit.ar')?"selected":"")}}>
                                                    - Edit Country Arabic
                                                </option>
                                                <option value="visa.countries.delete" {{($role->hasPermissionTo('visa.countries.delete')?"selected":"")}}>
                                                    - Delete Country
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header">
                                <h3 class="card-title">Visa Outbound Permissions</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <select class="duallistbox" multiple="multiple"
                                                    name="permissions[]">

                                                <option value="visa.nationalities.create.en" {{($role->hasPermissionTo('visa.nationalities.create.en')?"selected":"")}}>
                                                    - Add Outbound English
                                                </option>
                                                <option value="visa.nationalities.create.ar" {{($role->hasPermissionTo('visa.nationalities.create.ar')?"selected":"")}}>
                                                    - Add Outbound Arabic
                                                </option>
                                                <option value="visa.nationalities.edit.en" {{($role->hasPermissionTo('visa.nationalities.edit.en')?"selected":"")}}>
                                                    - Edit Outbound English
                                                </option>
                                                <option value="visa.nationalities.edit.ar" {{($role->hasPermissionTo('visa.nationalities.edit.ar')?"selected":"")}}>
                                                    - Edit Outbound Arabic
                                                </option>
                                                <option value="visa.nationalities.delete" {{($role->hasPermissionTo('visa.nationalities.delete')?"selected":"")}}>
                                                    - Delete Outbound
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header">
                                <h3 class="card-title">Visa UAE Permissions</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <select class="duallistbox" multiple="multiple"
                                                    name="permissions[]">
                                                <option value="visa.uae.create.en" {{($role->hasPermissionTo('visa.uae.create.en')?"selected":"")}}>
                                                    - Add Uae tour English
                                                </option>
                                                <option value="visa.uae.create.ar" {{($role->hasPermissionTo('visa.uae.create.ar')?"selected":"")}}>
                                                    - Add Uae tour Arabic
                                                </option>
                                                <option value="visa.uae.edit.en" {{($role->hasPermissionTo('visa.uae.edit.en')?"selected":"")}}>
                                                    - Edit Uae tour English
                                                </option>
                                                <option value="visa.uae.edit.ar" {{($role->hasPermissionTo('visa.uae.edit.ar')?"selected":"")}}>
                                                    - Edit Uae tour Arabic
                                                </option>
                                                <option value="visa.uae.delete" {{($role->hasPermissionTo('visa.uae.delete')?"selected":"")}}>
                                                    - Delete Uae tour
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header">
                                <h3 class="card-title">Activity Categories Permissions</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <select class="duallistbox" multiple="multiple"
                                                    name="permissions[]">

                                                <option value="activities.categories.create.en" {{($role->hasPermissionTo('activities.categories.create.en')?"selected":"")}}>
                                                    - Add Categories English
                                                </option>
                                                <option value="activities.categories.create.ar" {{($role->hasPermissionTo('activities.categories.create.ar')?"selected":"")}}>
                                                    - Add Categories Arabic
                                                </option>
                                                <option value="activities.categories.edit.en" {{($role->hasPermissionTo('activities.categories.edit.en')?"selected":"")}}>
                                                    - Edit Categories English
                                                </option>
                                                <option value="activities.categories.edit.ar" {{($role->hasPermissionTo('activities.categories.edit.ar')?"selected":"")}}>
                                                    - Edit Categories Arabic
                                                </option>
                                                <option value="activities.categories.delete" {{($role->hasPermissionTo('activities.categories.delete')?"selected":"")}}>
                                                    - Delete Categories
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header">
                                <h3 class="card-title">Activity Countries Permissions</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <select class="duallistbox" multiple="multiple"
                                                    name="permissions[]">

                                                <option value="activities.countries.create.en" {{($role->hasPermissionTo('activities.countries.create.en')?"selected":"")}}>
                                                    - Add Countries English
                                                </option>
                                                <option value="activities.countries.create.ar" {{($role->hasPermissionTo('activities.countries.create.ar')?"selected":"")}}>
                                                    - Add Countries Arabic
                                                </option>
                                                <option value="activities.countries.edit.en" {{($role->hasPermissionTo('activities.countries.edit.ar')?"selected":"")}}>
                                                    - Edit Countries English
                                                </option>
                                                <option value="activities.countries.edit.ar" {{($role->hasPermissionTo('activities.countries.edit.ar')?"selected":"")}}>
                                                    - Edit Countries Arabic
                                                </option>
                                                <option value="activities.countries.delete" {{($role->hasPermissionTo('activities.countries.delete')?"selected":"")}}>
                                                    - Delete Countries
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header">
                                <h3 class="card-title">Activity Cities Permissions</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <select class="duallistbox" multiple="multiple"
                                                    name="permissions[]">

                                                <option value="activities.cities.create.en" {{($role->hasPermissionTo('activities.cities.create.en')?"selected":"")}}>
                                                    - Add Cities English
                                                </option>
                                                <option value="activities.cities.create.ar" {{($role->hasPermissionTo('activities.cities.create.ar')?"selected":"")}}>
                                                    - Add Cities Arabic
                                                </option>
                                                <option value="activities.cities.edit.en" {{($role->hasPermissionTo('activities.cities.edit.ar')?"selected":"")}}>
                                                    - Edit Cities English
                                                </option>
                                                <option value="activities.cities.edit.ar" {{($role->hasPermissionTo('activities.cities.edit.ar')?"selected":"")}}>
                                                    - Edit Cities Arabic
                                                </option>
                                                <option value="activities.cities.delete" {{($role->hasPermissionTo('activities.cities.delete')?"selected":"")}}>
                                                    - Delete Cities
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header">
                                <h3 class="card-title">Activity Steps Permissions</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <select class="duallistbox" multiple="multiple"
                                                    name="permissions[]">

                                                <option value="activities.steps.create.en" {{($role->hasPermissionTo('activities.steps.create.en')?"selected":"")}}>
                                                    - Add Step English
                                                </option>
                                                <option value="activities.steps.create.ar" {{($role->hasPermissionTo('activities.steps.create.ar')?"selected":"")}}>
                                                    - Add Step Arabic
                                                </option>
                                                <option value="activities.steps.edit.en" {{($role->hasPermissionTo('activities.steps.edit.en')?"selected":"")}}>
                                                    - Edit Step English
                                                </option>
                                                <option value="activities.steps.edit.ar" {{($role->hasPermissionTo('activities.steps.edit.ar')?"selected":"")}}>
                                                    - Edit Step Arabic
                                                </option>
                                                <option value="activities.steps.delete" {{($role->hasPermissionTo('activities.steps.delete')?"selected":"")}}>
                                                    - Delete Step
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header">
                                <h3 class="card-title">Activity Tours Permissions</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <select class="duallistbox" multiple="multiple"
                                                    name="permissions[]">

                                                <option value="activities.tours.create.en" {{($role->hasPermissionTo('activities.tours.create.en')?"selected":"")}}>
                                                    - Add Tour English
                                                </option>
                                                <option value="activities.tours.create.ar" {{($role->hasPermissionTo('activities.tours.create.ar')?"selected":"")}}>
                                                    - Add Tour Arabic
                                                </option>
                                                <option value="activities.tours.edit.en" {{($role->hasPermissionTo('activities.tours.edit.en')?"selected":"")}}>
                                                    - Edit Tour English
                                                </option>
                                                <option value="activities.tours.edit.ar" {{($role->hasPermissionTo('activities.tours.edit.ar')?"selected":"")}}>
                                                    - Edit Tour Arabic
                                                </option>
                                                <option value="activities.tours.delete" {{($role->hasPermissionTo('activities.tours.delete')?"selected":"")}}>
                                                    - Delete Tour
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="form-group" style="padding: 15px;" >
                                <input type="submit" class="btn btn-success" value="Save" />
                            </div>
                        </div>
                    </div>

                </form>

            </div>

        </div>
    </section>


@endsection
