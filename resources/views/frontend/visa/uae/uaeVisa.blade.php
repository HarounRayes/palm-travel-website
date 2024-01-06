@extends('layouts.app')
@section('content')
    @if($visa_uae_nationality_types && $visa_uae_nationality_types->nationality->header_image != '')
        <div class="page-head" style="
            background-image: url({{url('storage/app/public/images/visa/'.$visa_uae_nationality_types->nationality->header_image)}});
            background-size: cover;
            background-position: center;">
        </div>
    @elseif($info->header_image != '')
        <div class="page-head" style="
            background-image: url({{url('storage/app/public/images/info/'.$info->header_image)}});
            background-size: cover;
            background-position: center;">
        </div>
    @else
        <div class="page-head" style="background-color: #b0a579;">
        </div>
    @endif
    <!-- property area -->
    <div class="content-area home-area-1 recent-property" style="background-color: #FCFCFC; padding-bottom: 55px;">
        <div class="container">
            @include('frontend.visa.uae.visaUaeSearchBox')
            <div class="row">
                <div class="col-md-12 col-sm-12 text-center page-title page-title-home p-b-15">
                    {!! $info->intro !!}
                </div>
            </div>
            <div class="row">
                <div class="proerty-th">
                    @if(!$visa_uae_nationality_types)
                        <div class="similar-post-section padding-top-15 text-center">
                            <i class="fab fa-bell-slash attention-icon"></i>
                        </div>
                        <div class="similar-post-section padding-top-40 text-center">
                            <div class="attention-text">
                                {!! $nationality->text !!}
                            </div>
                        </div>
                    @else
                            <div class="similar-post-section">

                                <div class="col-md-9 col-sm-8 col-xs-12">
                                    <div id="prop-smlr-visa-details-container" style="padding-top: 30px">
                                        <table class="table table-responsive p-b-15 custom-table">
                                            <thead>
                                            <tr class="table-head-1">
                                                <th class="text-center"
                                                    colspan="2">{{trans('messages.Uae Visa')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="row" class="table-cell-blue table-cel-middle-center"
                                                    style="width: 20%">
                                                    {{trans('messages.Documents-Required')}}
                                                </th>
                                                <td>
                                                    @if(!$visa_uae_nationality_types->requirements->isEmpty())
                                                        <ul>
                                                            @foreach($visa_uae_nationality_types->requirements as $requirement)
                                                                <li>{{$requirement->requirement->name}}</li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <table class="table table-responsive p-b-15 custom-table">
                                            <thead>
                                            <tr class="table-head-2">
                                                <th colspan="3" class="text-center">
                                                    {{trans('messages.visa-fees')}}
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td class="table-cel-middle-center" style="width: 20%">
                                                    <b>{{trans('messages.processing-time')}}</b>
                                                </td>
                                                <td colspan="2">{!! $visa_uae_nationality_types->processing_time !!}</td>

                                            </tr>
                                            <tr>
                                                <td class="table-cel-middle-center">
                                                    <b>{{trans('messages.visa-validity')}}</b>
                                                </td>
                                                <td colspan="2">{!! $visa_uae_nationality_types->visa_validity !!}</td>
                                            </tr>
                                            <tr>
                                                <td class="table-cel-middle-center">
                                                    <b>{{trans('messages.stay-validity')}}</b>
                                                </td>
                                                <td colspan="2">{!! $visa_uae_nationality_types->stay_validity !!}</td>
                                            </tr>
                                            <tr>
                                                <td class="table-cel-middle-center" rowspan="4">
                                                    <b> {{trans('messages.Visa-fee')}}</b>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="table-cel-middle-center">
                                                    {{trans('messages.per-adult')}}
                                                </td>
                                                <td class="table-cel-middle-center">
                                                                 <span id='visa-price-view'>
                                         {{$visa_uae_nationality_types->adult_price}}
                                                </span>
                                                    {{trans('messages.this_currency')}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="table-cel-middle-center">
                                                    {{trans('messages.per-child')}}
                                                </td>
                                                <td class="table-cel-middle-center">
                                                          <span id='visa-price-view'>
                                         {{$visa_uae_nationality_types->child_price}}
                                                </span>{{trans('messages.this_currency')}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="table-cel-middle-center">
                                                    {{trans('messages.per-infant')}}
                                                </td>
                                                <td class="table-cel-middle-center">
                                                     <span id='visa-price-view'>
                                         {{$visa_uae_nationality_types->infant_price}}
                                                </span> {{trans('messages.this_currency')}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <form method="post" action="{{route('visa.uae.application')}}">
                                                    @csrf
                                                    <input type="hidden" name="nationality_type_id" value="{{$visa_uae_nationality_types->id}}">
                                                    <td colspan="3">
                                                        <div class="row">
                                                            <div class="col-xs-6">
                                                                <div class="row p-b-15">
                                                                    <div
                                                                        class="col-xs-6 text-en-right text-ar-left p-t-10">
                                                                        {{trans('messages.No-of-Adult')}}
                                                                    </div>
                                                                    <div class="col-xs-6 text-ar-right text-en-left">
                                                                        <select id="adult" class="selectpicker"
                                                                                data-live-search-style="begins"
                                                                                onchange="VisaCost({{$visa_uae_nationality_types->id}})"
                                                                                required>
                                                                            @for($i = 1 ;$i<4 ;$i++)
                                                                                <option value="{{$i}}">{{$i}}</option>
                                                                            @endfor
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row p-b-15">
                                                                    <div
                                                                        class="col-xs-6 text-en-right text-ar-left p-t-10">
                                                                        {{trans('messages.No-of-Child')}}
                                                                    </div>
                                                                    <div class="col-xs-6 text-ar-right text-en-left">
                                                                        <select id="child" class="selectpicker"
                                                                                data-live-search-style="begins"
                                                                                 required
                                                                                onchange="VisaCost({{$visa_uae_nationality_types->id}})">
                                                                            @for($i = 0 ;$i<4 ;$i++)
                                                                                <option value="{{$i}}">{{$i}}</option>
                                                                            @endfor
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row p-b-15">
                                                                    <div
                                                                        class="col-xs-6 text-en-right text-ar-left p-t-10">
                                                                        {{trans('messages.No-of-Infant')}}
                                                                    </div>
                                                                    <div class="col-xs-6 text-ar-right text-en-left">
                                                                        <select id="infant" class="selectpicker"
                                                                                data-live-search-style="begins"
                                                                                onchange="VisaCost({{$visa_uae_nationality_types->id}})"
                                                                                 required>
                                                                            @for($i = 0 ;$i<4 ;$i++)
                                                                                <option value="{{$i}}">{{$i}}</option>
                                                                            @endfor
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6">
                                                                <div class="col-xs-12 visa-price-section">
                                                                    <p>{{trans('messages.total-price-of')}}<span
                                                                            id="visa-total-person">1</span>{{trans('messages.person')}}
                                                                    </p>
                                                                    <input type="hidden" name="person" id="visa-total-person-input" value="1">
                                                                    <input type="hidden" name="child" id="visa-number-child" value="0">
                                                                    <input type="hidden" name="adult" id="visa-number-adult" value="1">
                                                                    <input type="hidden" name="infant" id="visa-number-infant" value="0">
                                                                    <p>{{trans('messages.this_currency')}} <span
                                                                            id="visa-total-price">{{$visa_uae_nationality_types->adult_price}}</span></p>
                                                                </div>
                                                                <div class="col-xs-12">
                                                                    <input class="btn-apply" type="submit"
                                                                           value="{{trans('messages.Apply-Now')}}"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </form>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-12"></div>

                            </div>

                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
