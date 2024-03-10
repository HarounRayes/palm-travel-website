@extends('backend.layouts.app')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit UAE Visa Requirements & Nationalties </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Edit UAE Config</li>
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
                <form id="demo-form2" method="POST" action="{{ route('admin.uaes.config.save') }}"
                      enctype="multipart/form-data" style="width: 100%">
                    @csrf
                    @method('patch')
                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header">
                                <h3 class="card-title">UAE Nationalities</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            @if ($nationalities)
                                                <label>Multiple</label>
                                                <select class="duallistbox" multiple="multiple" name="nationalities[]">
                                                    @foreach($nationalities as $nationality)
                                                        @if(in_array($nationality->id,$nationalitiesIDs))
                                                            <option selected value="{{$nationality->id}}">
                                                                - {{$nationality->name_en}}
                                                            </option>
                                                        @else
                                                            <option value="{{$nationality->id}}">
                                                                - {{$nationality->name_en}}
                                                            </option>
                                                        @endif

                                                    @endforeach
                                                </select>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header">
                                <h3 class="card-title">Country Requirements</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            @if ($requirements)
                                                <label>Multiple</label>
                                                <select class="duallistbox" multiple="multiple" name="requirements[]">
                                                    @foreach($requirements as $requirement)
                                                        @if(in_array($requirement->id,$requirementsIDs))
                                                            <option selected value="{{$requirement->id}}">
                                                                - {{$requirement->name_en}}
                                                            </option>
                                                        @else
                                                            <option value="{{$requirement->id}}">
                                                                - {{$requirement->name_en}}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            @endif
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
