<form method="post" id="add_tour_form">
    <input type="hidden" id="day" name="day" value="{{$day_id}}"/>
    <input type="hidden" name="add-tour-counter-all" value="{{count($tours)}}"/>
    <input type="hidden" name="number_day" value="{{$number_day}}"/>
    @if ($this_session_tour)
        <input type="hidden" name="add-tour-counter" id="add-tour-counter" value="{{$this_session_tour->count()}}"/>
    @else
        <input type="hidden" name="add-tour-counter" id="add-tour-counter" value="0"/>
    @endif
    <?php  $i = 0; ?>
    @foreach ($tours as $tour)
        <input type="hidden" id="tour-day-id-{{$tour->tour->id}}" value="{{$day_id}}"/>
        <input type="hidden" name="tour-id-{{ $i }}" value="{{$tour->tour->id}}"/>
        <div class="col-tour">
            <div class="row">
                @if($tour->tour->image != '')
                    <div class="tour-image">
                        <img src="{{ url('storage/app/public/images/tour/'.$tour->tour->image) }}"/>

                    </div>
                @endif
                <div class="tour-details">
                    <h3 style="margin-top: 0">{{$tour->tour->name}}</h3>
                    <p>{!! $tour->tour->text !!}</p>
                    <p class="inner-details">
                        @if($this_session_tour)
                            @if ( in_array($tour->tour->id, $this_session_tour_ids))
                                <span class="tour-add-button" id="tour-button-{{$tour->tour->id}}">
                                        <a onclick="DeleteDayTour('{{$tour->tour->id}}', '{{ $i }}', '{{ $day_id }}')">
                                            <i class="fas fa-close"></i>
                                            {{trans('messages.Delete_Tour')}}
                                        </a>
                                    </span>
                            @else
                                <span class="tour-add-button" id="tour-button-{{$tour->tour->id}}">
                                        <a onclick="addTourType('{{$tour->tour->id}}', '{{ $i }}', '{{ $day_id }}', '{{$tour->tour->is_car}}', '{{$tour->tour->is_bus}}')">
                                           {{trans('messages.Add_tour')}}
                                        </a>
                                    </span>
                            @endif
                        @endif
                    </p>
                </div>
            </div>
            <div id="add-tour-type-{{$tour->tour->id}}">
                @if($this_session_tour)
                    @if (in_array($tour->tour->id, $this_session_tour_ids))
                        @if ($tour->tour->tourByUser($day_id)->type == "1")
                            <div class="row">
                                <h4 style="margin-bottom: 10px;">{{trans('messages.Type_of_Service')}}</h4>
                                @if (isset($tour->tour->is_car) && $tour->tour->is_car == '1')
                                    <div class="col-md-4 col-sm-5 col-xs-6 padding-0-5">
                                        <div class="checkbox-hotel">
                                            <div class="radio">
                                                <label class="no-padding">
                                                    <input class="radio-tour-type radio-tour-type-{{$tour->tour->id}}"
                                                           name="radio-tour-type-{{$tour->tour->id}}"
                                                           id="radio-tour-type-{{$tour->tour->id}}" type="radio"
                                                           value="1"
                                                           checked data-day="{{ $day_id }}"
                                                           data-tour="{{$tour->tour->id}}"
                                                           data-i="{{ $i }}">
                                                    {{trans('messages.Private')}}
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                @endif
                                @if (isset($tour->tour->is_bus) && $tour->tour->is_bus == "1")
                                    <div class="col-md-4 col-sm-5 col-xs-6 padding-0-5">
                                        <div class="checkbox-hotel">
                                            <div class="radio">
                                                <label class="no-padding">
                                                    <input class="radio-tour-type radio-tour-type-{{$tour->tour->id}}"
                                                           name="radio-tour-type-{{$tour->tour->id}}"
                                                           id="radio-tour-type-{{$tour->tour->id}}" type="radio"
                                                           value="2"
                                                           data-day="{{ $day_id }}" data-tour="{{$tour->tour->id}}"
                                                           data-i="{{ $i }}">
                                                    {{trans('messages.Sharing')}}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endif


                            </div>
                        @elseif ($tour->tour->tourByUser($day_id)->type == "2")
                            <div class="row">
                                <h4 style="margin-bottom: 10px;">{{trans('messages.Type_of_Service')}}</h4>
                                @if (isset($tour->tour->is_car) && $tour->tour->is_car == "1")
                                    <div class="col-md-4 col-sm-5 col-xs-6 padding-0-5">
                                        <div class="checkbox-hotel">
                                            <div class="radio">
                                                <label class="no-padding">
                                                    <input class="radio-tour-type radio-tour-type-{{$tour->tour->id}}"
                                                           name="radio-tour-type-{{$tour->tour->id}}"
                                                           id="radio-tour-type-{{$tour->tour->id}}" type="radio"
                                                           value="1"
                                                           data-day="{{ $day_id }}" data-tour="{{$tour->tour->id}}"
                                                           data-i="{{ $i }}">
                                                    {{trans('messages.Private')}}
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                @endif
                                @if (isset($tour->tour->is_bus) && $tour->tour->is_bus == "1")
                                    <div class="col-md-4 col-sm-5 col-xs-6 padding-0-5">
                                        <div class="checkbox-hotel">
                                            <div class="radio">
                                                <label class="no-padding">
                                                    <input class="radio-tour-type radio-tour-type-{{$tour->tour->id}}"
                                                           name="radio-tour-type-{{$tour->tour->id}}"
                                                           id="radio-tour-type-{{$tour->tour->id}}" type="radio"
                                                           value="2"
                                                           checked data-day="{{ $day_id }}"
                                                           data-tour="{{$tour->tour->id}}"
                                                           data-i="{{ $i }}">
                                                    {{trans('messages.Sharing')}}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif
                    @endif
                @endif
            </div>
            <div id="add-tour-{{$tour->tour->id}}">
                @if (in_array($tour->tour->id, $this_session_tour_ids))
                    <input type="hidden" id="tour-type-{{$tour->tour->id}}" name="tour-type-{{$tour->tour->id}}"
                           value="{{$tour->tour->tourByUser($day_id)->type}}"/>
                    <input type="hidden" id="is-isset-tour-{{$tour->tour->id}}" name="is-isset-tour-{{ $i }}"
                           value="1"/>
                    <input type="hidden" class="num-tour-adult" name="num-tour-adult-{{$tour->tour->id}}"
                           id="num-tour-adult-{{$tour->tour->id}}"
                           value="{{$tour->tour->tourByUser($day_id)->adult_number}}"/>
                    @if ($tour->tour->tourByUser($day_id)->type == '1' )
                        <div class="row" style="margin-top:10px;">
                            <div class="col-xs-6 padding-0-5">
                                <p class="no-padding">{{trans('messages.Adults2')}}  </p>
                                <div class="input-group plus-minus-input">
                                    <div class="input-group-button">
                                        <button type="button" class="button hollow circle minus"
                                                data-quantity="minus-car"
                                                data-field="adult-car-{{$tour->tour->id}}"
                                                data-tour="{{$tour->tour->id}}"
                                                data-type="{{$tour->tour->tourByUser($day_id)->type}}">
                                            <i class="fas fa-minus" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <input class="input-group-field" type="text" name="adult-car-{{$tour->tour->id}}"
                                           value="{{$tour->tour->tourByUser($day_id)->adult_number}}" readonly>
                                    <div class="input-group-button">
                                        <button type="button" class="button hollow circle plus" data-quantity="plus-car"
                                                data-field="adult-car-{{$tour->tour->id}}"
                                                data-tour="{{$tour->tour->id}}"
                                                data-type="{{$tour->tour->tourByUser($day_id)->type}}">
                                            <i class="fas fa-plus" aria-hidden="true"></i>
                                        </button>
                                    </div>

                                </div>

                            </div>

                        </div>
                    @elseif ($tour->tour->tourByUser($day_id)->type == '2')
                        <div class="row" style="margin-top:10px;">
                            <div class="col-xs-4 padding-0-5">
                                <p class="no-padding">{{trans('messages.Adults2')}}  </p>
                                <div class="input-group plus-minus-input">

                                    <div class="input-group-button">
                                        <button type="button" class="button hollow circle minus" data-quantity="minus"
                                                data-field="adult-{{$tour->tour->id}}" data-tour="{{$tour->tour->id}}"
                                                data-type="{{$tour->tour->tourByUser($day_id)->type}}">
                                            <i class="fas fa-minus" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <input class="input-group-field" type="text" name="adult-{{$tour->tour->id}}"
                                           value="{{$tour->tour->tourByUser($day_id)->adult_number}}" readonly>
                                    <div class="input-group-button">
                                        <button type="button" class="button hollow circle plus" data-quantity="plus"
                                                data-field="adult-{{$tour->tour->id}}" data-tour="{{$tour->tour->id}}"
                                                data-type="{{$tour->tour->tourByUser($day_id)->type}}">
                                            <i class="fas fa-plus" aria-hidden="true"></i>
                                        </button>
                                    </div>

                                </div>
                                <label><b>
                                        {{trans('messages.Cost')}}
                                        <span class="tour-cost-div" id="tour-cost-div-one-adult-{{$tour->tour->id}}">
                                                {{$tour->tour->tourByUser($day_id)->adult_number * $tour['price_bus']}}</span>
                                        {{trans('messages.this_currency')}}
                                    </b></label>
                            </div>
                            <div class="col-xs-4 padding-0-5">
                                <p class="no-padding">
                                    {{trans('messages.children1')}}
                                </p>
                                <div class="input-group plus-minus-input">
                                    <div class="input-group-button">
                                        <button type="button" class="button hollow circle minus"
                                                data-quantity="minus-child-2"
                                                data-field="child-2-{{$tour->tour->id}}">
                                            <i class="fas fa-minus" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <input class="input-group-field" type="text" name="child-2-{{$tour->tour->id}}"
                                           value="{{$tour->tour->tourByUser($day_id)->child_number_2}}" readonly>
                                    <div class="input-group-button">
                                        <button type="button" class="button hollow circle plus"
                                                data-quantity="plus-child-2"
                                                data-field="child-2-{{$tour->tour->id}}">
                                            <i class="fas fa-plus" aria-hidden="true"></i>
                                        </button>
                                    </div>

                                </div>
                                <label><b>
                                        {{trans('messages.Cost')}}
                                        <span class="tour-cost-div" id="tour-cost-div-one-child-2-{{$tour->tour->id}}">
                                                  {{$tour->tour->tourByUser($day_id)->child_number_2 * $tour['child_2_12'] }}</span>
                                        {{trans('messages.this_currency')}}
                                    </b></label>
                            </div>
                            <div class="col-xs-4 padding-0-5">
                                <p class="no-padding">{{trans('messages.infant')}}  </p>
                                <div class="input-group plus-minus-input">
                                    <div class="input-group-button">
                                        <button type="button" class="button hollow circle minus"
                                                data-quantity="minus-child-1"
                                                data-field="child-1-{{$tour->tour->id}}">
                                            <i class="fas fa-minus" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <input class="input-group-field" type="text" name="child-1-{{$tour->tour->id}}"
                                           value="{{$tour->tour->tourByUser($day_id)->child_number}}" readonly>
                                    <div class="input-group-button">
                                        <button type="button" class="button hollow circle plus"
                                                data-quantity="plus-child-1"
                                                data-field="child-1-{{$tour->tour->id}}">
                                            <i class="fas fa-plus" aria-hidden="true"></i>
                                        </button>
                                    </div>

                                </div>
                                <label><b>
                                        {{trans('messages.Cost')}}
                                        <span class="tour-cost-div" id="tour-cost-div-one-child-1-{{$tour->tour->id}}">
                                                 {{$tour->tour->tourByUser($day_id)->child_number * $tour['child_0_2']}} </span>
                                        {{trans('messages.this_currency')}}
                                    </b></label>
                            </div>
                        </div>
                    @endif
                    <div class="row" style="margin-top:10px;">
                        <div class="col-xs-6 padding-0-5">
                            <label class="o-pull-left-en" style="padding-top:7px;"><b>
                                    {{trans('messages.Tour_Cost')}}
                                    <input type="hidden" class="tour-cost" id="tour-cost-{{$tour->tour->id}}"
                                           name="tour-cost-{{$tour->tour->id}}"
                                           value="{{$tour->tour->tourByUserCost($day_id)}}"/>
                                    <span class="tour-cost-div"
                                          id="tour-cost-div-{{$tour->tour->id}}">{{$tour->tour->tourByUserCost($day_id)}}</span>
                                    {{trans('messages.this_currency')}}
                                </b></label>


                            <a onclick="submitTourForm()" class="btn btn-success o-pull-right-en"
                               id="submit-form-{{$tour->tour->id}}" style="display: none;width:100px;">
                                {{trans('messages.Book_Now')}}
                            </a>
                        </div>
                    </div>
                @else
                    <input type="hidden" id="is-isset-tour-{{$tour->tour->id}}" name="is-isset-tour-{{ $i }}"
                           value="0"/>
                @endif
            </div>

        </div>
        <?php $i++; ?>
    @endforeach
    <div class="row tour-button-container hidden">
        <a onclick="submitTourForm()" class="btn btn-success">
            {{trans('messages.ok')}}
        </a>
        <a onclick="closeTourModal()" class="btn btn-danger">
            {{trans('messages.Cancel')}}
        </a>
    </div>
