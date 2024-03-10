@extends('backend.layouts.app')

@section('content')

    <!-- Main content -->
    <section class="content" style="padding-top: 30px">
        <div class="container-fluid">

            <div class="row">

                <div class="col-12 col-sm-12">
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="form-group" style="margin: 0">
                            <div class="col-2 col-md-2" style="float: left;padding: 20px;">

                                <h3 style="width: 100%">Activity</h3>
                            </div>
                            <div class="col-2 col-md-2"
                                 style="float: left;padding: 27px 20px;border-right: solid 1px gray;text-align: right">
                                @if($activity->status == '1')
                                    <input id="activity-switch" type="checkbox" name="my-checkbox" checked
                                           data-bootstrap-switch data-off-color="danger"
                                           data-on-color="success"
                                           data-on-value="1" data-off-value="0">
                                @else
                                    <input id="activity-switch" type="checkbox" name="my-checkbox" data-bootstrap-switch
                                           data-off-color="danger" data-on-color="success"
                                           data-on-value="1" data-off-value="0">
                                @endif

                            </div>
                            <div class="col-2 col-md-2" style="float: left;padding: 20px;">

                                <h3 style="width: 100%">Outbound Visa</h3>
                            </div>
                            <div class="col-2 col-md-2"
                                 style="float: left;padding: 27px 20px;border-right: solid 1px gray;text-align: right">
                                @if($outbound_visa->status == '1')
                                    <input id="outbound-visa-switch" type="checkbox" name="my-checkbox" checked
                                           data-bootstrap-switch data-off-color="danger"
                                           data-on-color="success"
                                           data-on-value="1" data-off-value="0">
                                @else
                                    <input id="outbound-visa-switch" type="checkbox" name="my-checkbox" data-bootstrap-switch
                                           data-off-color="danger" data-on-color="success"
                                           data-on-value="1" data-off-value="0">
                                @endif

                            </div>
                            <div class="col-2 col-md-2" style="float: left;padding: 20px">


                                <h3 style="width: 100%">UAE Visa</h3>
                            </div>
                            <div class="col-2 col-md-2" style="float: left;padding: 27px 20px;;text-align: right">
                                @if($uae_visa->status == '1')
                                    <input id="uae-visa-switch" type="checkbox" name="my-checkbox" checked
                                           data-bootstrap-switch data-off-color="danger"
                                           data-on-color="success"
                                           data-on-value="1" data-off-value="0">
                                @else
                                    <input id="uae-visa-switch" type="checkbox" name="my-checkbox" data-bootstrap-switch
                                           data-off-color="danger" data-on-color="success"
                                           data-on-value="1" data-off-value="0">
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>150</h3>

                            <p>New Orders</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>53<sup style="font-size: 20px">%</sup></h3>

                            <p>Bounce Rate</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>44</h3>

                            <p>User Registrations</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>65</h3>

                            <p>Unique Visitors</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!--  ./row -->
        </div>
        <!--  ./container-fluid -->
    </section>
    <!--  ./section -->
@endsection
