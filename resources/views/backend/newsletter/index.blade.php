@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Newsletter</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                        <li class="breadcrumb-item active">Newsletter</li>
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
                                    <th>Email</th>
                                    <th>Created date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($newsletters)
                                    @foreach($newsletters as $newsletter)
                                        <tr>
                                            <td>{{$newsletter->name}}</td>
                                            <td>{{$newsletter->email}}</td>

                                            <td>{{$newsletter->created_at}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>

                            </table>
                            <div class="mt-4"></div>
                            {!! $newsletters->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
