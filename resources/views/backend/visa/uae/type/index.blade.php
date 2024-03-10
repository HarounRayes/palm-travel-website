@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Visa UAE Types</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                        <li class="breadcrumb-item active">Visa UAE Types</li>
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
                            @if(Auth::guard('admin')->user()->hasAnyPermission(['visa.uaeTypes.create.en','visa.uaeTypes.create.ar']))
                                <a style="width: max-content" href="{{route('admin.uaeTypes.create')}}"
                                   class="btn btn-block btn-primary btn-sm">Add Type</a>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Name EN</th>
                                    <th>Name Ar</th>
                                    <th>Manage</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($types)
                                    @foreach($types as $type)
                                        <tr>
                                            <td>{{$type->name_en}}</td>
                                            <td>{{$type->name_ar}}</td>
                                            <td>
                                                @if($type->add_to_home == '1')
                                                    <input class="visa-type-switch" type="checkbox" name="my-checkbox" checked
                                                           data-bootstrap-switch data-off-color="danger"
                                                           data-on-color="success" data-id="{{$type->id}}"
                                                           data-on-value="1" data-off-value="0">
                                                @else
                                                    <input class="visa-type-switch" type="checkbox" name="my-checkbox"
                                                           data-bootstrap-switch
                                                           data-off-color="danger" data-on-color="success"
                                                           data-on-value="1" data-off-value="0" data-id="{{$type->id}}">
                                                @endif
                                            </td>
                                            <td>
                                                @if(Auth::guard('admin')->user()->hasAnyPermission(['visa.uaeTypes.edit.ar','visa.uaeTypes.edit.en']))
                                                    <a href="{{route('admin.uaeTypes.edit', $type->id)}}"
                                                       class="btn btn-warning">Edit</a>
                                                @endif
                                                @if(Auth::guard('admin')->user()->hasAnyPermission(['visa.uaeTypes.delete']))
                                                    <form action="{{route('admin.uaeTypes.destroy', $type->id)}}"
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
                                    <th>Name En</th>
                                    <th>Name Ar</th>
                                    <th>Manage</th>
                                    <th></th>
                                </tr>
                                </tfoot>
                            </table>
                            <div class="mt-4"></div>
                            {!! $types->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
