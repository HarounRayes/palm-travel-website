@extends('backend.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Packages ({{$country->name_en}})</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.packages.index',['country' , $country->id])}}">Packages</a></li>
                    <li class="breadcrumb-item active">Packages order</li>
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
                            Orders of Packages
                        </h3>

                    </div>
                    <form method="post" action="{{route('admin.packages.order.save')}}">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <ul class="todo-list" data-widget="todo-list">
                                @csrf
                                @method('patch')
                                @if ($packages)
                                @foreach($packages as $package)
                                <li>
                                    <!-- drag handle -->
                                    <span class="handle">
                 <input type="number" name="package[{{$package->id}}]" value="{{$package->package_order}}"
                        class="form-control">
                    </span>

                                    <span class="text">{{$package->name_en}}</span>

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
