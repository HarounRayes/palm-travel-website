@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Visa Outbounds</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                        <li class="breadcrumb-item active">Visa Outbounds</li>
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
                            @if(Auth::guard('admin')->user()->hasAnyPermission('visa.outbounds.create.en','visa.outbounds.create.ar'))
                                <a style="width: max-content" href="{{route('admin.outbounds.create')}}"
                                   class="btn btn-block btn-primary btn-sm">Add Outbound</a>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Visa Name</th>
                                    <th>Country</th>
                                    <th>Type</th>
                                    <th>Manage</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($outbounds)
                                    @foreach($outbounds as $outbound)
                                        <tr>
                                            <td>{{$outbound->name_en}}</td>
                                            <td>{{$outbound->country->name_en}}</td>
                                            <td>{{$outbound->type->name_en}}</td>
                                            <td>
                                                @if(Auth::guard('admin')->user()->hasAnyPermission('visa.outbounds.edit.en','visa.outbounds.edit.ar'))
                                                    <a href="{{route('admin.outbounds.edit', $outbound->id)}}"
                                                       class="btn btn-warning">Edit</a>
                                                @endif
                                                @if(Auth::guard('admin')->user()->hasAnyPermission('visa.outbounds.delete'))
                                                    <form action="{{route('admin.outbounds.destroy', $outbound->id)}}"
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
                                    <th>Country</th>
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
