@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Activity Cities of ({{$country->name_en}})</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                        <li class="breadcrumb-item active">Cities of {{$country->name_en}}</li>
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
                            @if(Auth::guard('admin')->user()->hasAnyPermission(['activities.cities.create.en','activities.cities.create.ar']))
                                <a style="width: max-content"
                                   href="{{route('admin.activitycities.create',['country' => $country->id])}}"
                                   class="btn btn-block btn-primary btn-sm">Add City</a>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>City Name EN</th>
                                    <th>City Name AR</th>
                                    <th>Manage</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($cities)
                                    @foreach($cities as $city)
                                        <tr>
                                            <td>{{$city->name_en}}</td>
                                            <td>{{$city->name_ar}}</td>
                                            <td>
                                                @if(Auth::guard('admin')->user()->hasAnyPermission(['activities.cities.edit.en','activities.cities.edit.ar']))
                                                    <a href="{{route('admin.activitycities.edit', $city->id)}}"
                                                       class="btn btn-warning">Edit</a>
                                                @endif
                                                @if(Auth::guard('admin')->user()->hasAnyPermission(['activities.cities.delete']))
                                                    <form action="{{route('admin.activitycities.destroy', $city->id)}}"
                                                          method="post" style="width: 50%;display: inline-block;">
                                                        @csrf
                                                        @method('delete')

                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                @endif
                                            </td>
                                            <td>
                                                {{--                                        @if ($city->trashed())--}}
                                                {{--                                            <form action="{{route('admin.activitycities.restore', ['id'=>$city->id])}}" method="post">--}}
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
                                    <th>City Name En</th>
                                    <th>City Name Ar</th>
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
