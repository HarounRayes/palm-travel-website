@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Orders</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
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
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Full name</th>
                                    <th>Email</th>
                                    <th>Package</th>
                                    <th>Date</th>
                                    <th>Paid</th>
                                    <th>Manage</th>
                                    <th>Status</th>
                                    <th>Accepted</th>

                                </tr>
                                </thead>
                                <tbody>
                                @if($enquiries)
                                    @foreach($enquiries as $enquiry)
                                        <tr>
                                            <td>{{$enquiry->enquiry_name()}}</td>
                                            <td>{{$enquiry->enquiry_email()}}</td>
                                            @if($enquiry->custom == '0')
                                                <a href="{{route('details',['symbol' => $enquiry->package->symbol,'hotel' => $enquiry->hotel->symbol])}}">
                                                    <td>{{$enquiry->package->name_en}}</td>
                                                </a>
                                            @else
                                                <td><span style="color: #ff5400">Custom</span></td>
                                            @endif
                                            <td>{{$enquiry->created_at}}</td>
                                            <td>
                                                @if($enquiry->is_paid)
                                                    Yes
                                                @else
                                                    No
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{route('admin.orders.show', $enquiry->id)}}"
                                                   class="btn btn-warning">View</a>
                                                <form action="{{route('admin.enquiries.destroy', $enquiry->id)}}"
                                                      method="post" style="width: 50%;display: inline-block;">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                            <td>
                                                @if($enquiry->view == '1')
                                                    <span style="color: #04911a">Viewed</span>
                                                @else
                                                    <span style="color: #911e04">Not Viewed</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($enquiry->accepted == '1')
                                                    <input id="enquiry-switch" class="enquiry-switch" type="checkbox"
                                                           name="my-checkbox" checked
                                                           data-bootstrap-switch data-off-color="danger"
                                                           data-on-color="success" data-id="{{$enquiry->id}}"
                                                           data-on-value="1" data-off-value="0">
                                                @else
                                                    <input id="enquiry-switch" class="enquiry-switch" type="checkbox"
                                                           name="my-checkbox" data-bootstrap-switch
                                                           data-off-color="danger" data-on-color="success"
                                                           data-id="{{$enquiry->id}}"
                                                           data-on-value="1" data-off-value="0">
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>

                            </table>
                            <div class="mt-4"></div>
                            {!! $enquiries->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
