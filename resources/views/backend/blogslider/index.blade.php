@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sliders of ({{$blog->name_en}})</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                        <li class="breadcrumb-item active">Sliders of ({{$blog->name_en}})</li>
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
                               href="{{route('admin.blogs.sliders.create',['blog'=>$blog->id])}}"
                               class="btn btn-block btn-primary btn-sm">Add Slider</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Images EN</th>
                                    <th>Text AR</th>
                                    <th>Manage</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($sliders)
                                    @foreach($sliders as $slider)
                                        <tr>
                                            <td>
                                                <img style="height: 70px;"
                                                     src="{{ url('storage/app/public/images/slider/'.$slider->image_en) }}"/>
                                            </td>
                                            <td>{{$slider->text_en}}</td>
                                            <td>
                                                <a href="{{route('admin.blogs.sliders.edit',['blog' => $slider->blog_id ,'slider' => $slider->id])}}"
                                                   class="btn btn-warning">Edit</a>
                                                <form
                                                    action="{{route('admin.blogs.sliders.destroy',['blog' => $slider->blog_id ,'slider' =>$slider->id])}}"
                                                    method="post" style="width: 50%;display: inline-block;">
                                                    @csrf
                                                    @method('delete')

                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>

                                            <td></td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Image En</th>
                                    <th>Text En</th>
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
