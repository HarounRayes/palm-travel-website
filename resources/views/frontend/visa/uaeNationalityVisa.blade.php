@extends('layouts.app')
@section('content')
    <div class="page-head" style="background-color: #b0a579;
        background-image: url({{url('storage/app/public/images/info/'.$visa->image_header)}});
        background-size: cover;
        background-position: center;">

    </div>
    <!-- property area -->
    <div class="content-area home-area-1 recent-property" style="background-color: #FCFCFC; padding-bottom: 55px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 text-center page-title page-title-home">
                    {!! $visa->intro !!}
                </div>
            </div>
            <div class="row">
                <div class="proerty-th">
                    @if(!$enable_nationality)
                        <div class="similar-post-section padding-top-15 text-center">
                            <i class="fab fa-bell-slash attention-icon"></i>
                        </div>
                        <div class="similar-post-section padding-top-40 text-center">
                            <div class="attention-text">
                                {{trans('messages.visa-not-required' ,['visa'=> $visa->name ,'nationality' => $nationality->name])}}
                            </div>
                        </div>
                    @else
                        <div class="similar-post-section">

                            <div class="col-md-9 col-sm-8 col-xs-12">
                                <div id="prop-smlr-visa-details-container" style="padding-top: 30px">
                                    <table class="table table-responsive p-b-15 custom-table">
                                        <thead>
                                        <tr class="table-head-1">
                                            <th class="text-center" colspan="2">{{$visa->name}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th scope="row" class="table-cell-blue">
                                                {{trans('messages.Documents-Required')}}
                                            </th>
                                            <td>{{$visa->text}}</td>
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
                                            <td colspan="2">
                                                {{trans('messages.included')}}</td>
                                            <td>{{trans('messages.not-included')}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                @if ($visa->inclusions)
                                                    <ul>
                                                        @foreach ($visa->inclusions as $inclusion)
                                                            <li>
                                                                {{$inclusion->value}}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($visa->exclusions)
                                                    <ul>
                                                        @foreach ($visa->exclusions as $exclusion)
                                                            <li>
                                                                {{$exclusion->value}}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="table-cell-pink">

                                            </td>
                                            <td class="table-cell-pink"
                                                style="text-align: center;vertical-align: middle">
                                                <span id='visa-price-view'>
                                         {{$visaNationality->price}}
                                                </span>{{trans('messages.this_currency')}}
                                            </td>
                                            <td>
                                                <form method="post" action="{{route('visa.uae.application')}}">
                                                    @csrf
                                                    <div class="col-md-6">
                                                        <input type="hidden" name="visa_id" value="{{$visa->id}}"/>
                                                        <input type="hidden" name="visa_country_nationality_id"
                                                               value="{{$visaNationality->id}}"/>

                                                        <select name="person" class="selectpicker"
                                                                onchange="getPrice(this.value,'{{$visaNationality->price}}')">
                                                            @for ($i = 1; $i < 5; $i++)
                                                                <option value="{{$i}}">{{$i}}</option>
                                                            @endfor
                                                        </select>
                                                        <label>
                                                            # {{trans('messages.of-person')}}
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input class="btn-apply" type="submit"
                                                               value="{{trans('messages.Apply-Now')}}"/>
                                                    </div>
                                                </form>
                                            </td>
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
