@extends('layouts.app')
@section('content')
    @if($visa->nationality->header_image != '')
        <div class="page-head" style="
            background-image: url({{url('storage/app/public/images/visa/'.$visa->nationality->header_image)}});
            background-size: cover;
            background-position: center;">
        </div>
    @else
        <div class="page-head" style="background-color: #b0a579;">
        </div>
    @endif
    <!-- property area -->
    <div class="content-area home-area-1 recent-property" style="background-color: #FCFCFC;padding-top: 20px">
        <div class="container">

            <div id="prop-smlr-visa-details-container">
                <div class="row">
                    <h2 class="text-center">
                        <img src="https://<?= $_SERVER['HTTP_HOST'] ?>/demo/assets/img/uae-flag.png"
                             style="width: 60px;"/>
                        {{trans('messages.Application-Form1')}}
                    </h2>
                    <h3 class="text-center">
                        ({{trans(trans('messages.Nationatity1',['nationality' => $visa->nationality->name]))}}
                        )
                    </h3>
                </div>

                <div id="accordion">
                    <form action="{{route('visa.uae.application.save')}}" method="post" ENCTYPE="MULTIPART/FORM-DATA">
                        @csrf
                        <input type="hidden" name="visa_uae_nationality_type_id" value="{{$visa->id}}"/>
                        <input type="hidden" name="person_number" value="{{$person}}"/>
                        <input type="hidden" name="adult" value="{{$adult}}"/>
                        <input type="hidden" name="child" value="{{$child}}"/>
                        <input type="hidden" name="infant" value="{{$infant}}"/>

                        @for ($i = 1; $i < ($person + 1); $i++)
                            @if($i == 1)
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

                                    <div id="collapseOne-{{$i}}" class="collapse in" aria-labelledby="headingOne-{{$i}}"
                                         data-parent="#accordion" aria-expanded="true">
                                        <div class="card-body">
                                            <div class="application-field-section-1">
                                                @foreach ($visa->requirements_main() as $requirement)
                                                    @include ('frontend.visa.fields.'.$requirement->type)
                                                @endforeach
                                            </div>
                                            <div class="application-field-section-2"
                                                 id="application-field-section-email-{{$i}}">
                                                <div class="prop-smlr-section-title" style="background-color: #1c3d4e;">
                                                    {{trans('messages.Contact-Details')}}
                                                </div>
                                                @foreach ($visa->requirements_contacts() as $requirement)
                                                    @include ('frontend.visa.fields.'.$requirement->type)
                                                @endforeach
                                            </div>
                                            <div class="application-field-section-3">
                                                @include ('frontend.visa.fields.file')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="card">
                                    <div class="card-header" id="headingOne-{{$i}}">
                                        <h5 class="mb-0 accordion-head">
                                            <button type="button" class="btn btn-link collapsed" data-toggle="collapse"
                                                    data-target="#collapseOne-{{$i}}" aria-expanded="false"
                                                    aria-controls="collapseOne-{{$i}}">
                                                {{str_ordinal($i)}} {{trans('messages.Application')}}

                                            </button>
                                        </h5>
                                    </div>

                                    <div id="collapseOne-{{$i}}" class="collapse" aria-labelledby="headingOne-{{$i}}"
                                         data-parent="#accordion" aria-expanded="false">
                                        <div class="card-body">
                                            <div class="application-field-section-1">
                                                @foreach ($visa->requirements_main() as $requirement)
                                                    @include ('frontend.visa.fields.'.$requirement->type)
                                                @endforeach
                                            </div>
                                            <div class="application-field-section-2"
                                                 id="application-field-section-email-{{$i}}">
                                                <div class="prop-smlr-section-title" style="background-color: #1c3d4e;">
                                                    {{trans('messages.Contact-Details')}}
                                                </div>
                                                @foreach ($visa->requirements_contacts() as $requirement)
                                                    @include ('frontend.visa.fields.'.$requirement->type)
                                                @endforeach
                                            </div>
                                            <div class="application-field-section-3">
                                                @include ('frontend.visa.fields.file')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endfor
                        <div class="form-group m-t-20">
                            <h4 style="color: #ce0505">{{trans('messages.Terms And Condition')}}</h4>
                            {!! $visa->term_and_condition !!}
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="agree" required/>
                            <span>
{{trans('messages.I-have-read-and-agree')}}
</span>
                        </div>
                        <div
                            class="form-group {{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">

                            <div class="col-md-12">
                                {!! RecaptchaV3::field('uaevisa') !!}
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <input type="submit" value="{{trans('messages.Send-Enquiry')}}"
                                   class="btn btn-app-enquiry" name="enquiry"/>
                            @if($visa->checkout)
                                <input type="submit" value="{{trans('messages.Submit-and-Proceed')}}"
                                       class="btn btn-app-submit" name="submit_checkout"/>
                            @endif
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
