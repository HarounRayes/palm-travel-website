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
                    @if ($visas && $visas->count() > 0)
                        <div class="similar-post-section padding-top-40">
                            <div id="prop-smlr-slide-visa-type">
                                <div class="prop-smlr-slide-title">
                                    {{trans('messages.uae-visa')}}
                                </div>
                                <div class="container-visas-box" style="overflow: hidden;padding-top:20px">
                                    @foreach ($visas as $visa)
                                        <div class="col-md-3 col-sm-4 col-xs-12 p-b-15">
                                            <div class="main-visa-box">
                                                <div class="main-visa-image">
                                                        <img
                                                            src="{{url('storage/app/public/images/visa/'.$visa->image)}}"/>
                                                </div>
                                                <div class="main-visa-title text-center">
                                                    <form method="get" action="{{route('visa.uae.nationality')}}" id="form-{{$visa->id}}" >
                                                        <input type="hidden" value="{{request()->nationality}}" name="nationality" >
                                                        <input type="hidden" value="{{$visa->id}}" name="visa" >
                                                    <a href="javascript:;" onclick="document.getElementById('form-{{$visa->id}}').submit();">
                                                        <span>{{$visa->name}}</span>
                                                    </a>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="similar-post-section padding-top-15 text-center">
                            <i class="fab fa-bell-slash attention-icon"></i>
                        </div>
                        <div class="similar-post-section padding-top-40 text-center">
                            <div class="attention-text">
                                {{trans('messages.There-is-no-visa')}} {{$nationality->name}}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
