@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Enquiry Information</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.enquiries.index')}}">Enquiries</a></li>
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
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input type="text" class="form-control" value="{{$enquiry->enquiry_name()}}"
                                           disabled="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" value="{{$enquiry->enquiry_email()}}"
                                           disabled="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" value="{{$enquiry->enquiry_phone()}}"
                                           disabled="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" value="{{$enquiry->address}}" disabled="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Total cost</label>
                                    <input type="text" class="form-control" value="{{$enquiry->messages}}" disabled="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" value="{{$enquiry->cost}}" disabled="">
                                </div>
                            </div>
                            @if($enquiry->custom == '0')
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Package</label>
                                        <a target="_blank"
                                           href="{{route('details',['symbol' => $enquiry->package->symbol,'hotel' => $enquiry->hotel->symbol])}}">
                                            {{$enquiry->package->name_en}}</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Rooms</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Room</th>
                                    <th>Adult number</th>
                                    <th>Children number</th>
                                    <th>First child age</th>
                                    <th>Second child age</th>
                                    <th>Room cost</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1; ?>
                                @if($enquiry->rooms->count())
                                    @foreach($enquiry->rooms as $room)
                                        <tr>
                                            <td>Room {{$i}}</td>
                                            <td>{{$room->num_adult}}</td>
                                            <td>{{$room->num_child}}</td>
                                            <td>{{$room->age_child_1}}</td>
                                            <td>{{$room->age_child_2}}</td>
                                            <td>{{$room->room_cost}}</td>
                                        </tr>
                                        <?php $i++; ?>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>
                                Tours
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Day</th>
                                    <th>Tour</th>
                                    <th>Number of person</th>
                                    <th>Tour cost</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($enquiry->tours->count())
                                    @foreach($enquiry->tours as $tour)
                                        <tr>
                                            <td>Day {{$tour->number_day}}</td>
                                            <td>{{$room->tour->name_en}}</td>
                                            <td>{{$room->adult_child}}</td>
                                            <td>{{$room->tour_cost}}</td>
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
    @if($enquiry->is_enquiry == 0)
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
                                <p>Transaction ID : {{$enquiry->transaction->transaction_id}}</p>
                                <p>Amount : {{$enquiry->transaction->amount}}</p>
                                <p>Currency : {{$enquiry->transaction->currency}}</p>
                                <p>Payment Status
                                    : {{config('constans.transaction_status_name.'.$enquiry->transaction->payment_status)}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    @endif
@endsection
