@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tours ({{$country->name_en}})</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                        <li class="breadcrumb-item active">Tours of {{$country->name_en}}</li>
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
                            @if(Auth::guard('admin')->user()->hasAnyPermission('tours.create.en','tours.create.ar'))
                                <a style="width: max-content"
                                   href="{{route('admin.tours.create',['country' => $country->id])}}"
                                   class="btn btn-block btn-primary btn-sm">Add Tour</a>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Tour Name EN</th>
                                    <th>Tour Name AR</th>
                                    <th>Manage</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($tours)
                                    @foreach($tours as $tour)
                                        <tr>
                                            <td>{{$tour->name_en}}</td>
                                            <td>{{$tour->name_ar}}</td>
                                            <td>
                                                @if(Auth::guard('admin')->user()->hasAnyPermission('tours.edit.en','tours.edit.ar'))
                                                    <a href="{{route('admin.tours.edit', $tour->id)}}"
                                                       class="btn btn-warning">Edit</a>
                                                @endif
                                                @if(Auth::guard('admin')->user()->hasAnyPermission('tours.delete'))
                                                    <form action="{{route('admin.tours.destroy', $tour->id)}}"
                                                          method="post" style="width: 50%;display: inline-block;">
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
                                    <th>Tour Name AR</th>
                                    <th>Tour Name</th>
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
