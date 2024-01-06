@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Services</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Services</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            @if(Auth::guard('admin')->user()->hasAnyPermission('services.create.en','services.create.ar'))
                                <a style="width: max-content;display: inline-block" href="{{route('admin.services.create')}}"
                                   class="btn btn-block btn-primary btn-sm">Add Service</a>
                                <a style="width: max-content;display: inline-block" href="{{route('admin.services.order')}}"
                                   class="btn btn-block btn-primary btn-sm">Order Services</a>
                            @endif
                        </div>

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($services)
                                    @foreach($services as $service)
                                        <tr>
                                            <td>{{$service->title_en}}</td>
                                            <td>
                                                @if(Auth::guard('admin')->user()->hasAnyPermission('services.edit.en','services.edit.ar'))
                                                    <a href="{{route('admin.services.edit', $service->id)}}" title="Edit"
                                                       class="btn btn-warning"><i class="fa fa-pen"></i></a>
                                                @endif
                                                @if(Auth::guard('admin')->user()->hasAnyPermission('services.delete'))
                                                    <form action="{{route('admin.services.destroy', $service->id)}}"
                                                          method="post" style="width: 50%;display: inline-block;">
                                                        @csrf
                                                        @method('delete')

                                                        <button type="submit" class="btn btn-danger" title="Delete"><i
                                                                class="fa fa-trash"></i></button>
                                                    </form>
                                                @endif
                                            </td>
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
