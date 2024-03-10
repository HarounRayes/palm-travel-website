@extends('layouts.app')
@section('content')
    <div class="page-head" style="background-color: #b0a579;
        background-image: url({{url('storage/app/public/images/info/'.$info->header_image)}});
        background-size: cover;
        background-position: center;">
        @include('frontend.visa.visaHeader')
    </div>
    <!-- property area -->
    <div class="content-area home-area-1 recent-property" style="background-color: #FCFCFC; padding-bottom: 55px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 text-center page-title page-title-home">
                    {!! $info['intro_'.app()->getLocale()] !!}
                </div>
            </div>
            <div class="row">
                <div class="proerty-th">
                    <div class="similar-post-section padding-top-40">
                        <div id="prop-smlr-slide-visa-type">
                            <div class="prop-smlr-slide-title">
                                {{trans('messages.uae-visa')}}
                            </div>
                            @if ($visas)
                                <div class="container-visas-box" style="overflow: hidden;padding-top:20px">
                                    @foreach ($visas as $visa)
                                        <div class="col-md-3 col-sm-4 col-xs-12 p-b-15">
                                            <div class="main-visa-box">
                                                <div class="main-visa-image">
                                                    <a onclick="setVisaUaeNationality({{$visa->id}})">
                                                        <img
                                                            src="{{url('storage/app/public/images/visa/'.$visa->image)}}"/>
                                                    </a>
                                                </div>
                                                <div class="main-visa-title text-center">
                                                    <a onclick="setVisaUaeNationality({{$visa->id}})">
                                                        <span>{{$visa->name}}</span>
                                                    </a></div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center">
                                    {{trans('messages.no-available-visa')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModalSetNationality" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 style="margin: 10px 0;">
                        {{trans('messages.select-nationality')}} </h4>
                </div>
                <div class="modal-body" style="overflow: unset">

                </div>
                <div class="modal-footer">
                </div>
            </div>

        </div>
    </div>
@endsection
