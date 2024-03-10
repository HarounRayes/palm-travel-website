@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Countries</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                        <li class="breadcrumb-item active">Countries</li>
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
                            @if(Auth::guard('admin')->user()->hasAnyPermission('countries.create.en','countries.create.ar'))
                                <a style="width: max-content" href="{{route('admin.countries.create')}}"
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
                                    <th>Manage</th>
                                    <th>Add To Home</th>
                                    <th></th>
                                    <th></th>
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
                                                @if(Auth::guard('admin')->user()->hasAnyPermission('countries.edit.en','countries.edit.ar'))
                                                    <a href="{{route('admin.countries.edit', $country->id)}}"
                                                       class="btn btn-warning">Edit</a>
                                                @endif
                                                @if(Auth::guard('admin')->user()->hasAnyPermission('countries.delete'))
                                                    <form action="{{route('admin.countries.destroy', $country->id)}}"
                                                          method="post" style="width: 50%;display: inline-block;">
                                                        @csrf
                                                        @method('delete')

                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                @endif
                                            </td>
                                            <td>
                                                @if($country->add_to_home == '1')
                                                    <input class="main-country-switch" type="checkbox" name="my-checkbox"
                                                           checked
                                                           data-bootstrap-switch data-off-color="danger"
                                                           data-on-color="success" data-id="{{$country->id}}"
                                                           data-on-value="1" data-off-value="0">
                                                @else
                                                    <input class="main-country-switch" type="checkbox" name="my-checkbox"
                                                           data-bootstrap-switch
                                                           data-off-color="danger" data-on-color="success"
                                                           data-on-value="1" data-off-value="0"
                                                           data-id="{{$country->id}}">
                                                @endif
                                            </td>
                                            <td>
                                                @if(Auth::guard('admin')->user()->hasAnyPermission('cities.create.en','cities.create.ar','cities.edit.en','cities.edit.ar','cities.delete'))
                                                    <a class="btn btn-success"
                                                       href="{{route('admin.cities.index', ['country' => $country->id])}}">
                                                        Cities
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                @if(Auth::guard('admin')->user()->hasAnyPermission('tours.create.en','tours.create.ar','tours.edit.en','tours.edit.ar','tours.delete'))
                                                    <a class="btn btn-success"
                                                       href="{{route('admin.tours.index', ['country' => $country->id])}}">
                                                        Tours
                                                    </a>
                                                @endif
                                            </td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Country Name En</th>
                                    <th>Country Name Ar</th>
                                    <th>Manage</th>
                                    <th></th>
                                    <th></th>
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
        </div>
    </section>

@endsection
