@extends('layouts.app')

@section('content')
    <div class="content-area home-area-1 recent-property" style="background-color: #FCFCFC; padding-bottom: 55px;">
        <div class="container text-center">
            <h4>{{trans('messages.failed-visa-uae-message')}}</h4>
            <a class="btn btn-success" href="{{route('visa.uae')}}" >{{trans('messages.back-to-visa-uae')}}</a>
        </div>
    </div>
@endsection
