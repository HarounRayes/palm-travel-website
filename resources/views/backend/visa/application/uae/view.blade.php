@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>UAE Application Information</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.visa.uae.application.index')}}">UAE Application</a>
                        </li>
                        <li class="breadcrumb-item active">view</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Applicated by: ({{($application->member) ? $application->member->name : "--"}})</h3>
                            <div class="card-tools">
                                Applicated by: ({{$application->created_at}})
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Reference ID</label>
                                        <input type="text" class="form-control" disabled=""
                                               value="{{$application->reference_id}}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Person number</label>
                                        <input type="text" class="form-control" disabled="" value="{{$application->person_number}}">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Visa</label>
                                        <input type="text" class="form-control" disabled=""
                                               value="{{$application->visa->name_en}}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Nationality</label>
                                        <input type="text" class="form-control" disabled="" value="{{$application->nationality->name_en}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <label>Note</label>
                                        <textarea class="form-control" disabled="">{{$application->note}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(!$application->people->isEmpty())
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">People</h3>
                            </div>
                            <!-- /.card-header -->

                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            @endif
        </div>
    </section>

@endsection
