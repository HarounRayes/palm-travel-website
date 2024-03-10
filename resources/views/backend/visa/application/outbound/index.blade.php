@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Outbound Visa Application</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                        <li class="breadcrumb-item">Visa Application</li>
                        <li class="breadcrumb-item active">Outbound</li>
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
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Reference ID</th>
                                    <th>Member</th>
                                    <th>Nationality</th>
                                    <th>Visa</th>
                                    <th>People</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Type</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($applications)
                                    @foreach($applications as $application)
                                        <tr>
                                            <td>{{$application->reference_id}}</td>
                                            <td>{{$application->member->name}}</td>
                                            <td>{{$application->nationality->name_en}}</td>
                                            <td>{{$application->visa->name_en}}</td>
                                            <td>{{$application->people->count()}}</td>
                                            <td>{{$application->created_at}}</td>
                                            <td>{{$application->price}}</td>
                                            <td>{{($application->is_enquiry)?"Enquiry":"Paid"}}</td>
                                            <td>
                                                <a href="{{route('admin.visa.outbound.application.view', ['id' => $application->id])}}"
                                                   class="btn btn-warning">View</a></td>
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
