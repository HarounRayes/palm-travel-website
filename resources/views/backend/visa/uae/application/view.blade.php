@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>UAE Application Information</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.visa.uae.application.index')}}">UAE
                                Application</a>
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
                            <h3 class="card-title">Applicated by:
                                ({{($application->member) ? $application->member->name : "--"}})</h3>
                            <div class="card-tools">
                                Applicated by: ({{$application->created_at}})
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Reference ID</label>
                                        <input type="text" class="form-control" disabled=""
                                               value="{{$application->reference_id}}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Person number</label>
                                        <input type="text" class="form-control" disabled=""
                                               value="{{$application->person_number}}">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Type</label>
                                        <input type="text" class="form-control" disabled=""
                                               value="{{$application->type->name_en}}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Nationality</label>
                                        <input type="text" class="form-control" disabled=""
                                               value="{{$application->nationality->name_en}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(!$application->people->isEmpty())
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">People</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="overflow: scroll">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                            <th>#</th>
                                            @foreach($application->visa->requirements_main() as $requirement)
                                                <th>{{$requirement->name_en}}</th>
                                            @endforeach
                                            @foreach($application->visa->requirements_contacts() as $requirement)
                                                <th>{{$requirement->name_en}}</th>
                                            @endforeach
                                            @foreach($application->visa->requirements_documents as $requirement)
                                                <th>{{$requirement->requirement->name_en}}</th>
                                            @endforeach
                                            </thead>
                                            <tbody>
                                            @foreach($application->people as $one)
                                                <tr>
                                                    <td></td>
                                                    @foreach($application->visa->requirements_main() as $requirement)
                                                        @if($requirement->type == 'dropdown')
                                                            <td>{{config('constans.public_variable.'.$requirement->field.'.'.$one->value($requirement->id))}}</td>
                                                        @else
                                                            <td>{{$one->value($requirement->id)}}</td>
                                                        @endif
                                                    @endforeach
                                                    @foreach($application->visa->requirements_contacts() as $requirement)
                                                        <td>
                                                            @if($requirement->type == 'email_address')
                                                                @foreach($one->emails() as $email)
                                                                    <p>{{$email->value}}</p>
                                                                @endforeach
                                                            @elseif($requirement->type == 'code')
                                                                @foreach($one->codes() as $code)
                                                                    <p>{{$code->value}}</p>
                                                                @endforeach
                                                            @elseif($requirement->type == 'mobile_number')
                                                                @foreach($one->mobiles() as $mobile)
                                                                    <p>{{$mobile->value}}</p>
                                                                @endforeach
                                                            @else
                                                                {{$one->value($requirement->id)}}
                                                            @endif
                                                        </td>
                                                    @endforeach
                                                    @foreach($application->visa->requirements_documents as $requirement)
                                                        <td>
                                                            <a href="{{ url('storage/app/public/files/'.$one->value($requirement->requirement->id)) }}"
                                                               target="_blank">{{$one->value($requirement->requirement->id)}}</a>
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            @endif
        </div>
    </section>
    @if($application->is_enquiry == 0)
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
                                <p>Transaction ID : {{$application->transaction->transaction_id}}</p>
                                <p>Amount : {{$application->transaction->amount}}</p>
                                <p>Currency : {{$application->transaction->currency}}</p>
                                <p>Payment Status
                                    : {{config('constans.transaction_status_name.'.$application->transaction->payment_status)}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    @endif
@endsection
