@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Activity {{$type}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                        <li class="breadcrumb-item">Activity</li>
                        <li class="breadcrumb-item active">Orders</li>
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
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Member</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($orders)
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{($order->member != null)?$order->member->name:"--"}}</td>
                                            <td>{{$order->created_at}}</td>
                                            <td>{{$order->card->sum('price')}}</td>
                                            @if($order->enquiry == 1)
                                                <td>
                                                    <a href="{{route('admin.activity.enquiry.view', ['id' => $order->id])}}"
                                                       class="btn btn-warning">View</a></td>
                                            @else
                                                <td>
                                                    <a href="{{route('admin.activity.order.view', ['id' => $order->id])}}"
                                                       class="btn btn-warning">View</a></td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            <div class="mt-4"></div>
                            {!! $orders->links() !!}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
