@extends('backend.layouts.app')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Role </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.roles.index')}}">Roles</a></li>
                        <li class="breadcrumb-item active">Add Role</li>
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
                <form id="demo-form2" method="POST" action="{{ route('admin.roles.store') }}"
                      enctype="multipart/form-data" style="width: 100%">
                    @csrf
                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Name <span class="required">*</span></label>
                                    <input type="text" name="name" class="form-control"
                                           value="{{old('name')}}">
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
                                                <option value="packages.create.en">
                                                    - Add Package English
                                                </option>
                                                <option value="packages.create.ar">
                                                    - Add Package Arabic
                                                </option>
                                                <option value="packages.edit.en">
                                                    - Edit Package English
                                                </option>
                                                <option value="packages.edit.ar">
                                                    - Edit Package Arabic
                                                </option>
                                                <option value="packages.delete">
                                                    - Delete Package
                                                </option>
                                                <option value="packages.order">
                                                    - Order Package
                                                </option>
                                                <option value="packages.slider">
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
                                                <option value="hotels.create.en">
                                                    - Add Hotel English
                                                </option>
                                                <option value="hotels.create.ar">
                                                    - Add Hotel Arabic
                                                </option>
                                                <option value="hotels.edit.en">
                                                    - Edit Hotel English
                                                </option>
                                                <option value="hotels.edit.ar">
                                                    - Edit Hotel Arabic
                                                </option>
                                                <option value="hotels.delete">
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
                                                <option value="countries.create.en">
                                                    - Add Country English
                                                </option>
                                                <option value="countries.create.ar">
                                                    - Add Country Arabic
                                                </option>
                                                <option value="countries.edit.en">
                                                    - Edit Country English
                                                </option>
                                                <option value="countries.edit.ar">
                                                    - Edit Country Arabic
                                                </option>
                                                <option value="countries.delete">
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
                                                <option value="cities.create.en">
                                                    - Add City English
                                                </option>
                                                <option value="cities.create.ar">
                                                    - Add City Arabic
                                                </option>
                                                <option value="cities.edit.en">
                                                    - Edit City English
                                                </option>
                                                <option value="cities.edit.ar">
                                                    - Edit City Arabic
                                                </option>
                                                <option value="cities.delete">
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
                                                <option value="tours.create.en">
                                                    - Add Tour English
                                                </option>
                                                <option value="tours.create.ar">
                                                    - Add Tour Arabic
                                                </option>
                                                <option value="tours.edit.en">
                                                    - Edit Tour English
                                                </option>
                                                <option value="tours.edit.ar">
                                                    - Edit Tour Arabic
                                                </option>
                                                <option value="tours.delete">
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
                                                <option value="blogs.create.en">
                                                    - Add Blog English
                                                </option>
                                                <option value="blogs.create.ar">
                                                    - Add Blog Arabic
                                                </option>
                                                <option value="blogs.edit.en">
                                                    - Edit Blog English
                                                </option>
                                                <option value="blogs.edit.ar">
                                                    - Edit Blog Arabic
                                                </option>
                                                <option value="blogs.delete">
                                                    - Delete Blog
                                                </option>
                                                <option value="blogs.info">
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
                                                <option value="sliders.create.en">
                                                    - Add Slider English
                                                </option>
                                                <option value="sliders.create.ar">
                                                    - Add Slider Arabic
                                                </option>
                                                <option value="sliders.edit.en">
                                                    - Edit Slider English
                                                </option>
                                                <option value="sliders.edit.ar">
                                                    - Edit Slider Arabic
                                                </option>
                                                <option value="sliders.delete">
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

                                                <option value="pages.edit.en">
                                                    - Edit Page English
                                                </option>
                                                <option value="pages.edit.ar">
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

                                                <option value="setting.edit.en">
                                                    - Edit Setting English
                                                </option>
                                                <option value="setting.edit.ar">
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
                                                <option value="sliders.create.en">
                                                    - Add Nationality English
                                                </option>
                                                <option value="sliders.create.ar">
                                                    - Add Nationality Arabic
                                                </option>
                                                <option value="sliders.edit.en">
                                                    - Edit Nationality English
                                                </option>
                                                <option value="sliders.edit.ar">
                                                    - Edit Nationality Arabic
                                                </option>
                                                <option value="sliders.delete">
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
                                                <option value="visa.types.create.en">
                                                    - Add Type English
                                                </option>
                                                <option value="visa.types.create.ar">
                                                    - Add Type Arabic
                                                </option>
                                                <option value="visa.types.edit.en">
                                                    - Edit Type English
                                                </option>
                                                <option value="visa.types.edit.ar">
                                                    - Edit Type Arabic
                                                </option>
                                                <option value="visa.types.delete">
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
                                                <option value="visa.countries.create.en">
                                                    - Add Country English
                                                </option>
                                                <option value="visa.countries.create.ar">
                                                    - Add Country Arabic
                                                </option>
                                                <option value="visa.countries.edit.en">
                                                    - Edit Country English
                                                </option>
                                                <option value="visa.countries.edit.ar">
                                                    - Edit Country Arabic
                                                </option>
                                                <option value="visa.countries.delete">
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

                                                <option value="visa.nationalities.create.en">
                                                    - Add Outbound English
                                                </option>
                                                <option value="visa.nationalities.create.ar">
                                                    - Add Outbound Arabic
                                                </option>
                                                <option value="visa.nationalities.edit.en">
                                                    - Edit Outbound English
                                                </option>
                                                <option value="visa.nationalities.edit.ar">
                                                    - Edit Outbound Arabic
                                                </option>
                                                <option value="visa.nationalities.delete">
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
                                                <option value="visa.uae.create.en">
                                                    - Add Uae tour English
                                                </option>
                                                <option value="visa.uae.create.ar">
                                                    - Add Uae tour Arabic
                                                </option>
                                                <option value="visa.uae.edit.en">
                                                    - Edit Uae tour English
                                                </option>
                                                <option value="visa.uae.edit.ar">
                                                    - Edit Uae tour Arabic
                                                </option>
                                                <option value="visa.uae.delete">
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

                                                <option value="activities.categories.create.en">
                                                    - Add Categories English
                                                </option>
                                                <option value="activities.categories.create.ar">
                                                    - Add Categories Arabic
                                                </option>
                                                <option value="activities.categories.edit.en">
                                                    - Edit Categories English
                                                </option>
                                                <option value="activities.categories.edit.ar">
                                                    - Edit Categories Arabic
                                                </option>
                                                <option value="activities.categories.delete">
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

                                                <option value="activities.countries.create.en">
                                                    - Add Countries English
                                                </option>
                                                <option value="activities.countries.create.ar">
                                                    - Add Countries Arabic
                                                </option>
                                                <option value="activities.countries.edit.en">
                                                    - Edit Countries English
                                                </option>
                                                <option value="activities.countries.edit.ar">
                                                    - Edit Countries Arabic
                                                </option>
                                                <option value="activities.countries.delete">
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

                                                <option value="activities.cities.create.en">
                                                    - Add Cities English
                                                </option>
                                                <option value="activities.cities.create.ar">
                                                    - Add Cities Arabic
                                                </option>
                                                <option value="activities.cities.edit.en">
                                                    - Edit Cities English
                                                </option>
                                                <option value="activities.cities.edit.ar">
                                                    - Edit Cities Arabic
                                                </option>
                                                <option value="activities.cities.delete">
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

                                                <option value="activities.steps.create.en">
                                                    - Add Step English
                                                </option>
                                                <option value="activities.steps.create.ar">
                                                    - Add Step Arabic
                                                </option>
                                                <option value="activities.steps.edit.en">
                                                    - Edit Step English
                                                </option>
                                                <option value="activities.steps.edit.ar">
                                                    - Edit Step Arabic
                                                </option>
                                                <option value="activities.steps.delete">
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

                                                <option value="activities.tours.create.en">
                                                    - Add Tour English
                                                </option>
                                                <option value="activities.tours.create.ar">
                                                    - Add Tour Arabic
                                                </option>
                                                <option value="activities.tours.edit.en">
                                                    - Edit Tour English
                                                </option>
                                                <option value="activities.tours.edit.ar">
                                                    - Edit Tour Arabic
                                                </option>
                                                <option value="activities.tours.delete">
                                                    - Delete Tour
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
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
