<div id="back-to-top-button">
    <a onclick="topFunction()" title="">
        <i class="fas fa-arrow-up"></i>
    </a>
</div>
<style>
    .we_accept {
        margin-top: -35px;
    }
</style>
@php
    $IATA_Logo = \App\SiteSetting::where('name', 'IATA_Logo')->first();
@endphp
<div class="footer-area site-footer">
    <div class=" footer">
        <div class="container">
            <div class="row footer-row">
                <div class="col-md-3 col-xs-12 text-center-mobile">
                    <h4 class="footer-heading">{{trans('messages.Stay in touch')}}</h4>
                    <ul class="footer-list pt-2">
                                            <li><i class="fas fa-map-marker-alt"></i>
                                                {{Config::get('site_settings.main_office')}}
                                            </li>

                        <li class="dir-ar-ltr">
                            <i class="fa fa-phone float-right-custom"></i>
                            {{Config::get('site_settings.office')}}
                        </li>

                        <li class="dir-ar-ltr">
                            <i class="fab fa-whatsapp float-right-custom"></i>
                            {{Config::get('site_settings.whatsapp')}}
                        </li>
                        <li><i class="fa fa-envelope"></i>
                            <a href="mailto:{{Config::get('site_settings.email')}}"
                               target="_blank">{{Config::get('site_settings.email')}}</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6 col-xs-12 text-center">
                    <a class="footer-logo" href="{{route('home')}}">
                        <img src="{{asset('img/logo-white.png')}}" alt=""></a>
                    <p class="footer-text-1 mb-2">{{trans('messages.footer-text-1')}}</p>
                    <p class="footer-text-2 mb-4">{{trans('messages.footer-text-2')}}</p>

                </div>
                <div class="col-md-3 col-xs-12 text-center" style="direction: initial;">

                    <div class="col-md-12 col-sm-12 col-xs-12 social text-center">
                        <h2 class="footer-heading mb-3">{{trans('messages.lets-connect')}}</h2>
                        <ul>
                            @if (Config::get('site_settings.twitter') != '')
                                <li>
                                    <a class="wow fadeInUp animated" href="{{Config::get('site_settings.twitter')}}"
                                       target="_blank">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                            @endif
                            @if (Config::get('site_settings.facebook') != '')
                                <li>
                                    <a class="wow fadeInUp animated"
                                       href="{{Config::get('site_settings.facebook')}}"
                                       data-wow-delay="0.2s" target="_blank">
                                        <i class="fab fa-facebook"></i>
                                    </a>
                                </li>
                            @endif
                            @if (Config::get('site_settings.youtube') != '')
                                <li><a class="wow fadeInUp animated" href="{{Config::get('site_settings.youtube')}}"
                                       data-wow-delay="0.3s" target="_blank">
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                </li>
                            @endif
                            @if (Config::get('site_settings.instagram') != '')
                                <li>
                                    <a class="wow fadeInUp animated"
                                       href="{{Config::get('site_settings.instagram')}}"
                                       data-wow-delay="0.4s" target="_blank">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h2 class="footer-heading mb-3 mt-3">{{trans('messages.We-Accept')}}</h2>
                        <div class="row">
                        <img class="iata-footer-logo" class="wow pulse" data-wow-delay="1s"
                             src="{{ url('storage/app/public/images/settings/'.$IATA_Logo->value) }}"/>
                        <img src="{{ asset('img/master-card.png') }}"
                             style="width: 44px;" alt="" class="wow pulse" data-wow-delay="1s">
                        <img src="{{ asset('img/visa.png') }}" alt=""
                             style="width: 44px;border-radius: 0px;" class="wow pulse" data-wow-delay="1s">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copy text-center" style="background:#014d6d !important;">
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <span style="color:white;">
{{trans('messages.All rights')}}
</span>

                </div>
                {{--                <div class="bottom-menu o-pull-right-en o-pull-left-ar">--}}
                <div class="col-md-10 col-sm-10 col-xs-12 bottom-menu">
                    <ul style="text-align: end;margin: 5px 0">
                        <li>
                            <a class="wow fadeInUp animated" style="color:white;" href="{{route('policy')}}"
                               data-wow-delay="0.3s">
                                {{trans('messages.Privacy Policy')}}
                            </a>
                        </li>
                        <li>
                            <a class="wow fadeInUp animated" style="color:white;" href="{{route('terms')}}"
                               href="#" data-wow-delay="0.6s">
                                {{trans('messages.Terms And Condition')}}
                            </a>

                        </li>
                        <li>
                            <a class="wow fadeInUp animated" style="color:white;" href="{{route('sitemap')}}"
                               data-wow-delay="0.6s">
                                {{trans('messages.Site Map')}}
                            </a>
                        </li>
                        <li>
                            <a class="wow fadeInUp animated" style="color:white;" href="{{route('support')}}"
                               data-wow-delay="0.6s">
                                {{trans('messages.Support')}}
                            </a>
                        </li>
                        <li>
                            <a class="wow fadeInUp animated" style="color:white;" href="{{route('about')}}"
                               data-wow-delay="0.2s">
                                {{trans('messages.About us')}}
                            </a>
                        </li>

                        <li>
                            <a class="wow fadeInUp animated" style="color:white;" href="{{route('contact')}}"
                               data-wow-delay="0.6s">
                                {{trans('messages.Contact Us')}}
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="whats-app-icon">
        <a href="https://api.whatsapp.com/send?phone={{Config::get('site_settings.whatsapp')}}" target="_blank">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>
    <div class="messenger-icon">
        <a href="https://m.me/105961591242843" target="_blank">
            <i class="fab fa-facebook-messenger"></i>
        </a>
    </div>
</div>
