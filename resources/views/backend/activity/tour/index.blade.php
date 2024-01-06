@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Activity Tours</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                        <li class="breadcrumb-item active">Tours</li>
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
                            @if(Auth::guard('admin')->user()->hasAnyPermission(['activities.tours.create.en','activities.tours.create.ar']))
                                <a style="width: max-content" href="{{route('admin.activitytours.create',['country' => request()->country])}}"
                                   class="btn btn-block btn-primary btn-sm">Add Tour</a>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Country</th>
                                    <th>City</th>
                                    <th>Images</th>
                                    <th>Add to home</th>
                                    <th>Manage</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($tours)
                                    @foreach($tours as $tour)
                                        <tr>
                                            <td>{{$tour->name_en}}</td>
                                            <td>{{$tour->country->name_ar}}</td>
                                            <td>{{$tour->city->name_ar}}</td>
                                            <td>    <a href="{{route('admin.images.index', ['tour' => $tour->id])}}"
                                                       class="btn btn-info">Images</a></td>
                                            <td>
                                                @if($tour->add_to_home == '1')
                                                    <input class="activity-tour-switch" type="checkbox" name="my-checkbox"
                                                           checked
                                                           data-bootstrap-switch data-off-color="danger"
                                                           data-on-color="success" data-id="{{$tour->id}}"
                                                           data-on-value="1" data-off-value="0">
                                                @else
                                                    <input class="activity-tour-switch" type="checkbox" name="my-checkbox"
                                                           data-bootstrap-switch
                                                           data-off-color="danger" data-on-color="success"
                                                           data-on-value="1" data-off-value="0"
                                                           data-id="{{$tour->id}}">
                                                @endif
                                            </td>
                                            <td>
                                                @if(Auth::guard('admin')->user()->hasAnyPermission(['activities.tours.edit.en','activities.tours.edit.ar']))
                                                    <a href="{{route('admin.activitytours.edit', $tour->id)}}"
                                                       class="btn btn-warning">Edit</a>
                                                @endif
                                                @if(Auth::guard('admin')->user()->hasAnyPermission(['activities.tours.delete']))
                                                    <form action="{{route('admin.activitytours.destroy', $tour->id)}}"
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

                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
