@extends('backend.layouts.app')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Setting ({{$setting->title_en}})</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.settings.index')}}">
                                Settings
                            </a></li>
                        <li class="breadcrumb-item active">Edit</li>
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
                <form id="demo-form2" method="POST" action="{{ route('admin.settings.update', $setting->id) }}"
                      enctype="multipart/form-data" style="width: 100%">
                    @csrf
                    @method('patch')

                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header p-0 border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
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
                                </ul>
                            </div>
                            <div class="card-body">

                                <div class="tab-content" id="custom-tabs-four-tabContent">

                                    <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel"
                                         aria-labelledby="custom-tabs-four-home-tab">
                                        <div class="col-md-8">

                                            <div class="form-group">
                                                <label>Font Family</label>

                                                <select name="value_en" class="form-control" required>
                                                    <option value="">
                                                        Select font family
                                                    </option>
                                                    @if ($setting->value_en == '1')
                                                        <option value="1" selected>DroidKufi</option>
                                                    @else
                                                        <option value="1">DroidKufi</option>
                                                    @endif
                                                    @if ($setting->value_en == '2')
                                                        <option value="2" selected>Cairo</option>
                                                    @else
                                                        <option value="2">Cairo</option>
                                                    @endif
                                                    @if ($setting->value_en == '3')
                                                        <option value="3" selected>Gess</option>
                                                    @else
                                                        <option value="3">Gess</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="custom-tabs-four-profile" role="tabpanel"
                                         aria-labelledby="custom-tabs-four-home-tab">
                                        <div class="col-md-4" style="float: left;height: 100px"></div>
                                        <div class="col-md-8" style="direction: rtl;text-align: right;float: left">

                                            <div class="form-group">
                                                <label>الخط</label>
                                                <select name="value_ar" class="form-control" required>
                                                    <option value="" >
                                                       اختر نوع الخط
                                                    </option>
                                                    @if ($setting->value_ar == '1')
                                                        <option value="1" selected>DroidKufi</option>
                                                    @else
                                                        <option value="1">DroidKufi</option>
                                                    @endif
                                                    @if ($setting->value_ar == '2')
                                                        <option value="2" selected>Cairo</option>
                                                    @else
                                                        <option value="2">Cairo</option>
                                                    @endif
                                                    @if ($setting->value_ar == '3')
                                                        <option value="3" selected>Gess</option>
                                                    @else
                                                        <option value="3">Gess</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                    </div>
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
