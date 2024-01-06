@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Roles</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                        <li class="breadcrumb-item active">Roles</li>
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
                            <a style="width: max-content" href="{{route('admin.roles.create')}}" class="btn btn-block btn-primary btn-sm">Add Role</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Role Name</th>
                                    <th>Manage</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($roles)
                                    @foreach($roles as $role)
                                        <tr>
                                            <td>{{$role->name}}</td>
                                            <td>
                                                <a href="{{route('admin.roles.edit', $role->id)}}" class="btn btn-warning">Edit</a>
                                                <form action="{{route('admin.roles.destroy', $role->id)}}" method="post" style="width: 50%;display: inline-block;">
                                                    @csrf
                                                    @method('delete')

                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                            <td>
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
