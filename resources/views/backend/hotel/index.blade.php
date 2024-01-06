@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{$country->name_en}} Hotels</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.hotels.index')}}">Countries</a></li>
                        <li class="breadcrumb-item active">{{$country->name_en}} Hotels</li>
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
                            @if(Auth::guard('admin')->user()->hasAnyPermission(['hotels.create.en','hotels.create.ar']))
                                <a style="width: max-content"
                                   href="{{route('admin.hotels.create' ,['country' => $country->id])}}"
                                   class="btn btn-block btn-primary btn-sm">Add Hotel</a>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Hotel Name EN</th>
                                    <th>Hotel Name AR</th>
                                    <th>Star rate</th>
                                    <th>Manage</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($hotels)
                                    @foreach($hotels as $hotel)
                                        <tr>
                                            <td>{{$hotel->name_en}}</td>
                                            <td>{{$hotel->name_ar}}</td>
                                            <td>{{$hotel->star_rate}}</td>
                                            <td>
                                                @if(Auth::guard('admin')->user()->hasAnyPermission(['hotels.edit.ar','hotels.edit.en']))
                                                    <a href="{{route('admin.hotels.edit', $hotel->id)}}"
                                                       class="btn btn-warning">Edit</a>
                                                @endif
                                                @if(Auth::guard('admin')->user()->hasAnyPermission(['hotels.delete']))
                                                    <form action="{{route('admin.hotels.destroy', $hotel->id)}}"
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
                                    <th>Hotel Name En</th>
                                    <th>Hotel Name Ar</th>
                                    <th>Star rate</th>
                                    <th>Manage</th>
                                    <th></th>
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
