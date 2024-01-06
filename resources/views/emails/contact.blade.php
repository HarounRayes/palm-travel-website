{{--@extends('emails.main')--}}
{{--@section('content')--}}
<div class="col-md-12 col-xs-12 col-sm-12">
    <h1> Contact message from Palm Oasis Travel</h1>
    <div class="form-group" >
        <label class="control-label col-md-2 col-sm-3 col-xs-4">
            Full name :
        </label>
        <label class="control-label col-md-2 col-sm-3 col-xs-4">
           {{$contact->name}}
        </label>
    </div>
    <div class="form-group" >
        <label class="control-label col-md-2 col-sm-3 col-xs-4">
            Email :
        </label>
        <label class="control-label col-md-2 col-sm-3 col-xs-4">
            {{$contact->email}}
        </label>
    </div>
    <div class="form-group" >
        <label class="control-label col-md-2 col-sm-3 col-xs-4">
            Subject :
        </label>
        <label class="control-label col-md-2 col-sm-3 col-xs-4">
            {{$contact->subject}}
        </label>
    </div>
    <div class="form-group" >
        <label class="control-label col-md-2 col-sm-3 col-xs-4">
            Phone :
        </label>
        <label class="control-label col-md-2 col-sm-3 col-xs-4">
            {{$contact->phone}}
        </label>
    </div>

    <div class="form-group" >
        <label class="control-label col-md-2 col-sm-3 col-xs-4">
            Message :
        </label>
        <label class="control-label col-md-2 col-sm-3 col-xs-4">
          {{$contact->message}}
        </label>
    </div>
</div>
{{--@endsection--}}
