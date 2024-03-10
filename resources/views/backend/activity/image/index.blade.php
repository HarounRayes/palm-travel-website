@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-9">
                    <h1>({{$tour->name_en}}) Images</h1>
                </div>
                <div class="col-sm-3">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                        <li class="breadcrumb-item active">Activity Images</li>
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
                            <a style="width: max-content"
                               href="{{route('admin.images.create',['tour' => $tour->id])}}"
                               class="btn btn-block btn-primary btn-sm">Add Image</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Name EN</th>
                                    <th>Name AR</th>
                                    <th>Manage</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($images)
                                    @foreach($images as $image)
                                        <tr>
                                            <td>{{$image->name_en}}</td>
                                            <td>{{$image->name_ar}}</td>
                                            <td>
                                                <a href="{{route('admin.images.edit', $image->id)}}"
                                                   class="btn btn-warning">Edit</a>

                                                <form action="{{route('admin.images.destroy', $image->id)}}"
                                                      method="post" style="width: 50%;display: inline-block;">
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
                                <tfoot>
                                <tr>
                                    <th>Step Name En</th>
                                    <th>Step Name Ar</th>
                                    <th>Manage</th>
                                    <th></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
    </section>

@endsection
