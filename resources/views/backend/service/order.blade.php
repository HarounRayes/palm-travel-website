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
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.packages.index')}}">Packages</a></li>
                    <li class="breadcrumb-item active">Services order</li>
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
                        <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            Orders of Services
                        </h3>

                    </div>
                    <form method="post" action="{{route('admin.services.order.save')}}">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <ul class="todo-list" data-widget="todo-list">
                                @csrf
                                @method('patch')
                                @if ($services)
                                @foreach($services as $service)
                                <li>
                                    <!-- drag handle -->
                                    <span class="handle">
                 <input type="number" name="service[{{$service->id}}]" value="{{$service->service_order}}"
                        class="form-control">
                    </span>
                                    <span class="text">{!! substr($service->text_en, 0, 100) !!}</span>

                                </li>
                                @endforeach
                                @endif
                            </ul>
                        </div>
                        <div class="card-footer">
                            <input type="submit" value="Save" class="btn btn-success"/>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection
