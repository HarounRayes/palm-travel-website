<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf-token-frontend" content="{{ csrf_token() }}">

    <title>{{ Config::get('site_settings.site_name') }}</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <meta name="title" content="{{Config::get('site_settings.site_name') }}"/>
    <meta name="description" content="@yield('meta_description', Config::get('site_settings.site_name') )"/>
    <meta name="keywords" content="@yield('meta_keywords', Config::get('site_settings.site_name'))">
    <meta name="image" content="https://palmoasistravel.com/img/palm.jpg"/>
    @yield('meta')

    <meta itemprop="name" content="{{Config::get('site_settings.site_name') }}">
    <meta itemprop="description" content="{{Config::get('site_settings.site_name') }}">
    <meta itemprop="image" content="https://palmoasistravel.com/img/palm.jpg">

    <meta property="og:url" content="https://palmoasistravel.com"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="{{Config::get('site_settings.site_name') }}"/>
    <meta property="og:description" content="{{Config::get('site_settings.site_name') }}"/>
    <meta property="og:image" itemprop="image" content="https://palmoasistravel.com/img/palm.jpg"/>
    <meta property="og:image:secure_url" content="https://palmoasistravel.com/img/palm.jpg"/>
    <meta property="og:image:width" content="640">
    <meta property="og:image:height" content="300">

    <link itemprop="thumbnailUrl" href="https://palmoasistravel.com/img/logo.png">
    <span itemprop="thumbnail" itemscope itemtype="http://schema.org/ImageObject">
        <link itemprop="url" href="https://palmoasistravel.com/img/logo.png"> </span>

    <link rel="icon" href="https://palmoasistravel.com/img/logo.png">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    {{--    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"--}}
    {{--          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
          integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link href="{{ asset('frontend/css/normalize.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('frontend/'. app()->getLocale() .'/bootstrap/css/bootstrap.css') }}"
          rel="stylesheet">
    <link href="{{ asset('frontend/css/normalize.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/fontello.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/fonts/icon-7-stroke/css/pe-icon-7-stroke.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/fonts/icon-7-stroke/css/helper.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/bootstrap-select.min.css') }}" rel="stylesheet">

    <link href="{{ asset('frontend/css/icheck.min_all.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/price-range.css') }}" rel="stylesheet">

    <link href="{{ asset('frontend/css/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/owl.theme.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/owl.transitions.css') }}" rel="stylesheet">

    <link href="{{ asset('frontend/css/lightslider.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/style_chat_box.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/bootstrap-datepaginator.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/bootstrap-datepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/slick-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/swiper.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/sweetalert.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/animate.min.css') }}" rel="stylesheet">

    @if (Config::get('site_settings.font') == '2')
        <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: "Cairo" !important;
            }
        </style>
    @elseif (Config::get('site_settings.font') == '3')
        <link href="//db.onlinewebfonts.com/c/02f502e5eefeb353e5f83fc5045348dc?family=GE+SS+Two+Light" rel="stylesheet"
              type="text/css"/>
        <style>
            body {
                font-family: 'GE SS Two Light' !important;
            }
        </style>
    @else
        <link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/droid-arabic-kufi" type="text/css"/>
        <style>
            body {
                font-family: 'DroidArabicKufiRegular' !important;
            }
        </style>
    @endif


    <link href="{{ asset('frontend/css/default-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/stylehome.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/style_'.app()->getLocale() .'.css') }}" rel="stylesheet">
    {!! RecaptchaV3::initJs() !!}
</head>
<body>

<input type="hidden" id='lang_session' value="{{app()->getLocale()}}"/>

@include('frontend.nav.header')
@include('sweetalert::alert')
@yield('content')
@include('frontend.nav.footer')

<div class="modal fade" id="myModalEnquiry" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
        </div>
    </div>
</div>
<div class="modal fade" id="ModalViewEnquiry" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
        </div>
    </div>
</div>
<div class="modal fade" id="myModalEnquiryHeader" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 style="margin: 10px 0;">
                    {{trans('messages.Enquiry_information')}} </h4>
            </div>
            <div class="modal-body">
                <h1 class="s-property-title">
                    {{trans('messages.Please_fill')}}
                </h1>
                <form method="POST" id="enquiry-data" action="{{route('send-enquiry-header')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 col-xs-12 p-b-15">
                            <input type="text" class="form-control" id="name" name="name"
                                   placeholder="{{trans('messages.Full_name')}}" required="true"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-xs-12 p-b-15">
                            <input type="tel" class="form-control" id="phone" name="phone" pattern="^[0-9]+$"
                                   oninvalid="setCustomValidity('{{trans('messages.phone_number_validate')}}')"
                                   oninput="setCustomValidity('')" placeholder="{{trans('messages.Mobile')}}"
                                   required="true"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-xs-12 p-b-15">
                            <input type="email"
                                   class="form-control" id="email" name="email"
                                   pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                                   oninvalid="setCustomValidity('{{trans('messages.email_validate')}}')"
                                   oninput="setCustomValidity('')"
                                   placeholder="{{trans('messages.Email')}}"
                                   required="true"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-xs-12 p-b-15">
                            <input type="text" class="form-control" id="address"
                                   placeholder="{{trans('messages.Address')}}" name="address" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-xs-12 p-b-15">
<textarea class="form-control" id="message" name="message" placeholder="{{trans('messages.Message')}}" rows="5"
          style="max-width: 100%"></textarea>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">

                        <div class="col-md-6">
                            {!! RecaptchaV3::field('enquiry') !!}
                            @if ($errors->has('g-recaptcha-response'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <input type="submit" class="navbar-btn nav-button login" data-wow-delay="0.45s"
                                   value="{{trans('messages.Send')}}">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<div class="modal fade favorite-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        </div>
    </div>
</div>
@php
    \Illuminate\Support\Facades\Cache::forget('translations');
        \Illuminate\Support\Facades\Cache::rememberForever( 'translations', function () {
                  return collect( \Illuminate\Support\Facades\File::allFiles( resource_path( 'lang/'.app()->getLocale()) ) )->flatMap( function ( $file ) {
                      return [
                          $translation = $file->getBasename( '.php' ) => trans( $translation ),
                      ];
                  } )->toJson();
              } );
@endphp
<!-- Scripts -->
<script>
    var translations = {!! \Cache::get('translations') !!};
</script>
<script src="{{ asset('frontend/js/jquery-1.10.2.min.js') }}"></script>
<script src="{{ asset('frontend/js/modernizr-2.6.2.min.js') }}"></script>
{{--    <script src="{{ asset('frontend/js/query.creditCardValidator.js') }}" ></script>--}}
{{--    <script src="{{ asset('frontend/js/checkout.js.js') }}" ></script>--}}
<script src="{{ asset('frontend/'.app()->getLocale().'/bootstrap/js/bootstrap.js') }}"
></script>
<script src="{{ asset('frontend/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap-hover-dropdown.js') }}"></script>


<script src="{{ asset('frontend/js/easypiechart.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.easypiechart.min.js') }}"></script>

<script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/js/wow.js') }}"></script>

<script src="{{ asset('frontend/js/icheck.min.js') }}"></script>
<script src="{{ asset('frontend/js/price-range.js') }}"></script>
<script src="{{ asset('frontend/js/lightslider.min.js') }}"></script>

<script src="{{ asset('frontend/js/moment.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap-datepaginator.js') }}"></script>
<script src="{{ asset('frontend/js/slick.js') }}"></script>
<script src="{{ asset('frontend/js/swiper.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.slidereveal.min.js') }}"></script>
<script src="{{ asset('frontend/js/sweetalert.min.js') }}"></script>

<script src="{{ asset('frontend/js/main.js') }}"></script>
<script>

    $(document).ready(function () {

        $('.package-details-tabs a').click(function () {
            var target = $(this.hash);
            if (target.length == 0) target = $('a[name="' + this.hash.substr(1) + '"]');
            if (target.length == 0) target = $('html');
            $('html, body').animate({
                scrollTop: target.offset().top - 100
            }, 900);
            return false;
        });
    });

    // When the user scrolls down 20px from the top of the document, show the button
    $(window).scroll(function () {
        scrollFunction();
        var scrollDistance = $(window).scrollTop();
        $('.package-details-box').each(function (i) {
            if ($(this).position().top - 10 <= scrollDistance) {
                $('.package-details-tabs ul li a.active').removeClass('active');
                $('.package-details-tabs ul li a').eq(i).addClass('active');
            }
        });
    }).scroll();
    

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            $("#back-to-top-button").css('display', "block");
        } else {
            $("#back-to-top-button").css('display', "none");
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function shareFacebookButton() {
        $('#share-facebook').click();
    }

    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }

    (function ($) {
        var maxHeight = 0,
            items = $('.package-box');

        items.each(function () {
            maxHeight = ($(this).height() > maxHeight ? $(this).height() : maxHeight);
        });

        //Assign maximum height to children
        items.height(maxHeight);

        //Assign the largest height to the parent only
        items.each(function () {
            $(this).height(maxHeight);
        });

        //   $('.filter-radio').prop('checked', false);

        $('.filter-radio').on('ifClicked', function (event) {
            // alert();
            // $(this).iCheck('toggle');
            if ($(this).is(':checked')) {
                $(this).iCheck('uncheck');
            }
        });
        /* ----------------------------------------------------------- */
        /*  1. SCROLL DOWN
        /* ----------------------------------------------------------- */


        $(".mu-scrolldown").click(function (event) {
            event.preventDefault();
            //calculate destination place
            var dest = 0;
            if ($(this.hash).offset().top > $(document).height() - $(window).height()) {
                dest = $(document).height() - $(window).height();
            } else {
                dest = $(this.hash).offset().top;
            }
            //go to destination
            $('html,body').animate({scrollTop: dest}, 1000, 'swing');
        });

        /* ----------------------------------------------------------- */
        /*  3. SCROLL TOP BUTTON
        /* ----------------------------------------------------------- */

        //Check to see if the window is top if not then display button

        jQuery(window).scroll(function () {
            if (jQuery(this).scrollTop() > 300) {
                jQuery('.scrollToTop').fadeIn();
            } else {
                jQuery('.scrollToTop').fadeOut();
            }
        });

        //Click event to scroll to top

        jQuery('.scrollToTop').click(function () {
            jQuery('html, body').animate({scrollTop: 0}, 800);
            return false;
        });


        /* ----------------------------------------------------------- */
        /*  4. CLIENTS SLIDEER ( SLICK SLIDER )
        /* ----------------------------------------------------------- */

        $('.mu-clients-slider').slick({
            slidesToShow: 5,
            autoplay: true,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        arrows: true,
                        slidesToShow: 3,
                        slidesToScroll: 2,
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        arrows: true,
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                }
            ]
        });

        $('.mu-featured-tours-slider').slick({
            slidesToShow: 3,
            autoplay: true,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        arrows: true,
                        slidesToShow: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        arrows: true,
                        slidesToShow: 1
                    }
                }
            ]
        });

        $('.mu-featured-packages-slider').slick({
            slidesToShow: 3,
            autoplay: true,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        arrows: true,
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        arrows: true,
                        slidesToShow: 1
                    }
                }
            ]
        });

        $('.mu-service-slider').slick({
            slidesToShow: 3,
            autoplay: true,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        arrows: true,
                        slidesToShow: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        arrows: true,
                        slidesToShow: 1
                    }
                }
            ]
        });
    })(jQuery);


</script>

</body>
</html>
