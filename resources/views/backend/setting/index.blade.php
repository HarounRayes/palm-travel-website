@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Site Settings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                        <li class="breadcrumb-item active">Site Settings</li>
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

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>English Value</th>
                                    <th>Manage</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($settings)
                                    @foreach($settings as $setting)
                                        <tr>
                                            <td>{{$setting->name}}</td>
                                            <td>{{$setting->value_en}}</td>
                                            <td>
                                                <a href="{{route('admin.settings.edit', $setting->id)}}" class="btn btn-warning">Edit</a>
                                            </td>

                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
