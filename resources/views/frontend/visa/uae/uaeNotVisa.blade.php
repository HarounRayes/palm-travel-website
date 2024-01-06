@extends('layouts.app')
@section('content')
    @if($nationality->header_image != '')
        <div class="page-head" style="
            background-image: url({{url('storage/app/public/images/visa/'.$nationality->header_image)}});
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
                <div class="col-xs-12">
                    <div class="proerty-th">
                        <div class="similar-post-section padding-top-15 text-center">
                            <i class="fa fa-bell-slash attention-icon"></i>
                        </div>
                        <div class="similar-post-section padding-top-40 padding-bottom-40">
                            <div class="attention-text">
                                {!! $nationality->text !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
