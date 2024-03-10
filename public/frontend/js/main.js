function trans(key, replace = {}) {
    var translation = key.split('.').reduce((t, i) => t[i] || null, window.translations);

    for (var placeholder in replace) {
        translation = translation.replace(`:${placeholder}`, replace[placeholder]);
    }
    return translation;
}

$(window).load(function () { // makes sure the whole site is loaded
    $('#status').fadeOut(); // will first fade out the loading animation
    //  $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
    //$('body').delay(350).css({'overflow': 'visible'});

      $(".date-from").datepicker({
        format: 'd-m-yyyy',
        clearButton: true,
        autoclose: true,
        startDate: new Date(),
        minDate: new Date()
    }).on('hide', function () {
        var id = $(this).attr('id');
        if (id !== "date-to"){
            // alert($('#date-from').val());
            // $(".date-to").datepicker("destroy");
            $(".date-to").datepicker({
                format: 'd-m-yyyy',
                clearButton: true,
                autoclose: true,
                startDate: $("#date-from").val(),
                minDate: $("#date-from").val()
            });
            // $("#date-to").datepicker("refresh");
            $("#date-to").focus();

        }
    });
})
$(document).ready(function () {
        $('.radio-hotel').on('ifChecked', function (event) {
        $(this).closest("form").submit();
    });
    $('#menu-search-bar').slideReveal({
        trigger: $(".handle"),
        push: false,
        width: 300
    });
    $('#menu-search-bar-close').click(function () {
        $('#menu-search-bar').slideReveal("hide", false);
    });
     $(window).on("scroll", function() {
                    if($(window).scrollTop() > 50) {
                        $(".navbar-default").addClass("active");
                    } else {
                        //remove the background property so it comes transparent again (defined in your css)
                       $(".navbar-default").removeClass("active");
                    }
                });  
               $('.selectpicker4').focus(function(){
                   var id= $(this).attr('id');
                   $('#' + id).selectpicker('toggle');
               });
                 
});
$(document).ready(function () {

    $('#hot-line-bar').hover(
        function () {
            $('#hot-line-bar').toggleClass('show-bar');
        },
        function () {
            $('#hot-line-bar').toggleClass('show-bar');
        }
    );

    $('#slick-country').slick({
        slidesToShow: 15,
        slidesToScroll: 1,
        dots: false,
        focusOnSelect: true,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 980,
                settings: {
                    slidesToShow: 10,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 15,
                    slidesToScroll: 1,
                }
            }
        ]
    });

    var swiper = new Swiper('.swiper-main-slider', {
        slidesPerView: 5,
        spaceBetween: 50,
        // init: false,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {

            1900: {
                slidesPerView: 15,
                spaceBetween: 5,
            },
            1024: {
                slidesPerView: 15,
                spaceBetween: 5,
            },
            980: {
                slidesPerView: 10,
                spaceBetween: 5,
            },
            768: {
                slidesPerView: 4,
                spaceBetween: 7,
            },
            480: {
                slidesPerView: 4,
                spaceBetween: 5,
            }

        }
    });
});
$(document).ready(function () {
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-yellow',
        radioClass: 'iradio_square-yellow',
        increaseArea: '20%' // optional
    });


    $('.layout-grid').on('click', function () {
        $('.layout-grid').addClass('active');
        $('.layout-list').removeClass('active');

        $('#list-type').removeClass('proerty-th-list');
        $('#list-type').addClass('proerty-th');

    });

    $('.layout-list').on('click', function () {
        $('.layout-grid').removeClass('active');
        $('.layout-list').addClass('active');

        $('#list-type').addClass('proerty-th-list');
        $('#list-type').removeClass('proerty-th');

    });
    var options = {
        size: 'large',
        offDays: '',
        onSelectedDateChanged: function (event, date) {
            var newDate = date.format('D-M-YYYY');
            showPackage(newDate);
        }
//	selectedDate: '2013-01-01',
//	selectedDateFormat:  'YYYY-MM-DD'
    }

    $('.slide').click(function () {
        if ($(this).find('i').hasClass("first")) {
            $(this).find('i').removeClass("first");
        } else {
            $(this).find('i').toggleClass("fa-plus fa-minus");
        }
    });
    $('#paginator').datepaginator(options);
    $('#enquiry_submit').click(function () {
        if (!checkEmptyChild()) {
            return false;
        }
        if (!checkNumberEnquiry()) {
            return false;
        }
        var array = [1];
        $(".num-adult").each(function () {
            var adult_id = $(this).attr('id');
            if ($('#' + adult_id).val() === '0') {
                array.push('0');
            }
        });
        if ($.inArray('0', array) !== -1) {
            alert_adult();
            return false;
        }



        if (!check_person_number()) {
            return false;
        }

        $('#is_booking').val(0);
        var form = $('#enquiry_form').serializeArray();

        $.ajax({
            url: "/enquiry",
            type: 'POST',
            header: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                "form": form
            },
            success: function (response) {
                $("#myModalEnquiry .modal-content").html(response.data);
                $("#myModalEnquiry").modal();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
    $('#book_submit').click(function () {
        if (!checkEmptyChild()) {
            return false;
        }
        if (!checkNumberEnquiry()) {
            return false;
        }
        var array = [1];
        $(".num-adult").each(function () {
            var adult_id = $(this).attr('id');
            if ($('#' + adult_id).val() === '0') {
                array.push('0');
            }
        });
        if ($.inArray('0', array) !== -1) {
            alert_adult();
            return false;
        }

        if (!check_person_number()) {
            return false;
        }
        $('#is_booking').val(1);
        var form = $('#enquiry_form').serializeArray();
        $.ajax({
            url: "/enquiry",
            type: 'POST',
            header: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                "form": form
            },
            success: function (response) {
                $("#myModalEnquiry .modal-content").html(response.data);
                $("#myModalEnquiry").modal();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });

});
$(document).ready(function () {
    $("#bg-slider").owlCarousel({
        navigation: false, // Show next and prev buttons
        slideSpeed: 100,
        autoPlay: 5000,
        paginationSpeed: 100,
        singleItem: true,
        mouseDrag: false,
        transitionStyle: "fade"
        // "singleItem:true" is a shortcut for:
        // items : 1,
        // itemsDesktop : false,
        // itemsDesktopSmall : false,
        // itemsTablet: false,
        // itemsMobile : false
    });
    $("#prop-smlr-slide_0").owlCarousel({
        navigation: false, // Show next and prev buttons
        slideSpeed: 200,
        pagination: true,
        paginationSpeed: 100,
        items: 3

    });
    $("#testimonial-slider").owlCarousel({
        navigation: false, // Show next and prev buttons
        slideSpeed: 100,
        pagination: true,
        paginationSpeed: 100,
        items: 3
    });

    $('#price-range').slider();
    $('#property-geo').slider();
    $('#min-baths').slider();
    $('#min-bed').slider();

    var RGBChange = function () {
        $('#RGB').css('background', '#FDC600')
    };

    // Advanced search toggle
    var $SearchToggle = $('.search-form .search-toggle');
    $SearchToggle.hide();

    $('.search-form .toggle-btn').on('click', function (e) {
        e.preventDefault();
        $SearchToggle.slideToggle(300);
    });

    setTimeout(function () {
        $('#counter').text('0');
        $('#counter1').text('0');
        $('#counter2').text('0');
        $('#counter3').text('0');
        setInterval(function () {
            var curval = parseInt($('#counter').text());
            var curval1 = parseInt($('#counter1').text().replace(' ', ''));
            var curval2 = parseInt($('#counter2').text());
            var curval3 = parseInt($('#counter3').text());
            if (curval <= 1007) {
                $('#counter').text(curval + 1);
            }
            if (curval1 <= 1280) {
                $('#counter1').text(sdf_FTS((curval1 + 20), 0, ' '));
            }
            if (curval2 <= 145) {
                $('#counter2').text(curval2 + 1);
            }
            if (curval3 <= 1022) {
                $('#counter3').text(curval3 + 1);
            }
        }, 2);
    }, 500);

    function sdf_FTS(_number, _decimal, _separator) {
        var decimal = (typeof (_decimal) != 'undefined') ? _decimal : 2;
        var separator = (typeof (_separator) != 'undefined') ? _separator : '';
        var r = parseFloat(_number)
        var exp10 = Math.pow(10, decimal);
        r = Math.round(r * exp10) / exp10;
        rr = Number(r).toFixed(decimal).toString().split('.');
        b = rr[0].replace(/(\d{1,3}(?=(\d{3})+(?:\.\d|\b)))/g, "\$1" + separator);
        r = (rr[1] ? b + '.' + rr[1] : b);

        return r;
    }
    
       $('#slick-home-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        arrows: false,
        autoplay: true,
        focusOnSelect: false,
        speed: 700,
    });

});


// Initializing WOW.JS
new WOW().init();

function show(elementClass) {
    $('.desert-container').css('display', 'none');
    $('.desert-month-' + elementClass).css('display', 'block');
}

function showPackage(date) {
    var country = $('#country-id-search').val();
    var month = $('#month-search').val();
    $.ajax({
        url: "design/views/viewPackages.php",
        type: 'POST',
        header: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: 'date=' + date + '&month=' + month + '&country=' + country,
        success: function (response) {
            $('#view-packages-area').html(response);
            $('.button-time-slide').each(function () {
                $(this).removeClass('button-active');
            });
            $('#button-' + date).addClass('button-active');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });


}

function showall() {

    var country = $('#country-id-search').val();
    var month = $('#month-search').val();
    $.ajax({
        url: "design/views/viewPackages.php",
        type: 'POST',
        header: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: 'date=null&month=' + month + '&country=' + country,
        success: function (response) {
            $('#view-packages-area').html(response);
            $('.button-time-slide').each(function () {
                $(this).removeClass('button-active');
            });
            $('#show-all-button').addClass('button-active');
            //	$('#date-value').val('null');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

$(document).ready(function () {

    $('#image-gallery').lightSlider({
        gallery: true,
        item: 1,
        thumbItem: 9,
        slideMargin: 0,
        speed: 2500,
        pause: 7000,
        auto: true,
        loop: true,
        
        onSliderLoad: function () {
            $('#image-gallery').removeClass('cS-hidden');
        }
    });
});

function getCountry(value) {
    $('#country_of_search').val(value);
    $('#search-form').submit();
}

function getMonth(value) {
    $('#month_of_search').val(value);
    //  $('#search-form').submit();

}

function getSelected(value, id, counter) {
    $('#num-' + id + '-' + counter).val(value);
     if(!check_person_number()){
                    return false;
                }
    calcCost(counter);
}

function calcCost(counter) {
    var adult = $('#num-adult-' + counter).val();
    var child1 = $('#num-Child-0-' + counter).val();
    var child2 = $('#num-Child-1-' + counter).val();
    var hotel_package_id = $('#hotel_package_id').val();
    $.ajax({
        url: "/cost",
        type: 'POST',
        header: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            '_token': $('meta[name="csrf-token"]').attr('content'),
            'adult': parseInt(adult),
            'child1': parseInt(child1),
            'child2': parseInt(child2),
            'hotel_package_id': hotel_package_id
        },
        success: function (response) {
            $('#room-cost-' + counter).val(parseInt(response.data));
            $('#room-cost-div-' + counter).html(response.data);
            calcTotalCost();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });

}

function AddChild(num, counter) {
    if (num === "0") {
        var text = '<input type="hidden" class="num-Child-0" name="num-Child-0-' + counter + '" id="num-Child-0-' + counter + '" value="0"/><input type="hidden" class="num-Child-1" name="num-Child-1-' + counter + '" id="num-Child-1-' + counter + '" value="0"/>';
        $('#child-added-' + counter).html(text);
        $('#num-child-' + counter).val(0);
        $('#child-added-' + counter).html('');
         if(!check_person_number()){
                    return false;
                }
        calcCost(counter);
    } else {
        $.ajax({
            url: "/add-child",
            type: 'POST',
            header: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'number': num,
                'counter': counter
            },
            success: function (response) {
                $('#num-child-' + counter).val(num);
                 if(!check_person_number()){
                    return false;
                }
                $('#child-added-' + counter).html(response.data);
                calcCost(counter);
                $('.selectpicker1').selectpicker('refresh');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });

    }
}

function addRoom() {
    var counter = parseInt($('#room-counter').val()) + 1;
    if (!checkEmptyChild()) {
        return false;
    }
    if (!checkNumber()) {
        return false;
    }
    $.ajax({
        url: "/add-room",
        type: 'POST',
        header: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            '_token': $('meta[name="csrf-token"]').attr('content'),
            'counter': counter
        },
        success: function (response) {
            $('#room-counter').val(counter);
            $('#add-room').append(response.data);
            $('.selectpicker-' + counter).selectpicker('refresh');

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });

}

function calcTotalCost() {
    var result = 0;
    $(".room-cost-div").each(function () {
        result = result + parseInt($(this).html());
    });
    result = result + parseInt($('#cost-all-tours-selected-input').val());
    $('#total-cost-div').html(result);
    $('#book_cost').val(result);
    $('#cost-total-input').val(result);
    $('#cost-total-input-book').val(result);
}

function clacTotalTourCost() {
    var result = 0;
    var counter = 0;
    $(".day-tour-all-cost").each(function () {
        result = result + parseInt($(this).val());
        counter = counter + 1;
    });
    $('#cost-all-tours-selected-input').val(result);
    $('#cost-all-tours-selected-div').html(result);
    $('#count-all-tours-selected-input').val(counter);
    calcTotalCost();
}

function deleteRoom(counter) {
    $('#room-counter').val(parseInt($('#room-counter').val()) - 1);
    $('.room-' + counter).remove();
    calcTotalCost();
}

function openEnquiryForm(user_id) {
  if (user_id === '0' || user_id === '' || user_id === 0) {
        alert_login();
    } else {
        $("#myModalEnquiryHeader").modal();
    }
    // $.ajax({
    //     url: "/enquiry-header",
    //     type: 'POST',
    //     header: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     },
    //     data: {
    //         '_token': $('meta[name="csrf-token"]').attr('content'),
    //     },
    //     success: function (response) {
    //         $("#myModalEnquiryHeader .modal-content").html(response.data);
    //         $("#myModalEnquiryHeader").modal();
    //     },
    //     error: function (jqXHR, textStatus, errorThrown) {
    //         console.log(textStatus, errorThrown);
    //     }
    // });
}

function sendEnquiryForm() {

    $.ajax({
        url: "/send-enquiry-header",
        type: 'POST',
        header: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            '_token': $('meta[name="csrf-token"]').attr('content'),
            'form': $('#enquiry-data').serialize()
        },
        success: function (response) {
            $("#myModalEnquiryHeader .modal-body").html(response.data);
            $("#myModalEnquiryHeader").modal();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

function delete_order(id) {
    if (confirm(trans('alert.confirm_delete_order'))) {
        $.ajax({
            url: "/delete-order",
            type: 'POST',
            header: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'id': id
            },
            success: function (response) {
                $('#order-area-' + id).hide('slow');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }
}

function delete_enquiry(id) {

    swal({
            title: trans('alert.text_alert_sure'),
            text: trans('alert.text_alert_enquiry'),
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: trans('alert.confirmButtonOk'),
            cancelButtonText: trans('alert.cancelButton'),
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function (isConfirm) {
            if (isConfirm) {

                $.ajax({
                    url: "/delete-enquiry",
                    type: 'POST',
                    header: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'id': id
                    },
                    success: function (response) {
                        $('#enquiry-area-' + id).hide('slow');
                        swal(trans('alert.success_message_delete'), "", "success");
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            } else {
                swal(trans('alert.success_message_cancel'), "", "error");
            }
        }
    )
}

function sortPackages() {
    var country = $('#country-id-search').val();
    var month = $('#month-search').val();
    //  var date = $('#date-value').val();
    var sort_date = $('#sort-date').val();
    // var sort_price = $('#sort-price').val();
    $.ajax({
        url: "design/views/viewPackages.php",
        type: 'POST',
        header: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            '_token': $('meta[name="csrf-token"]').attr('content'),
            'date': 0,
            'month': month,
            'country': country,
            'sort_date': sort_date
        },
        success: function (response) {
            $('#view-packages-area').html(response);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

function sortCountryPackages() {
    var price = $('#sort-price').val();
    $.ajax({
        url: "design/views/viewCountryPackages.php",
        type: 'POST',
        header: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            '_token': $('meta[name="csrf-token"]').attr('content'),
            'price': price
        },
        success: function (response) {
            $('#view-country-packages-area').html(response);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

function AddOrderPackage(package_id, user_id) {
    if (user_id === '0' || user_id === '') {
        window.location.href = 'https://palmoasistravel.com/member/login';
    } else {
        if (confirm(trans('alert.confirm_add_package'))) {

            $.ajax({
                url: "design/views/orderPackage.php?package_id=" + package_id + '&user_id=' + user_id,
                type: 'POST',
                header: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (response) {
                    window.location.reload();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }
    }
}

function DeleteOrderPackage(package_id, user_id) {
    if (user_id === '0' || user_id === '') {
        alert_login();
    } else {
        if (confirm(trans('alert.confirm_delete_package'))) {

            $.ajax({
                url: "design/views/deleteOrderPackage.php?package_id=" + package_id + '&user_id=' + user_id,
                type: 'POST',
                header: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (response) {
                    window.location.reload();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }
    }
}

function SelectNewHotel(hotel) {
    var package = $('#package_symbol').val();
    window.location.href = 'details.php?hotel=' + hotel + '&package=' + package;
}

// this is the first time
if (!localStorage.noFirstVisit) {

}

function deleteTour(counter) {
    $('.day-tour-' + counter).remove();
    calcTotalCost();
}

function AddTourChild(num, counter) {
    if (num === "0") {
        $('#num-tour-Child-0-' + counter).val('0');
        $('#num-tour-Child-1-' + counter).val('0');
        $('#num-tour-child-' + counter).val(num);
        $('#child-tour-added-' + counter).html('');
        calcTourCost(counter);
    } else {
        $.ajax({
            url: "/add-tour-child",
            type: 'POST',
            header: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'number': num,
                'counter': counter
            },
            success: function (response) {
                $('#num-tour-child-' + counter).val(num);
                $('#child-tour-added-' + counter).html(response.data);
                $('.selectpicker2').selectpicker('refresh');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });

    }
}

function getTourSelected(value, counter, type) {
    $('#num-tour-adult-' + counter).val(value);

    calcTourCost(counter, type);
}

function calcTourCost(counter, type) {
    var adult = $('#num-tour-adult-' + counter).val();
    var tour_day_id = $('#tour-day-id-' + counter).val();
    var result = 0;

    $.ajax({
        url: "/tour-cost",
        type: 'POST',
        header: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            '_token': $('meta[name="csrf-token"]').attr('content'),
            'adult': parseInt(adult),
            'tour': counter,
            'type': type
        },
        success: function (response) {
            $('#tour-cost-' + counter).val(response.data);
            $('#tour-cost-div-' + counter).html(response.data);
            $(".tour-cost").each(function () {
                result = result + parseInt($(this).val());
            });
            $('#day-tour-all-cost-' + tour_day_id).val(result);

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });

}

function addDayTour() {
    var counter = parseInt($('#tour-counter').val()) + 1;
    var package_id = $('#package_id').val();
    $.ajax({
        url: "/add-day-tour",
        type: 'POST',
        header: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            '_token': $('meta[name="csrf-token"]').attr('content'),
            'counter_tour': counter,
            'package_id': package_id
        },
        success: function (response) {
            $('#tour-counter').val(counter);
            $('#add-day-tour').append(response.data);
            $('.selectpicker-tour-' + counter).selectpicker('refresh');
            $('.selectpicker3').selectpicker('refresh');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

function select_lang() {
    $.ajax({
        url: "design/views/selectLang.php",
        type: 'POST',
        header: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            '_token': $('meta[name="csrf-token"]').attr('content'),
        },
        success: function (response) {
            $("#myModalLang .modal-body").html(response);
            $("#myModalLang").modal({
                backdrop: 'static',
                keyboard: false
            });
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

(function () {
    $('#chat-window-head').click(function () {
        if ($('.chat-window').hasClass('open-chat-window')) {
            $('.chat-window').removeClass('open-chat-window');
        } else {
            $('.chat-window').addClass('open-chat-window');
        }
    });
    setTimeout(function () {
        if (!$('.chat-window').hasClass('open-chat-window')) {
            $('.chat-window').addClass('open-chat-window');
        }
    }, 30000);
    $('#send-reply-btn').click(function () {
        $("#form-chat").submit();
    });

    $('#add-image-btn').click(function () {
        $('#fileChat').trigger('click');
    });
    $("#form-chat").on('submit', (function (e) {
            e.preventDefault();
            var form = $('#form-chat').serialize();
            $.ajax({
                url: "sendChatMessage.php",
                type: 'POST',
                header: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: form,
                success: function (response) {

                    swal({
                        title: trans('alert.Successfully'),
                        text: trans('alert.text_send_message'),
                        type: "success",
                        showCancelButton: false,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: trans('alert.confirmButtonOk'),
                        closeOnConfirm: false

                    }, function (isConfirm) {
                        if (isConfirm) {
                            window.location.href = "https://www.palmoasistravel.com/demo/package.php";
                        }
                    });

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });

        })
    );

    $("#fileChat").change(function () {
        var reader = new FileReader();
        reader.onload = imageIsLoaded;
        $('ul.messages').css('overflow-y', 'scroll');
        reader.readAsDataURL(this.files[0]);
        $('ul.messages').scrollTop($("ul.messages")[0].scrollHeight);

    });

})();

function imageIsLoaded(e) {
    $("#file-chat").css("color", "green");
    $('#image_preview').css("display", "block");
    $('#previewing').attr('src', e.target.result);
}

function deleteChatImage() {
    $('#image_preview').css("display", "none");
    $('#previewing').attr('src', '');
    $('#fileChat').val('');
}

function add_tour_to_package(day_id, package_id, number_day) {
    $.ajax({
        url: "/view-day-tour",
        type: 'POST',
        header: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            '_token': $('meta[name="csrf-token"]').attr('content'),
            'day_id': day_id,
            'package_id': package_id,
            'number_day': number_day
        },
        success: function (response) {
            $("#ModalOfTour .modal-body").html(response.data);
            $("#ModalOfTour").modal();
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-yellow',
                radioClass: 'iradio_square-yellow',
                increaseArea: '20%' // optional
            });
            $(".radio-tour-type").each(function () {
                var tour_id = $(this).attr('data-tour');
                var day = $(this).attr('data-day');
                var counter = $(this).attr('data-i');
                $('.radio-tour-type-' + tour_id).on('ifChecked', function (event) {
                    var selected_value = $(this).val();
                    addTour(tour_id, counter, day, selected_value);

                });
            });
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

function addTour(tour, i, day, type) {
    var counter = parseInt($('#add-tour-counter').val());
    if (type === '2') {
        var ajax_file = "/add-tour-bus";
    } else {
        var ajax_file = "/add-tour";
    }
    $.ajax({
        url: ajax_file,
        type: 'POST',
        header: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            '_token': $('meta[name="csrf-token"]').attr('content'),
            'tour': tour,
            'i': i,
            'type': type
        },
        success: function (response) {
            var all_text = " <a onclick=\"DeleteDayTour('" + tour + "','" + i + "','" + day + "')\"> <i class=\"fa fa-close\"></i> " + trans('alert.delete_tour') + "</a>";
            $('#add-tour-' + tour).html(response.data);
            $('#tour-button-' + tour).html(all_text);
            $('#is-isset-tour-' + tour).val('1');
            $('#add-tour-counter').val(counter + 1);
            calcTourCost(tour, type);
            $('.selectpicker-tour-' + tour).selectpicker('refresh');
            $('.selectpicker3').selectpicker('refresh');

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

function DeleteDayTour(tour, i, day) {
    var last_cost = parseInt($('#tour-cost-' + tour).val());
    $('#day-tour-all-cost-' + day).val(parseInt($('#day-tour-all-cost-' + day).val()) - last_cost);

    var counter = parseInt($('#add-tour-counter').val());

    var all_text = " <a onclick=\"addTour('" + tour + "')\">" + trans('alert.add_tour_text') + "</a> <input type='hidden' id='is-isset-tour-" + tour + "' name='is-isset-tour-" + i + "' value='0'/>";
    $('#add-tour-' + tour).html('');
    $('#add-tour-type-' + tour).html('');
    $('#tour-button-' + tour).html(all_text);
    $('#is-isset-tour-' + tour).val('0');
    $('#add-tour-counter').val(counter - 1);
    // clacTotalTourCost();
    submitTourForm();
}

function submitTourForm() {
    $.ajax({
        url: '/add-tour-all',
        type: 'POST',
        header: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            '_token': $('meta[name="csrf-token"]').attr('content'),
            'form': $('#add_tour_form').serialize()
        },
        success: function (response) {
            clacTotalTourCost();
            if (parseInt($('#cost-all-tours-selected-input').val()) !== 0) {
                $('#view-tour-area').css('display', 'block');
            } else {
                $('#view-tour-area').css('display', 'none');
            }
            $('#ModalOfTour').modal('toggle');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

function closeTourModal() {
    $('#ModalOfTour').modal('toggle');
}


$(document).ready(function () {
    $(".radio-tour-type").each(function () {
        var tour_id = $(this).attr('data-tour');
        var day = $(this).attr('data-day');
        var counter = $(this).attr('data-i');
        $('.radio-tour-type-' + tour_id).on('ifChecked', function (event) {
            var selected_value = $(this).val();
            addTour(tour_id, counter, day, selected_value);

        });
    });

});

function deleteAllTours() {

    swal({
            title: trans('alert.text_alert_sure'),
            text: trans('alert.text_alert_delete_all'),
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: trans('alert.confirmButtonOk'),
            cancelButtonText: trans('alert.cancelButton'),
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: "/delete-all-tours",
                    type: "POST",
                    data: '',
                    success: function (response) {
                        $(".day-tour-all-cost").each(function () {
                            $(this).val("0");
                        });
                        clacTotalTourCost();
                        swal(trans('alert.success_message_delete'), "", "success");
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            } else {
                swal(trans('alert.success_message_cancel'), "", "error");

            }
        }
    )
}

function viewSessionTours() {
    $.ajax({
        url: "/view-session-tour",
        type: 'POST',
        header: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            '_token': $('meta[name="csrf-token"]').attr('content'),
        },
        success: function (response) {
            $("#myModalTour .modal-body").html(response.data);
            $("#myModalTour").modal();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

function DeleteOneTour(id,day) {

    swal({
            title: trans('alert.text_alert_sure'),
            text: trans('alert.text_alert_delete_tour'),
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: trans('alert.confirmButtonOk'),
            cancelButtonText: trans('alert.cancelButton'),
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function (isConfirm) {
            if (isConfirm) {

                $.ajax({
                    url: "/delete-one-tour",
                    type: 'POST',
                    header: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'id': id
                    },
                    success: function (response) {
                        var last_cost = parseInt($('#session-tour-cost-' + id).val());
                        $('#day-tour-all-cost-' + day).val(parseInt($('#day-tour-all-cost-' + day).val()) - last_cost);

                        clacTotalTourCost();
                        if (parseInt($('#cost-all-tours-selected-input').val()) !== 0) {
                            $('#view-tour-area').css('display', 'block');
                        } else {
                            $('#view-tour-area').css('display', 'none');
                        }
                        $('#row-tour-' + id).addClass('hide');
                        swal(trans('alert.success_message_delete'), "", "success");
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            } else {
                swal(trans('alert.success_message_cancel'), "", "error");
            }
        }
    )
}

function BookPaymentForm(package, hotel, user_id) {
    if (user_id === '0' || user_id === '') {
        alert_login();

    } else {

        var array = [1];
        $(".num-adult").each(function () {
            var adult_id = $(this).attr('id');
            if ($('#' + adult_id).val() === '0') {
                array.push('0');
            }
        });
        if ($.inArray('0', array) !== -1) {
            alert_adult();

        } else {
            var cost = parseInt($('#cost-total-input').val());
            $.ajax({
                url: "design/views/paymentForm.php",
                type: 'POST',
                header: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: "package=" + package + "&cost=" + cost + '&hotel=' + hotel,
                success: function (response) {
                    $("#ModalPayment .modal-body").html(response.data);
                    $("#ModalPayment").modal();
                    $('#selectpicker-card').selectpicker('refresh');
                    $('.datepicker').datepicker();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });

        }
    }
}

function addTourType(tour, i, day, car, bus) {

    $.ajax({
        url: "/add-tour-type",
        type: 'POST',
        header: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            '_token': $('meta[name="csrf-token"]').attr('content'),
            'tour': tour, 'i': i, 'day': day, 'car': car, 'bus': bus
        },
        success: function (response) {

            $('#add-tour-type-' + tour).html(response.data);
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-yellow',
                radioClass: 'iradio_square-yellow',
                increaseArea: '20%' // optional
            });

            if (car === '1') {
                addTour(tour, i, day, '1');
            } else if (bus === '1') {
                addTour(tour, i, day, '2');
            }
            $(".radio-tour-type").each(function () {
                var tour_id = $(this).attr('data-tour');

                $('.radio-tour-type-' + tour_id).on('ifChecked', function (event) {
                    var selected_value = $(this).val();
                    addTour(tour_id, i, day, selected_value);
                });
            });
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

(function () {
    $('#btn_continue').click(function () {
//                      var isValid = payfortFortMerchantPage2.validateCcForm();
//            if (isValid) {
        getPaymentPage('cc_merchantpage2');
//            }
    });

})();

function AddChildToTourBus(num, tour) {
    if (num === "0") {
        $('#num-tour-bus-child-0-' + tour).val('0');
        $('#num-tour-bus-child-1-' + tour).val('0');
        $('#num-tour-bus-child-' + tour).val(num);
        $('#tour-bus-child-added-' + tour).html('');
        //  calcCost(tour);
    } else {
        $.ajax({
            url: "/add-tour-child-bus",
            type: 'POST',
            header: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'number' :num ,
                'tour' : tour
            },
            success: function (response) {
                $('#num-tour-bus-child-' + tour).val(num);
                $('#tour-bus-child-added-' + tour).html(response.data);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });

    }
}

function getTourBusSelected(tour) {
    calcTourBusCost(tour);
}

function calcTourBusCost(tour) {
    var adult = $('#num-tour-adult-' + tour).val();
    var child_1 = $('#num-tour-bus-children-1-' + tour).val();
    var child_2 = $('#num-tour-bus-children-2-' + tour).val();
    var tour_day_id = $('#tour-day-id-' + tour).val();
    var result = 0;

    $.ajax({
        url: "/tour-bus-cost",
        type: 'POST',
        header: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            '_token': $('meta[name="csrf-token"]').attr('content'),
            'adult' : parseInt(adult) ,
            'tour' : tour ,
            'child1' : child_1 ,
            'child2' : child_2
        },
        success: function (response) {
            $('#tour-cost-' + tour).val(response.data);
            $('#tour-cost-div-' + tour).html(response.data);
            $(".tour-cost").each(function () {
                result = result + parseInt($(this).val());
            });
            $('#day-tour-all-cost-' + tour_day_id).val(result);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

function BookFormSubmit() {
    var user_id = parseInt($('#user_loged_form').val());
    if (user_id === '0' || user_id === '' || user_id === 0) {
        login_form();
    } else {
        var array = [1];
        $(".num-adult").each(function () {
            var adult_id = $(this).attr('id');
            if ($('#' + adult_id).val() === '0') {
                array.push('0');
            }
        });
        if ($.inArray('0', array) !== -1) {
            alert_adult();
        } else {
            if (checkNumberEnquiry() && checkEmptyChild()) {
                $('#enquiry_form').submit();
            }
        }
    }
}

function formLogin() {

    if ($('#email').val() === '' || $('#password').val() === '') {
        swal({
            title: "",
            text: trans('alert.text_alert_login_form'),
            type: "warning",
            confirmButtonClass: "btn-success",
            confirmButtonText: trans('alert.confirmButtonOk'),
            closeOnConfirm: true
        },);
    } else {
        var email = $('#email').val();
        if (!validateEmail(email)) {
            swal({
                    title: "",
                    text: trans('alert.text_alert_correct_email'),
                    type: "warning",
                    confirmButtonClass: "btn-success",
                    confirmButtonText: trans('alert.confirmButtonOk'),
                    closeOnConfirm: true
                },
            );
            $('#email').addClass('focus-error');
            $('#email').focus();
            return false;
        }
        $.ajax({
            url: "loginForm.php",
            type: 'POST',
            header: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: $('#modal_login_form').serialize(),
            success: function (response) {
                var id = parseInt(response);
                if (id === 0 || id === '0') {

                    swal({
                            title: "",
                            text: trans('alert.text_alert_correct_info'),
                            type: "warning",
                            confirmButtonClass: "btn-success",
                            confirmButtonText: trans('alert.confirmButtonOk'),
                            closeOnConfirm: true
                        },
                    );
                } else {
                    $('#user_loged_form').val(id);
                    getLoginInfo();
                    $('#myModalLogin').modal('toggle');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }
}


function calcOneTourBusCost(tour, adult, child_1, child_2, type) {

    $.ajax({
        url: "/tour-bus-cost",
        type: 'POST',
        header: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            '_token': $('meta[name="csrf-token"]').attr('content'),
            'adult' :parseInt(adult) ,
            'tour' : tour ,
            'child1' : child_1 ,
            'child2' : child_2
        },
        success: function (response) {
            $('#tour-cost-div-one-' + type + '-' + tour).html(response.data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

function AddFavoritePackage(package_id, user_id) {
    if (user_id === '0' || user_id === '') {
        alert_login();
    } else {
        swal({
                title: trans('alert.text_alert_sure'),
                text: trans('alert.text_alert_add_favorite'),
                type: "warning",
                showCancelButton: true,
                cancelButtonClass: "btn-danger",
                confirmButtonText: trans('alert.confirmButtonOk'),
                cancelButtonText: trans('alert.cancelButton'),
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function (isConfirm) {
                if (isConfirm) {

                    $.ajax({
                        type: 'POST',
                        header: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "/add-favorite",
                        data: {
                            '_token': $('meta[name="csrf-token"]').attr('content'),
                            'package_id': package_id
                        },
                        success: function (response) {
                            swal(trans('alert.success_message_added'), "", "success");
                              window.location.reload();
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }
                    });
                } else {
                    swal(trans('alert.success_message_cancel'), "", "error");
                }
            }
        )
    }
}

function DeleteFavoritePackage(package_id, user_id) {
    if (user_id === '0' || user_id === '') {
        alert_login();
    } else {

        swal({
                title: trans('alert.text_alert_sure'),
                text: trans('alert.text_alert_delete_favorite'),
                type: "warning",
                showCancelButton: true,
                cancelButtonClass: "btn-danger",
                confirmButtonText: trans('alert.confirmButtonOk'),
                cancelButtonText: trans('alert.cancelButton'),
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        type: 'POST',
                        header: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "/delete-from-favorite",
                        data: {
                            '_token': $('meta[name="csrf-token"]').attr('content'),
                            'package_id': package_id
                        },
                        success: function (response) {
                            swal(trans('alert.success_message_delete'), "", "success");
                            window.location.reload();
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }
                    });
                } else {
                    swal(trans('alert.success_message_cancel'), "", "error");
                }
            }
        )
    }
}

function delete_favorite(id) {

    swal({
            title: trans('alert.text_alert_sure'),
            text: trans('alert.text_alert_delete_favorite'),
            type: "warning",
            showCancelButton: true,
            cancelButtonClass: "btn-danger",
            confirmButtonText: trans('alert.confirmButtonOk'),
            cancelButtonText: trans('alert.cancelButton'),
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    type: 'POST',
                    header: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/delete-from-favorite",
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'id': id
                    },
                    success: function (response) {
                        $('#favorite-area-' + id).hide('slow');
                        $('#order-area-' + id).hide('slow');
                        swal(trans('alert.success_message_delete'), "", "success");
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            } else {
                swal(trans('alert.success_message_cancel'), "", "error");
            }
        });

}

function alertregister() {
    swal({
        title: trans('alert.text_alert_sure'),
        text: "You will not be able to recover this imaginary file!",
        type: "error",
        showCancelButton: true,
        confirmButtonClass: 'btn-danger',
        confirmButtonText: 'Danger!'
    });
}

function alert_adult() {

    swal({
            title: "",
            text: trans('alert.text_adult_alert'),
            type: "warning",
            confirmButtonClass: "btn-success",
            confirmButtonText: trans('alert.confirmButtonOk'),
            closeOnConfirm: true
        },
    );
}

function alert_login() {
    swal({
        title: "",
        text: trans('alert.text_login_alert'),
        type: "warning",
        confirmButtonClass: "btn-success",
        confirmButtonText: trans('alert.confirmButtonOk'),
        closeOnConfirm: true

    }, function (isConfirm) {
        if (isConfirm) {
            window.location.href = 'https://palmoasistravel.com/member/login';
        }
    });
}

function statusChangeCallback(response) {  // Called with the results from FB.getLoginStatus().
    console.log('statusChangeCallback');
    console.log(response);                   // The current login status of the person.
    if (response.status === 'connected') {   // Logged into your webpage and Facebook.
        testAPI();

    } else {                                 // Not logged into your webpage or we are unable to tell.
        document.getElementById('status').innerHTML = 'Please log ' + 'into this webpage.';
    }

}

function checkLoginState() {               // Called when a person is finished with the Login Button.
    FB.getLoginStatus(function (response) {
        statusChangeCallback(response);
    });
}


window.fbAsyncInit = function () {
    FB.init({
        appId: '748237649003734',
        cookie: true,
        xfbml: true,
        version: 'v5.0'
    });

    FB.AppEvents.logPageView();

};

(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {
        return;
    }
    js = d.createElement(s);
    js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));


function testAPI() {                      // Testing Graph API after login.  See statusChangeCallback() for when this call is made.
    //  console.log('Welcome!  Fetching your information.... ');
    FB.api('/me?fields=name,email', function (response) {
        $.ajax({
            url: "design/views/register.php",
            type: 'POST',
            header: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: response,
            // dataType: "json",
            success: function (data) {

                swal({
                    title: trans('alert.Successfully'),
                    text: trans('alert.text_facebook_login'),
                    type: "success",
                    showCancelButton: false,
                    confirmButtonClass: "btn-success",
                    confirmButtonText: trans('alert.confirmButtonOk'),
                    closeOnConfirm: false

                }, function (isConfirm) {
                    if (isConfirm) {
                        window.location.href = 'https://palmoasistravel.com/';
                    }
                });
            }
        });

    });

}

function login_form() {
    $.ajax({
        url: "loginModal.php",
        type: 'POST',
        header: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            '_token': $('meta[name="csrf-token"]').attr('content'),
        },
        success: function (response) {
            $("#myModalLogin .modal-body").html(response);
            $("#myModalLogin").modal();
            fbAsyncInit();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

function checkNumber() {
    var result = true;

    var package_numper_person = parseInt($('#package_numper_person').val());
    if (package_numper_person === 0) {
        return true;
    }

    var number = 0;
    $(".num-adult").each(function () {
        var adult_id = $(this).attr('id');
        number = parseInt(number) + parseInt($('#' + adult_id).val());
    });

    $(".num-Child-0").each(function () {
        var Child_id0 = $(this).attr('id');
        if ($('#' + Child_id0).val() !== '0') {
            number = parseInt(number) + 1;
        }
    });
    $(".num-Child-1").each(function () {
        var Child_id1 = $(this).attr('id');
        if ($('#' + Child_id1).val() !== '0') {
            number = parseInt(number) + 1;
        }
    });


    if (package_numper_person <= number) {
        alertNumberPersonAble(package_numper_person);
        result = false;
    }
    return result;
}

function checkNumberEnquiry() {
    var result = true;
    var package_numper_person = parseInt($('#package_numper_person').val());
    var number = 0;
    if (package_numper_person === 0) {
        return true;
    }
    $(".num-adult").each(function () {
        var adult_id = $(this).attr('id');
        number = parseInt(number) + parseInt($('#' + adult_id).val());
    });

    $(".num-Child-0").each(function () {
        var Child_id0 = $(this).attr('id');
        if ($('#' + Child_id0).val() !== '0') {
            number = parseInt(number) + 1;
        }
    });
    $(".num-Child-1").each(function () {
        var Child_id1 = $(this).attr('id');
        if ($('#' + Child_id1).val() !== '0') {
            number = parseInt(number) + 1;
        }
    });


    if (package_numper_person < number) {
        alertNumberPersonAble(package_numper_person);
        result = false;
        return false;
    }
    return result;
}

function checkEmptyChild() {

    var result = true;
    $('select.child_input_value').each(function () {
        var Child_id3 = $(this).attr('id');
        if ($('#' + Child_id3 + ' option:selected').val() === '0') {
            swal({
                    title: "",
                    text: trans('alert.check_empty_child_alert'),
                    type: "warning",
                    confirmButtonClass: "btn-success",
                    confirmButtonText: trans('alert.confirmButtonOk'),
                    closeOnConfirm: true
                },
            );
            result = false;
            return false;
        }
    });
    return result;
}

function alertNumberPersonAble(number) {

    swal({
            title: "",
            text: trans('alert.alert_number_person_able{number}'),
            type: "warning",
            confirmButtonClass: "btn-success",
            confirmButtonText: trans('alert.confirmButtonOk'),
            closeOnConfirm: true
        },
    );
}

function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function getLoginInfo() {
    $.ajax({
        url: "design/views/logininformation.php",
        type: 'POST',
        header: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            '_token': $('meta[name="csrf-token"]').attr('content'),
        },
        success: function (response) {
            $('#member-zone-div').html(response);

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

$(document).ready(function () {
    $('.selectpicker-visa').selectpicker('refresh');
    $('.selectpicker-activity').selectpicker('refresh');
    $('#radio-visa-type-uae').on('ifChecked', function (event) {
        showVisaTypeUae();
    });
    $('#radio-visa-type-outbound').on('ifChecked', function (event) {
        showVisaTypeOutbound();
    });
});

function showVisaTypeUae() {
    $.ajax({
        url: "/visa-type-uae",
        type: 'POST',
        header: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            '_token': $('meta[name="csrf-token"]').attr('content'),
        },
        success: function (response) {
            $('#visa-type-form').html(response.data);
            $('.selectpicker-visa').selectpicker('refresh');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

function showVisaTypeOutbound() {
    $.ajax({
        url: "/visa-type-outbound",
        type: 'POST',
        header: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            '_token': $('meta[name="csrf-token"]').attr('content'),
        },
        success: function (response) {
            $('#visa-type-form').html(response.data);
            $('.selectpicker-visa').selectpicker('refresh');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

$(document).ready(function () {
   $('#slick-visa-type').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        autoplay: true,
        focusOnSelect: false,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            },

        ]
    });
    $('#slick-visa-country').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false,
        autoplay: true,
        focusOnSelect: true,
    });
    $('#slick-top-activity').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        dots: false,
        autoplay: true,
        focusOnSelect: false,
            responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            },

        ]
    });
      $('#slick-partners').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        dots: false,
        autoplay: true,
        focusOnSelect: true,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },

        ]
    });
});
$(document).ready(function () {
    $('.checked-person-type').on('ifChecked', function (event) {
      var card = $(this).data('card');
        var number = $(this).data('number');

        $.ajax({
            url: "/set-person-activity-card",
            type: 'POST',
            header: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'number': number,
                'card' : card
            },
            success: function (response) {
                $("#lead-info-"+card).html(response.data);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });

});
});

function setVisaUaeNationality(visa_id) {
    $.ajax({
        url: "/set-uae-nationality",
        type: 'POST',
        header: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            '_token': $('meta[name="csrf-token"]').attr('content'),
            'visa_id': visa_id
        },
        success: function (response) {
            $("#myModalSetNationality .modal-body").html(response.data);
            $("#myModalSetNationality").modal();
            $('.selectpicker-visa-2').selectpicker('refresh');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}
function setVisaOutboundNationality(visa_id) {
    $.ajax({
        url: "/set-nationality",
        type: 'POST',
        header: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            '_token': $('meta[name="csrf-token"]').attr('content'),
            'visa_id': visa_id
        },
        success: function (response) {
            $("#myModalSetNationality .modal-body").html(response.data);
            $("#myModalSetNationality").modal();
            $('.selectpicker-visa-2').selectpicker('refresh');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}
function addEmail(application_counter) {
    var counter = parseInt($('#email_counter_' + application_counter).val());
    $.ajax({
        url: "/add-email",
        type: 'POST',
        header: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            '_token': $('meta[name="csrf-token"]').attr('content'),
            "counter": counter,
            'application_counter': application_counter
        },
        success: function (response) {
            $('#email_counter_' + application_counter).val(counter + 1);
            $("#application-field-section-email-" + application_counter).append(response.data);
            $('.selectpicker-code').selectpicker('refresh');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}
function DeleteEmail(id, application_counter) {
    var counter = parseInt($('#email-counter-' + application_counter).val());
    $('#email-counter-' + application_counter).val((counter - 1));
    $('#div-email-' + id + '-' + application_counter).remove();
}

function getPrice(number, price) {
    var total = parseInt(number) * parseInt(price);
    $('#visa-price-view').html(total);
    $('#total-price').val(total);
}

function getCity(country) {
    $.ajax({
        url: "/get-city-of-country",
        type: 'POST',
        header: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            '_token': $('meta[name="csrf-token"]').attr('content'),
            'country': country
        },
        success: function (response) {
            $('#activity-city-container').html(response.data);
            $('.selectpicker-activity').selectpicker('refresh');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

function ViewActivity(id) {
    $.ajax({
        url: "/view-activity",
        type: 'POST',
        header: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            '_token': $('meta[name="csrf-token"]').attr('content'),
            'id': id
        },
        success: function (response) {
            $("#myModalActivity .modal-content").html(response.data);
            $("#myModalActivity").modal();
         $("#bg-slider").owlCarousel({
        navigation: false, // Show next and prev buttons
        slideSpeed: 100,
        autoPlay: 5000,
        paginationSpeed: 100,
        singleItem: true,
        mouseDrag: false,
        transitionStyle: "fade",
        dots : true
    });
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

function addActivityToCard(id, activity_id, category_id, price,mobile) {
    if (mobile === '0')
   { var date = $('#date-activity-' + id).val();}
   else {
        var date = $('#date-activity-mobile-' + id).val();
       
   }
         
    var adult = parseInt($('#adult').val());
    var child = parseInt($('#child').val());
    var ageChild1 = parseInt($('#ageChild1').val());
    var ageChild2 = parseInt($('#ageChild2').val());
    var ageChild3 = parseInt($('#ageChild3').val());
    var ageChild4 = parseInt($('#ageChild4').val());
    var ageChild5 = parseInt($('#ageChild5').val());

    // if (user_id === '0' || user_id === '') {
    //     alert_login();
    // } else {
        if (date === '')
        {
            swal({
                    title: "",
                    text: trans('alert.check_empty_date_alert'),
                    type: "warning",
                    confirmButtonClass: "btn-success",
                    confirmButtonText: trans('alert.confirmButtonOk'),
                    closeOnConfirm: true
                },
            );
            return false;
        }
        swal({
                title: trans('alert.text_alert_sure'),
                text: trans('alert.text_alert_add_activity'),
                type: "warning",
                showCancelButton: true,
                cancelButtonClass: "btn-danger",
                confirmButtonText: trans('alert.confirmButtonOk'),
                cancelButtonText: trans('alert.cancelButton'),
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: "/add-activity-to-card-new",
                        type: 'POST',
                        header: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            '_token': $('meta[name="csrf-token"]').attr('content'),
                            'id': id,
                            'price': price,
                            'date': date,
                            'activity_id': activity_id,
                            'category_id': category_id,
                            'adult': adult,
                            'child': child,
                            'ageChild1': ageChild1,
                            'ageChild2': ageChild2,
                            'ageChild3': ageChild3,
                            'ageChild4': ageChild4,
                            'ageChild5': ageChild5
                        },
                        success: function (response) {
                         
                            swal(trans('alert.success_message_added'), "", "success");
                            window.location.reload();
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }
                    });
                } else {
                    swal(trans('alert.success_message_cancel'), "", "error");
                }
            }
        )
    // }
}

function deleteActivityFromCard(id) {
    // if (user_id === '0' || user_id === '') {
    //     alert_login();
    // } else {

        swal({
                title: trans('alert.text_alert_sure'),
                text: trans('alert.text_alert_delete_activity'),
                type: "warning",
                showCancelButton: true,
                cancelButtonClass: "btn-danger",
                confirmButtonText: trans('alert.confirmButtonOk'),
                cancelButtonText: trans('alert.cancelButton'),
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: "/delete-activity-from-card",
                        type: 'POST',
                        header: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            'id': id,
                            '_token': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            swal(trans('alert.success_message_delete'), "", "success");
                            window.location.reload();
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }
                    });
                } else {
                    swal(trans('alert.success_message_cancel'), "", "error");
                }
            }
        )
    // }
}
function setActivityChild(number){
    $.ajax({
        url: "/add-activity-child",
        type: 'POST',
        header: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            'number': number,
            '_token': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            $('#activity-child-div').html(response.data);
            $('.selectpicker4').selectpicker('toggle');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

function openFavoriteModal() {
    $.ajax({
        url: "/view-favorite",
        type: 'POST',
        header: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            '_token': $('meta[name="csrf-token"]').attr('content'),
        },
        success: function (response) {
            $(".favorite-modal .modal-content").html(response.data);
            $(".favorite-modal").modal();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}
function check_person_number() {
    var package_number = parseInt($('#package-number').val());
    var result = 0;
    $('.num-adult').each(function () {
        result = result + parseInt($(this).val());
    });
    $('.num-child').each(function () {
        result = result + parseInt($(this).val());
    });
    if (result > package_number) {
        swal(trans('alert.can_not_add_person',{'number' : package_number}), "", "error");
        return false;
    }
    return true;
}
function view_enquiry_details(id){
    $.ajax({
        url: "/view-enquiry-details",
        type: 'POST',
        header: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            '_token': $('meta[name="csrf-token"]').attr('content'),
            "id": id
        },
        success: function (response) {
            $("#ModalViewEnquiry .modal-content").html(response.data);
            $("#ModalViewEnquiry").modal();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

function VisaCost(visa){
    var adult = $('#adult').val();
    var child = $('#child').val();
    var infant = $('#infant').val();

    $.ajax({
        url: "/visa-cost",
        type: 'POST',
        header: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            '_token': $('meta[name="csrf-token"]').attr('content'),
            "visa": visa,
            'adult': adult,
            'child': child,
            'infant' : infant
        },
        success: function (response) {
            $("#visa-total-person").html(response.person);
            $("#visa-total-person-input").val(response.person);
            $("#visa-total-price").html(response.price);
            $("#visa-number-adult").val(adult);
            $("#visa-number-child").val(child);
            $("#visa-number-infant").val(infant);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

function setVisaType(value){
    $.ajax({
        url: "/set-visa-type",
        type: 'POST',
        header: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            '_token': $('meta[name="csrf-token"]').attr('content'),
            "visa": value
        },
        success: function (response) {
            $("#visa-types").html(response.data);
            $('.selectpicker').selectpicker('refresh');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}