</form>
<script>
    (function () {
        $('.selectpicker2').selectpicker('refresh');
        $('.selectpicker-tour-1').selectpicker('refresh');
        $('.selectpicker-tour-2').selectpicker('refresh');
    })();
    (function () {
        // This button will increment the value
        $('[data-quantity="plus-car"]').click(function (e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var fieldName = $(this).attr('data-field');
            var tour = $(this).attr('data-tour');
            var type = $(this).attr('data-type');
            // Get its current value
            var currentVal = parseInt($('input[name=' + fieldName + ']').val());
            // If is not undefined
            if (!isNaN(currentVal)) {
                // Increment
                $('input[name=' + fieldName + ']').val(currentVal + 1);
                $('#submit-form-' + tour).css('display', 'block');
            } else {
                // Otherwise put a 0 there
                $('input[name=' + fieldName + ']').val(0);
                $('#submit-form-' + tour).css('display', 'none');
            }
            var currentVal2 = parseInt($('input[name=' + fieldName + ']').val());
            if (!isNaN(currentVal2) && currentVal2 === 0) {
                $('#submit-form-' + tour).css('display', 'none');
            }
            getTourSelected(currentVal2,tour,type);
        });
        // This button will decrement the value till 0
        $('[data-quantity="minus-car"]').click(function (e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var fieldName = $(this).attr('data-field');
            var tour = $(this).attr('data-tour');
            var type = $(this).attr('data-type');

            // Get its current value
            var currentVal = parseInt($('input[name=' + fieldName + ']').val());
            // If it isn't undefined or its greater than 0
            if (!isNaN(currentVal) && currentVal > 0) {
                // Decrement one
                $('input[name=' + fieldName + ']').val(currentVal - 1);
                $('#submit-form-' + tour).css('display', 'block');
            } else {
                // Otherwise put a 0 there
                $('input[name=' + fieldName + ']').val(0);
                $('#submit-form-' + tour).css('display', 'none');
            }
            var currentVal2 = parseInt($('input[name=' + fieldName + ']').val());
            if (!isNaN(currentVal2) && currentVal2 === 0) {
                $('#submit-form-' + tour).css('display', 'none');
            }
            getTourSelected(currentVal2,tour, type);
        });
        // This button will increment the value
        $('[data-quantity="plus"]').click(function (e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var fieldName = $(this).attr('data-field');
            var tour = $(this).attr('data-tour');
            var type = $(this).attr('data-type');
            // Get its current value
            var currentVal = parseInt($('input[name=' + fieldName + ']').val());
            // If is not undefined
            if (!isNaN(currentVal)) {
                // Increment
                $('input[name=' + fieldName + ']').val(currentVal + 1);
                $('#submit-form-' + tour).css('display', 'block');
            } else {
                // Otherwise put a 0 there
                $('input[name=' + fieldName + ']').val(0);
                $('#submit-form-' + tour).css('display', 'none');
            }
            var currentVal2 = parseInt($('input[name=' + fieldName + ']').val());
            if (!isNaN(currentVal2) && currentVal2 === 0) {
                $('#submit-form-' + tour).css('display', 'none');
            }
            calcOneTourBusCost(tour, currentVal2, 0, 0, 'adult');
            getTourSelected(currentVal2, tour, type);
        });
        // This button will decrement the value till 0
        $('[data-quantity="minus"]').click(function (e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var fieldName = $(this).attr('data-field');
            var tour = $(this).attr('data-tour');
            var type = $(this).attr('data-type');

            // Get its current value
            var currentVal = parseInt($('input[name=' + fieldName + ']').val());
            // If it isn't undefined or its greater than 0
            if (!isNaN(currentVal) && currentVal > 0) {
                // Decrement one
                $('input[name=' + fieldName + ']').val(currentVal - 1);
                $('#submit-form-' + tour).css('display', 'block');
            } else {
                // Otherwise put a 0 there
                $('input[name=' + fieldName + ']').val(0);
                $('#submit-form-' + tour).css('display', 'none');
            }
            var currentVal2 = parseInt($('input[name=' + fieldName + ']').val());
            if (!isNaN(currentVal2) && currentVal2 === 0) {
                $('#submit-form-' + tour).css('display', 'none');
            }
            calcOneTourBusCost(tour, currentVal2, 0, 0, 'adult');
            getTourSelected(currentVal2, tour, type);
        });
        $('[data-quantity="plus-child-1"]').click(function (e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            fieldName = $(this).attr('data-field');
            var tour = $(this).attr('data-tour');
            var type = $(this).attr('data-type');

            // Get its current value
            var currentVal = parseInt($('input[name=' + fieldName + ']').val());
            // If is not undefined
            if (!isNaN(currentVal)) {
                if (currentVal !== 10) {
                    // Increment
                    $('input[name=' + fieldName + ']').val(currentVal + 1);
                }
            } else {
                // Otherwise put a 0 there
                $('input[name=' + fieldName + ']').val(0);
            }
            var currentVal2 = parseInt($('input[name=' + fieldName + ']').val());
            $('#num-tour-bus-children-1-' + tour).val(currentVal2);
            calcOneTourBusCost(tour, 0, currentVal2, 0, 'child-1');
            getTourBusSelected(tour);

        });
        // This button will decrement the value till 0
        $('[data-quantity="minus-child-1"]').click(function (e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            fieldName = $(this).attr('data-field');
            var tour = $(this).attr('data-tour');
            var type = $(this).attr('data-type');
            // Get its current value
            var currentVal = parseInt($('input[name=' + fieldName + ']').val());
            // If it isn't undefined or its greater than 0
            if (!isNaN(currentVal) && currentVal > 0) {
                // Decrement one
                $('input[name=' + fieldName + ']').val(currentVal - 1);
            } else {
                // Otherwise put a 0 there
                $('input[name=' + fieldName + ']').val(0);
            }
            var currentVal2 = parseInt($('input[name=' + fieldName + ']').val());
            $('#num-tour-bus-children-1-' + tour).val(currentVal2);
            calcOneTourBusCost(tour, 0, currentVal2, 0, 'child-1');
            getTourBusSelected(tour);

        });

        $('[data-quantity="plus-child-2"]').click(function (e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            fieldName = $(this).attr('data-field');
            var tour = $(this).attr('data-tour');
            var type = $(this).attr('data-type');
            // Get its current value
            var currentVal = parseInt($('input[name=' + fieldName + ']').val());
            // If is not undefined
            if (!isNaN(currentVal)) {
                if (currentVal !== 12) {
                    // Increment
                    $('input[name=' + fieldName + ']').val(currentVal + 1);
                }
            } else {
                // Otherwise put a 0 there
                $('input[name=' + fieldName + ']').val(0);
            }
            var currentVal3 = parseInt($('input[name=' + fieldName + ']').val());
            $('#num-tour-bus-children-2-' + tour).val(currentVal3);
            calcOneTourBusCost(tour, 0, 0, currentVal3, 'child-2');
            getTourBusSelected(tour);

        });
        // This button will decrement the value till 0
        $('[data-quantity="minus-child-2"]').click(function (e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            fieldName = $(this).attr('data-field');
            var tour = $(this).attr('data-tour');
            var type = $(this).attr('data-type');
            // Get its current value
            var currentVal = parseInt($('input[name=' + fieldName + ']').val());
            // If it isn't undefined or its greater than 0
            if (!isNaN(currentVal) && currentVal > 0) {
                // Decrement one
                $('input[name=' + fieldName + ']').val(currentVal - 1);
            } else {
                // Otherwise put a 0 there
                $('input[name=' + fieldName + ']').val(0);
            }
            var currentVal3 = parseInt($('input[name=' + fieldName + ']').val());
            $('#num-tour-bus-children-2-' + tour).val(currentVal3);
            calcOneTourBusCost(tour, 0, 0, currentVal3, 'child-2');
            getTourBusSelected(tour);

        });
    })();
</script>
