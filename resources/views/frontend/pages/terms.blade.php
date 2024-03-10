@extends('layouts.app')

@section('content')
    @if ($page->header_image != '')
        <div class="page-head"
             style="background-size: cover;background-repeat: no-repeat;
                 background-image: url({{url('storage/app/public/images/page/'.$page->header_image)}});"></div>
    @else
        <div class="page-head" style='background-color: #b0a579'></div>
    @endif

    <!-- End page header -->
    <div class="content-area single-property" style="background-color: #FCFCFC;">
        <div class="container">
            <div class="row">
                <div class="clearfix padding-top-40">
                    <div class="col-md-12 single-property-content ">
                        <h1 class="s-property-title">
                            {{$page->title}}
                        </h1>

                        <div class="col-md-12">
                            <div class="single-property-wrapper">

                                <div class="section">

                                    <div class="s-property-content">
                                        <p>
                                            {!! $page->text !!}
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
