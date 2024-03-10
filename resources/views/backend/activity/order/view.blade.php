@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Activity {{$type}} Information</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.activity.order.index')}}">Activity Order</a>
                        </li>
                        <li class="breadcrumb-item active">view</li>
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
                            <h3 class="card-title">Order by: ({{($order->member)?$order->member->name:"--"}})</h3>
                            <div class="card-tools">
                                Order by: ({{$order->created_at}})
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            @if(!$order->card->isEmpty())
                @foreach($order->card as $card)
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Tour: {{$card->activity->name_en}}</h3>
                                    <div class="card-tools">Price: {{$card->price}}</div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Category</th>
                                            <th>Adult</th>
                                            <th>Children</th>
                                            <th>Child 1 age</th>
                                            <th>Child 2 age</th>
                                            <th>Child 3 age</th>
                                            <th>Child 4 age</th>
                                            <th>Child 5 age</th>
                                            <th>Pick up</th>
                                            <th>Drop off</th>
                                            <th>Email</th>
                                            <th>Country code</th>
                                            <th>Mobile</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <tr>
                                            <td>{{$card->category->name_en}}</td>
                                            <td>{{$card->adult}}</td>
                                            <td>{{$card->child}}</td>
                                            <td>{{($card->age_child_1)?$card->age_child_1:"--"}}</td>
                                            <td>{{($card->age_child_2)?$card->age_child_2:"--"}}</td>
                                            <td>{{($card->age_child_3)?$card->age_child_3:"--"}}</td>
                                            <td>{{($card->age_child_4)?$card->age_child_4:"--"}}</td>
                                            <td>{{($card->age_child_5)?$card->age_child_5:"--"}}</td>
                                            <td>{{$card->pick_up}}</td>
                                            <td>{{$card->drop_off}}</td>
                                            <td>{{$card->email}}</td>
                                            <td>{{$card->country_code}}</td>
                                            <td>{{$card->mobile}}</td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                    <!-- /.row -->
                @endforeach
            @endif
        </div>
    </section>

    @if($order->enquiry == 0)
        <!-- Transaction content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Transaction Details</h3>
                            </div>
                                <div class="card-body">
                                    <p>Transaction ID : {{$order->transaction->transaction_id}}</p>
                                    <p>Amount : {{$order->transaction->amount}}</p>
                                    <p>Currency : {{$order->transaction->currency}}</p>
                                    <p>Payment Status : {{config('constans.transaction_status_name.'.$order->transaction->payment_status)}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        </section>
    @endif
@endsection
