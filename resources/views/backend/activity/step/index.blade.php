@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Activity Steps</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                        <li class="breadcrumb-item active">Activity Steps</li>
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
                            @if(Auth::guard('admin')->user()->hasAnyPermission(['activities.steps.create.en','activities.steps.create.ar']))
                            <a style="width: max-content" href="{{route('admin.steps.create')}}" class="btn btn-block btn-primary btn-sm">Add Step</a>
                                @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Step Name EN</th>
                                    <th>Step Name AR</th>
                                    <th>Manage</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($steps)
                                    @foreach($steps as $step)
                                <tr>
                                    <td>{{$step->name_en}}</td>
                                    <td>{{$step->name_ar}}</td>
                                    <td>
                                        @if(Auth::guard('admin')->user()->hasAnyPermission(['activities.steps.edit.en','activities.steps.edit.ar']))
                                        <a href="{{route('admin.steps.edit', $step->id)}}" class="btn btn-warning">Edit</a>
                                        @endif
                                            @if(Auth::guard('admin')->user()->hasAnyPermission(['activities.steps.delete']))
                                        <form action="{{route('admin.steps.destroy', $step->id)}}" method="post" style="width: 50%;display: inline-block;">
                                            @csrf
                                            @method('delete')

                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                                @endif
                                    </td>
                                    <td>
{{--                                        @if ($step->trashed())--}}
{{--                                            <form action="{{route('admin.steps.restore', ['id'=>$step->id])}}" method="post">--}}
{{--                                                @csrf--}}
{{--                                                @method('patch')--}}
{{--                                                <button type="submit" class="btn btn-default">Restore</button>--}}
{{--                                            </form>--}}
{{--                                            @endif--}}
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
                            <div class="mt-4"></div>
                            {!! $steps->links() !!}
                        </div>

                </div>
            </div>
        </div>
    </section>

    @endsection
