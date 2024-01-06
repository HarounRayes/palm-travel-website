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
                        <li class="breadcrumb-item active">Countries of Packages</li>
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
                            @if(Auth::guard('admin')->user()->hasAnyPermission(['countries.order']))
                                <a style="width: max-content" href="{{route('admin.countries.order')}}"
                                   class="btn btn-block btn-primary btn-sm">Order Countries</a>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Country Name EN</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($countries)
                                    @foreach($countries as $country)
                                        <tr>
                                            <td>{{$country->name_en}}</td>
                                            <td>
                                                @if(Auth::guard('admin')->user()->hasAnyPermission(['packages.edit.ar','packages.edit.en','packages.delete','packages.slider']))
                                                <a class="btn btn-success"
                                                   href="{{route('admin.packages.index', ['country' => $country->id])}}">
                                                    Packages
                                                </a>
                                                @endif
                                                @if(Auth::guard('admin')->user()->hasAnyPermission(['packages.order']))
                                                    <a class="btn btn-warning"
                                                       href="{{route('admin.packages.order', ['country' => $country->id])}}">
                                                        Order Packages
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
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
