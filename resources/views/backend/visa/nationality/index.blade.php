@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Visa Nationalities</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                        <li class="breadcrumb-item active">Nationalities</li>
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
                            @if(Auth::guard('admin')->user()->hasAnyPermission('visa.nationalities.create.en','visa.nationalities.create.ar'))
                            <a style="width: max-content" href="{{route('admin.nationalities.create')}}" class="btn btn-block btn-primary btn-sm">Add Nationality</a>
                                @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Nationality Name EN</th>
                                    <th>Nationality Name AR</th>
                                    <th>Manage</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($nationalities)
                                    @foreach($nationalities as $nationality)
                                <tr>
                                    <td>{{$nationality->name_en}}</td>
                                    <td>{{$nationality->name_ar}}</td>
                                    <td>
                                        @if(Auth::guard('admin')->user()->hasAnyPermission('visa.nationalities.edit.en','visa.nationalities.edit.ar'))
                                        <a href="{{route('admin.nationalities.edit', $nationality->id)}}" class="btn btn-warning">Edit</a>
                                        @endif
                                            @if(Auth::guard('admin')->user()->hasAnyPermission('visa.nationalities.delete'))
                                        <form action="{{route('admin.nationalities.destroy', $nationality->id)}}" method="post" style="width: 50%;display: inline-block;">
                                            @csrf
                                            @method('delete')

                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                                @endif
                                    </td>
                                    <td>
{{--                                        @if ($nationality->trashed())--}}
{{--                                            <form action="{{route('admin.nationalities.restore', ['id'=>$nationality->id])}}" method="post">--}}
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
                                    <th>Nationality Name En</th>
                                    <th>Nationality Name Ar</th>
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
