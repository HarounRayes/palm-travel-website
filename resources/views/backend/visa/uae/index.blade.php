@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Visa UAE</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                        <li class="breadcrumb-item active">Visa UAE</li>
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
                            @if(Auth::guard('admin')->user()->hasAnyPermission(['visa.uae.create.en','visa.uae.create.ar']))
                                <a style="width: max-content" href="{{route('admin.uaes.create')}}"
                                   class="btn btn-block btn-primary btn-sm">Add UAE Visa</a>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Visa Name</th>
                                    <th>Type</th>
                                    <th>Manage</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($uaes)
                                    @foreach($uaes as $uae)
                                        <tr>
                                            <td>{{$uae->name_en}}</td>
                                            <td>{{$uae->type->name_en}}</td>
                                            <td>
                                                @if(Auth::guard('admin')->user()->hasAnyPermission(['visa.uae.edit.en','visa.uae.edit.ar']))
                                                    <a href="{{route('admin.uaes.edit', $uae->id)}}"
                                                       class="btn btn-warning">Edit</a>
                                                @endif
                                                @if(Auth::guard('admin')->user()->hasAnyPermission(['visa.uae.delete']))
                                                    <form action="{{route('admin.uaes.destroy', $uae->id)}}"
                                                          method="post"
                                                          style="width: 50%;display: inline-block;">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                @endif
                                            </td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Visa Name</th>
                                    <th>Type</th>
                                    <th>Manage</th>
                                    <th></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
