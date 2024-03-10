@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Visa Countries</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                        <li class="breadcrumb-item active">Visa Countries</li>
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
                            @if(Auth::guard('admin')->user()->hasAnyPermission(['visa.countries.create.en','visa.countries.create.ar']))
                                <a style="width: max-content" href="{{route('admin.visacountries.create')}}"
                                   class="btn btn-block btn-primary btn-sm">Add Country</a>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Country Name</th>
                                    <th>Price</th>
                                    <th>Add to homepage</th>
                                    <th>Manage</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($countries)
                                    @foreach($countries as $country)
                                        <tr>
                                            <td>{{$country->name_en}}</td>
                                            <td>{{$country->price}}</td>
                                            <td>
                                                @if($country->add_to_home == '1')
                                                    <input class="country-switch" type="checkbox" name="my-checkbox"
                                                           checked
                                                           data-bootstrap-switch data-off-color="danger"
                                                           data-on-color="success" data-id="{{$country->id}}"
                                                           data-on-value="1" data-off-value="0">
                                                @else
                                                    <input class="country-switch" type="checkbox" name="my-checkbox"
                                                           data-bootstrap-switch
                                                           data-off-color="danger" data-on-color="success"
                                                           data-on-value="1" data-off-value="0"
                                                           data-id="{{$country->id}}">
                                                @endif
                                            </td>
                                            <td>
                                                @if(Auth::guard('admin')->user()->hasAnyPermission(['visa.countries.edit.en','visa.countries.edit.ar']))
                                                    <a href="{{route('admin.visacountries.edit', $country->id)}}"
                                                       class="btn btn-warning">Edit</a>
                                                @endif
                                                @if(Auth::guard('admin')->user()->hasAnyPermission(['visa.countries.delete']))
                                                    <form
                                                        action="{{route('admin.visacountries.destroy', $country->id)}}"
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

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
