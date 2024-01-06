@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Activity Categories</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                        <li class="breadcrumb-item active">Activity Categories</li>
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
                            @if(Auth::guard('admin')->user()->hasAnyPermission(['activities.countries.create.en','activities.countries.create.ar']))
                                <a style="width: max-content" href="{{route('admin.activitycategories.create')}}"
                                   class="btn btn-block btn-primary btn-sm">Add Category</a>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Category Name EN</th>
                                    <th>Category Name AR</th>
                                    <th>Manage</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($categories)
                                    @foreach($categories as $category)
                                        <tr>
                                            <td>{{$category->name_en}}</td>
                                            <td>{{$category->name_ar}}</td>
                                            <td>
                                                @if(Auth::guard('admin')->user()->hasAnyPermission(['activities.countries.edit.en','activities.countries.edit.ar']))
                                                    <a href="{{route('admin.activitycategories.edit', $category->id)}}"
                                                       class="btn btn-warning">Edit</a>
                                                @endif
                                                @if(Auth::guard('admin')->user()->hasAnyPermission(['activities.countries.delete']))
                                                    <form
                                                        action="{{route('admin.activitycategories.destroy', $category->id)}}"
                                                        method="post" style="width: 50%;display: inline-block;">
                                                        @csrf
                                                        @method('delete')

                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                @endif
                                            </td>
                                            <td>
{{--                                                @if ($category->trashed())--}}
{{--                                                    <form--}}
{{--                                                        action="{{route('admin.activitycategories.restore', ['id'=>$category->id])}}"--}}
{{--                                                        method="post">--}}
{{--                                                        @csrf--}}
{{--                                                        @method('patch')--}}
{{--                                                        <button type="submit" class="btn btn-default">Restore</button>--}}
{{--                                                    </form>--}}
{{--                                                @endif--}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Category Name En</th>
                                    <th>Category Name Ar</th>
                                    <th>Manage</th>
                                    <th></th>
                                </tr>
                                </tfoot>
                            </table>
                            <div class="mt-4"></div>
                            {!! $categories->links() !!}
                        </div>

                    </div>
                </div>
            </div>
    </section>

@endsection
