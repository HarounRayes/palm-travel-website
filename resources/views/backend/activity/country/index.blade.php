@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Activity Countries</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                        <li class="breadcrumb-item active">Activity Countries</li>
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
                                <a style="width: max-content" href="{{route('admin.activitycountries.create')}}"
                                   class="btn btn-block btn-primary btn-sm">Add Country</a>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Country Name EN</th>
                                    <th>Country Name AR</th>
                                    <th></th>
                                    <th></th>
                                    <th>Manage</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($countries)
                                    @foreach($countries as $country)
                                        <tr>
                                            <td>{{$country->name_en}}</td>
                                            <td>{{$country->name_ar}}</td>
                                            <td>
                                                {{--                                                @if(Auth::guard('admin')->user()->hasAnyPermission(['activities.cities.edit.en','activities.cities.edit.ar','activities.cities.create.en','activities.cities.create.ar','activities.cities.delete']))--}}
                                                <a href="{{route('admin.activitycities.index',['country' => $country->id])}}"
                                                   class="btn btn-success">Cities</a>
                                                {{--                                                @endif--}}
                                            </td>
                                            <td>
                                                <a href="{{route('admin.activitytours.index', ['country' => $country->id])}}"
                                                   class="btn btn-info">Tours</a>
                                            </td>
                                            <td>
                                                @if(Auth::guard('admin')->user()->hasAnyPermission(['activities.countries.edit.en','activities.countries.edit.ar']))
                                                    <a href="{{route('admin.activitycountries.edit', $country->id)}}"
                                                       class="btn btn-warning">Edit</a>
                                                @endif


                                                @if(Auth::guard('admin')->user()->hasAnyPermission(['activities.countries.delete']))
                                                    <form
                                                        action="{{route('admin.activitycountries.destroy', $country->id)}}"
                                                        method="post" style="width: 50%;display: inline-block;">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                @endif
                                            </td>
                                            <td>
                                                {{--                                        @if ($country->trashed())--}}
                                                {{--                                            <form action="{{route('admin.activitycountries.restore', ['id'=>$country->id])}}" method="post">--}}
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
                                    <th>Country Name En</th>
                                    <th>Country Name Ar</th>
                                    <th></th>
                                    <th>Manage</th>
                                    <th></th>
                                </tr>
                                </tfoot>
                            </table>
                            <div class="mt-4"></div>
                            {!! $countries->links() !!}
                        </div>

                    </div>
                </div>
            </div>
    </section>

@endsection
