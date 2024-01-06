@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{$country->name_en}} Packages</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.packages.index')}}">Countries</a></li>
                        <li class="breadcrumb-item active">{{$country->name_en}} Packages</li>
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

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            @if($packages)
                                @foreach($packages as $package)
                                    <div class="col-md-4" style="float: left">
                                        <!-- Widget: user widget style 1 -->
                                        <div class="card card-widget widget-user">
                                            <!-- Add the bg color to the header using any of the bg-* classes -->
                                            @if(!$package->checkDisableShowPackage())
                                                <label class="label label-expire-danger">expire</label>

                                            @endif
                                            <div class="widget-user-header text-white"
                                                 style="background-image: url({{ url('storage/app/public/images/package/'.$package->image_en) }}); background-size: cover;height: 200px">

                                            </div>
                                            <div class="card-footer" style="padding: 5px 10px">
                                                <div class="row">
                                                    <h3 class="text-center"> {{$package->name_en}}</h3>
                                                </div>
                                                <div class="row">
                                                    @if(Auth::guard('admin')->user()->hasAnyPermission(['packages.edit.ar','packages.edit.en']))
                                                        <div class="col-sm-4 border-right">
                                                            <div class="description-block">
                                                                <a href="{{route('admin.packages.edit',$package->id)}}"
                                                                   class="btn btn-block btn-success btn-sm">Edit</a>
                                                            </div>
                                                            <!-- /.description-block -->
                                                        </div>
                                                    @endif
                                                    <!-- /.col -->
                                                    @if(Auth::guard('admin')->user()->hasAnyPermission(['packages.slider']))
                                                        <div class="col-sm-4 border-right">
                                                            <div class="description-block">
                                                                <a href="{{route('admin.packages.sliders.index' ,['package' => $package->id])}}"
                                                                   class="btn btn-block btn-primary btn-sm">Sliders</a>
                                                            </div>
                                                            <!-- /.description-block -->
                                                        </div>
                                                    @endif
                                                    <!-- /.col -->
                                                    @if(Auth::guard('admin')->user()->hasAnyPermission(['packages.delete']))
                                                        <div class="col-sm-4">
                                                            <div class="description-block">
                                                                <form
                                                                    action="{{route('admin.packages.destroy', $package->id)}}"
                                                                    method="post"
                                                                    style="width: 50%;display: inline-block;">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                                        Delete
                                                                    </button>
                                                                </form>
                                                            </div>
                                                            @endif
                                                            <!-- /.description-block -->
                                                        </div>
                                                        <!-- /.col -->
                                                </div>
                                                <!-- /.row -->
                                                <div class="row" style="padding-top: 10px">
                                                    @if(Auth::guard('admin')->user()->hasAnyPermission(['packages.edit.ar','packages.edit.en']))
                                                        <div class="col-md-6 border-right">
                                                            Active
                                                            @if($package->status == '1')
                                                                <input id="package-switch" class="package-switch"
                                                                       type="checkbox" name="my-checkbox" checked
                                                                       data-bootstrap-switch data-off-color="danger"
                                                                       data-on-color="success"
                                                                       data-id="{{$package->id}}"
                                                                       data-on-value="1" data-off-value="0">
                                                            @else
                                                                <input id="package-switch" class="package-switch"
                                                                       type="checkbox" name="my-checkbox"
                                                                       data-bootstrap-switch
                                                                       data-off-color="danger" data-on-color="success"
                                                                       data-id="{{$package->id}}"
                                                                       data-on-value="1" data-off-value="0">
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6 border-right">
                                                            Featured
                                                            @if($package->is_featured == '1')
                                                                <input id="package-switch-featured" class="package-switch-featured"
                                                                       type="checkbox" name="my-checkbox" checked
                                                                       data-bootstrap-switch data-off-color="danger"
                                                                       data-on-color="success"
                                                                       data-id="{{$package->id}}"
                                                                       data-on-value="1" data-off-value="0">
                                                            @else
                                                                <input id="package-switch-featured" class="package-switch-featured"
                                                                       type="checkbox" name="my-checkbox"
                                                                       data-bootstrap-switch
                                                                       data-off-color="danger" data-on-color="success"
                                                                       data-id="{{$package->id}}"
                                                                       data-on-value="1" data-off-value="0">
                                                            @endif
                                                        </div>
                                                    @endif
                                                    <div class="col-md-6">
                                                        @if($package->draft == '1')
                                                            <label class="label label-danger"
                                                                   style="color:red">Draft</label>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.widget-user -->
                                    </div>
                                @endforeach
                            @endif

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection
