@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Visa UAE Requirements</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                        <li class="breadcrumb-item active">Visa UAE Requirements</li>
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
                            @if(Auth::guard('admin')->user()->hasAnyPermission(['visa.uaeRequirements.create.en','visa.uaeRequirements.create.ar']))
                                <a style="width: max-content" href="{{route('admin.uaeRequirements.create')}}"
                                   class="btn btn-block btn-primary btn-sm">Add Requirement</a>
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
                                </tr>
                                </thead>
                                <tbody>
                                @if($requirements)
                                    @foreach($requirements as $requirement)
                                        <tr>
                                            <td>{{$requirement->name_en}}</td>
                                            <td>{{$requirement->name_ar}}</td>
                                            <td>
                                                @if(Auth::guard('admin')->user()->hasAnyPermission(['visa.uaeRequirements.edit.ar','visa.uaeRequirements.edit.en']))
                                                    <a href="{{route('admin.uaeRequirements.edit', $requirement->id)}}"
                                                       class="btn btn-warning">Edit</a>
                                                @endif
                                                @if(Auth::guard('admin')->user()->hasAnyPermission(['visa.uaeRequirements.delete']))
                                                    <form action="{{route('admin.uaeRequirements.destroy', $requirement->id)}}"
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
                            {!! $requirements->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
