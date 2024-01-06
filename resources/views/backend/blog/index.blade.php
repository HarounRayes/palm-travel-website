@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Blogs</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                        <li class="breadcrumb-item active">Blogs</li>
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
                            @if(Auth::guard('admin')->user()->hasAnyPermission('blogs.create.en','blogs.create.ar'))
                                <a style="width: max-content;display:inline-block"
                                   href="{{route('admin.blogs.create')}}" class="btn btn-block btn-primary btn-sm">Add
                                    Blog</a>
                            @endif
                            @if(Auth::guard('admin')->user()->hasAnyPermission('blogs.info','blogs.info'))
                                <a style="width: max-content;display:inline-block" href="{{route('admin.blogs.info')}}"
                                   class="btn btn-success btn-sm">General Information</a>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Name EN</th>
                                    <th>Manage</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($blogs)
                                    @foreach($blogs as $blog)
                                        <tr>
                                            <td>{{$blog->name_en}}</td>
                                            <td>
                                                @if(Auth::guard('admin')->user()->hasAnyPermission('blogs.edit.en','blogs.edit.ar'))
                                                    <a href="{{route('admin.blogs.edit', $blog->id)}}"
                                                       class="btn btn-warning">Edit</a>
                                                @endif
                                                @if(Auth::guard('admin')->user()->hasAnyPermission('blogs.slider'))
                                                    <a href="{{route('admin.blogs.sliders.index', ['blog' => $blog->id])}}"
                                                       class="btn btn-primary">Sliders</a>
                                                @endif
                                                @if(Auth::guard('admin')->user()->hasAnyPermission('blogs.comment'))
                                                    <a href="{{route('admin.blogs.comments.index', ['blog' => $blog->id])}}"
                                                       class="btn btn-success">Comments</a>
                                                @endif
                                                @if(Auth::guard('admin')->user()->hasAnyPermission('blogs.delete'))
                                                    <form action="{{route('admin.blogs.destroy', $blog->id)}}"
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
                                    <th>Manage</th>
                                    <th></th>
                                </tr>
                                </tfoot>
                            </table>
                            <div class="mt-4"></div>
                            {!! $blogs->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
