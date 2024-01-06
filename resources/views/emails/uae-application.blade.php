<div class="col-md-12 col-xs-12 col-sm-12">
    <h1>UAE Visa Application from Palmoasis Holidays</h1>
    <div class="form-group">
        <label class="control-label col-md-2 col-sm-3 col-xs-4">
            Reference ID:
        </label>
        <label class="control-label col-md-2 col-sm-3 col-xs-4">
            {{$application->reference_id}}
        </label>
    </div>
    <div class="form-group">
        <label class="control-label col-md-2 col-sm-3 col-xs-4">
            Visa Nationality:
        </label>
        <label class="control-label col-md-2 col-sm-3 col-xs-4">
            {{$application->nationality->name_en}}
        </label>
    </div>
    <div class="form-group">
        <label class="control-label col-md-2 col-sm-3 col-xs-4">
            Application Reference:
        </label>
        <label class="control-label col-md-2 col-sm-3 col-xs-4">
            {{$application->reference_id}}
        </label>
    </div>
    <div class="form-group">
        <label class="control-label col-md-2 col-sm-3 col-xs-4">
            Total Price:
        </label>
        <label class="control-label col-md-2 col-sm-3 col-xs-4">
            {{$application->price}}
        </label>
    </div>
    <div class="form-group">
        <label class="control-label col-md-2 col-sm-3 col-xs-4">
            Number of Person:
        </label>
        <label class="control-label col-md-2 col-sm-3 col-xs-4">
            {{$application->person_number}}
        </label>
    </div>
    @if(!$application->people->IsEmpty())

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
                                    <th style="border: solid 2px #656d75">#</th>
                                    @foreach($application->visa->requirements_main() as $requirement)
                                        <th style="border: solid 2px #656d75">{{$requirement->name_en}}</th>
                                    @endforeach
                                    @foreach($application->visa->requirements_contacts() as $requirement)
                                        <th style="border: solid 2px #656d75">{{$requirement->name_en}}</th>
                                    @endforeach

                                    </thead>
                                    <tbody>
                                    @foreach($application->people as $one)
                                        <tr>
                                            <td style="border: solid 1px #656d75"></td>
                                            @foreach($application->visa->requirements_main() as $requirement)
                                                @if($requirement->type == 'dropdown')
                                                    <td style="border: solid 1px #656d75">{{config('constans.public_variable.'.$requirement->field.'.'.$one->value($requirement->id))}}</td>
                                                @else
                                                    <td style="border: solid 1px #656d75">{{$one->value($requirement->id)}}</td>
                                                @endif
                                            @endforeach
                                            @foreach($application->visa->requirements_contacts() as $requirement)
                                                <td style="border: solid 1px #656d75">
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

    @endif
</div>
