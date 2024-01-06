@extends('layouts.app')

@section('content')
    @if ($page->header_image != '')
        <div class="page-head"
             style="background-size: cover;background-repeat: no-repeat;
                 background-image: url({{url('storage/app/public/images/page/'.$page->header_image)}});"></div>
    @else
        <div class="page-head" style='background-color: #b0a579'></div>
    @endif
    <div class="content-area recent-property padding-top-40" style="background-color: #FFF;">
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="" id="contact1">
                        <div class="row">
                            {!! $page->text !!}
                        </div>
                        <!-- /.row -->
                        <hr>

                        <hr>
                        <h2>
                            {{trans('messages.contact-form')}}
                        </h2>
                        <form method="post" action="{{route('send-contact')}}" name="contactForm" id="contactForm">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="firstname">
                                            {{trans('messages.Full_name')}}
                                        </label>
                                        <input type="text" class="form-control" name="name" id="name" required="true">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="lastname">
                                            {{trans('messages.Phone')}}
                                        </label>
                                        <input type="text" class="form-control" name="phone" id="phone" required="true">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="email">
                                            {{trans('messages.Email')}}
                                        </label>
                                        <input type="email" class="form-control" name="email" id="email"
                                               required="true">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="subject">
                                            {{trans('messages.Subject')}}
                                        </label>
                                        <input type="text" class="form-control" name="subject" id="subject"
                                               required="true">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="message">
                                            {{trans('messages.Message')}}
                                        </label>
                                        <textarea name="message" id="message" class="form-control" required="true"
                                                  style="max-width: 100%"></textarea>
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">

                                    <div class="col-md-6">
                                        {!! RecaptchaV3::field('contact') !!}
                                        @if ($errors->has('g-recaptcha-response'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 text-center">
                                    <button name="submit_send" type="submit" class="btn btn-primary">
                                        <i class="fab fa-envelope-o"></i>
                                        {{trans('messages.Send')}}
                                    </button>
                                </div>
                            </div>
                            <!-- /.row -->
                        </form>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>

        </div>
    </div>
    <div id="map" style="height: 400px;">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3631.3907687997134!2d54.34523741454051!3d24.47191378423868!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5e660a9352b8df%3A0xbf435f8969216db7!2sPalm+Oasis+Travel!5e0!3m2!1sen!2s!4v1556213104492!5m2!1sen!2s"
            width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
@endsection
