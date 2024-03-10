@extends('layouts.app')
@section('content')
    <!-- property area -->
    <div class="content-area home-area-1 recent-property" style="background-color: #FCFCFC; padding: 50px 0;">

        <div class="container">

            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <div class="applicant-section">
                        <h4>{{trans('messages.Summary')}} </h4>
                        <div class="col-md-6 col-xs-12">
                            <p>{{trans('messages.Reference-ID')}}</p>
                            <p>{{$application->reference_id}}</p></div>
                        <div class="col-md-6 col-xs-12">
                            <p>{{trans('messages.Visa-applied-for')}}</p>
                            <p>{{$visa->name}}</p></div>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12">
                    <div class="applicant-section">
                        <h4>{{trans('messages.Payment-Details')}} </h4>
                        <span>
                        <p>{{trans('messages.Visa-fee')}}</p>
                        <p>{{$application->price}}</p>
                    </span>
                    </div>
                </div>
            </div>
            <div class="row m-t-20">
                <div class="col-md-12 col-xs-12">
                    <div class="applicant-section-title text-center">
                        {{trans('messages.Applicant-Details')}}
                    </div>
                </div>
            </div>
            <div class="row m-t-20">
                <div class="col-md-12 col-xs-12">
                    @if(!$application->people->IsEmpty())
                        <table class="applicant-table">
                            <thead>
                            <th>{{trans('messages.First-name')}}</th>
                            <th>{{trans('messages.Middle-name')}}</th>
                            <th>{{trans('messages.Last-name')}}</th>
                            <th>{{trans('messages.Visa-application-date')}}</th>
                            <th></th>
                            </thead>
                            <tbody>
                            @foreach($application->people as $person)
                                <tr>
                                    <td>{{($person->firstName())?$person->firstName()->value:""}}</td>
                                    <td>{{($person->middleName())?$person->middleName()->value:""}}</td>
                                    <td>{{($person->lastName())?$person->lastName()->value:""}}</td>
                                    <td>{{$person->created_at}}</td>
                                    <td></td>

                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
