@extends('layouts.app')
@section('content')
    <div class="page-head"
     style="background: #494C53;background-image: url({{url('storage/app/public/images/info/'.$visa->image_header)}}) ;
         background-repeat: no-repeat;background-size: cover;background-position: center;">
</div>
<!-- property area -->
<div class="content-area home-area-1 recent-property" style="background-color: #FCFCFC;">
    <div class="container">

        <div id="prop-smlr-visa-details-container">
            <div class="row">
                <h2 class="text-center">
                    <img src="{{url('storage/app/public/images/visa/'.$visa->country->flag)}}"
                         style="width: 100px;"/>
                    {{trans('messages.Application-Form1',['visa' => $visa->name])}}
                </h2>
                <h3 class="text-center">
                    ({{trans(trans('messages.Nationatity1',['nationality' => $visaNationality->nationality->name]))}})
                </h3>
            </div>

            <div id="accordion">
                <form action="{{route('visa.outbound.application.save')}}" method="post" ENCTYPE="MULTIPART/FORM-DATA">
                    @csrf
                    <input type="hidden" name="visa_id" value="{{$visa->id}}"/>
                    <input type="hidden" name="visa_outbound_nationality_id" value="{{$visaNationality->id}}"/>
                    <input type="hidden" name="person_number" value="{{$person}}"/>

                    @for ($i = 1; $i < ($person + 1); $i++)
                        <div class="card">
                            <div class="card-header" id="headingOne-{{$i}}">
                                <h5 class="mb-0 accordion-head">
                                    <button type="button" class="btn btn-link" data-toggle="collapse"
                                            data-target="#collapseOne-{{$i}}" aria-expanded="true"
                                            aria-controls="collapseOne-{{$i}}">
                                        {{str_ordinal($i)}} {{trans('messages.Application')}}

                                    </button>
                                </h5>
                            </div>

                            <div id="collapseOne-{{$i}}" class="collapse" aria-labelledby="headingOne-{{$i}}"
                                 data-parent="#accordion">
                                <div class="card-body">
                                    <div class="application-field-section-1">
                                        @foreach ($visa->requirements() as $requirement)
                                            @if ($requirement->requirement->contact_info == '0' && $requirement->requirement->document== '0')
                                                @include ('frontend.visa.fields.'.$requirement->requirement->type)
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="application-field-section-2"
                                         id="application-field-section-email-{{$i}}">
                                        <div class="prop-smlr-section-title" style="background-color: #004c6c;">
                                            {{trans('messages.Contact-Details')}}
                                        </div>
                                        @foreach ($visa->requirements() as $requirement)
                                            @if ($requirement->requirement->contact_info == '1')
                                                @include ('frontend.visa.fields.'.$requirement->requirement->type)
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="application-field-section-3">
                                        @include ('frontend.visa.fields.file')
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                    <div class="form-group m-t-20">
                        <label>{{trans('messages.Note')}}</label>
                        <textarea class="form-control" name="note" id="note" style="max-width: 100%;"></textarea>
                    </div>
                    <div class="form-group">
                        {!! $visa->note !!}
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="agree" required/>
                        <span>
{{trans('messages.I-have-read-and-agree')}}
</span>
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" value="{{trans('messages.Send-Enquiry')}}"
                               class="btn btn-app-enquiry" name="enquiry"/>
                        <input type="submit" value="{{trans('messages.Submit-and-Proceed')}}"
                               class="btn btn-app-submit" name="submit"/>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
