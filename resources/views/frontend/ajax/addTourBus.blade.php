
<input type="hidden" class="num-tour-adult" name="num-tour-adult-{{$tour}}" id="num-tour-adult-{{$tour}}" value="0"/>
<input type="hidden" id="tour-type-{{$tour}}" name="tour-type-{{$tour}}" value="{{$type}}"/>
<input type="hidden" id="is-isset-tour-{{$tour}}" name="is-isset-tour-{{$j}}" value="1"/>

<div class="row" style="margin-top:10px;" >
    <div class="col-xs-4 padding-0-5">
        <p class="no-padding">{{trans('messages.Adults2')}} </p>
        <div class="input-group plus-minus-input">

            <div class="input-group-button">
                <button type="button" class="button hollow circle minus" data-quantity="minus" data-field="adult-{{$tour}}">
                    <i class="fas fa-minus" aria-hidden="true"></i>
                </button>
            </div>
            <input class="input-group-field" type="text" name="adult-{{$tour}}" value="0" readonly >
            <div class="input-group-button">
                <button type="button" class="button hollow circle plus" data-quantity="plus" data-field="adult-{{$tour}}">
                    <i class="fas fa-plus" aria-hidden="true"></i>
                </button>
            </div>

        </div>
        <label><b>
                {{trans('messages.Cost')}}
                <span class="tour-cost-div" id="tour-cost-div-one-adult-{{$tour}}" >0</span>
                {{trans('messages.this_currency')}}
            </b></label>
    </div>

    <div class="col-xs-4 padding-0-5">
        <p class="no-padding">{{trans('messages.children1')}}  </p>
        <div class="input-group plus-minus-input">
            <div class="input-group-button">
                <button type="button" class="button hollow circle minus" data-quantity="minus-child-2" data-field="child-2-{{$tour}}">
                    <i class="fas fa-minus" aria-hidden="true"></i>
                </button>
            </div>
            <input class="input-group-field" type="text" name="child-2-{{$tour}}" value="0" readonly >
            <div class="input-group-button">
                <button type="button" class="button hollow circle plus" data-quantity="plus-child-2" data-field="child-2-{{$tour}}">
                    <i class="fas fa-plus" aria-hidden="true"></i>
                </button>
            </div>

        </div>
        <label><b>
               {{trans('messages.Cost')}}
                <span class="tour-cost-div" id="tour-cost-div-one-child-2-{{$tour}}" >0</span>
                    {{trans('messages.this_currency')}}
            </b></label>
    </div>

    <div class="col-xs-4 padding-0-5">
        <p class="no-padding">{{trans('messages.infant')}} </p>
        <div class="input-group plus-minus-input">

            <div class="input-group-button">
                <button type="button" class="button hollow circle minus" data-quantity="minus-child-1" data-field="child-1-{{$tour}}">
                    <i class="fas fa-minus" aria-hidden="true"></i>
                </button>
            </div>
            <input class="input-group-field" type="text" name="child-1-{{$tour}}" value="0" readonly >
            <div class="input-group-button">
                <button type="button" class="button hollow circle plus" data-quantity="plus-child-1" data-field="child-1-{{$tour}}">
                    <i class="fas fa-plus" aria-hidden="true"></i>
                </button>
            </div>

        </div>
        <label><b>
               {{trans('messages.Cost')}}
                <span class="tour-cost-div" id="tour-cost-div-one-child-1-{{$tour}}" >0</span>
                    {{trans('messages.this_currency')}}
            </b></label>
    </div>

</div>
<div class="row" id="tour-bus-child-added-{{$tour}}" style="margin-top: 10px;">

</div>
<div class="row" style="margin-top:10px;" >
    <div class="col-xs-6 padding-0-5">
        <label class="o-pull-left-en" style="padding-top:7px;"><b>
              {{trans('messages.Tour_Cost')}}
                <input type="hidden" class="tour-cost" id="tour-cost-{{$tour}}" name="tour-cost-{{$tour}}" value="0"/>
                <span class="tour-cost-div" id="tour-cost-div-{{$tour}}" >0</span> {{trans('messages.this_currency')}}
            </b></label>

        <a onclick="submitTourForm()" class="btn btn-success o-pull-right-en" id="submit-form-{{$tour}}" style="display: none;width:100px;">
            {{trans('messages.Book_Now')}}
        </a>
    </div>

</div>
<input type="hidden" id="num-tour-bus-child-{{$tour}}" value="0" />
<input type="hidden" id="num-tour-bus-children-1-{{$tour}}" value="0" />
<input type="hidden" id="num-tour-bus-children-2-{{$tour}}" value="0" />
<script>
    jQuery(document).ready(function () {
        // This button will increment the value
        $('[data-quantity="plus"]').click(function (e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            fieldName = $(this).attr('data-field');
            // Get its current value
            var currentVal = parseInt($('input[name=' + fieldName + ']').val());
            // If is not undefined
            if (!isNaN(currentVal)) {
                if (currentVal !== 10) {
                    // Increment
                    $('input[name=' + fieldName + ']').val(currentVal + 1);
                    $('#submit-form-' +{{$tour}}).css('display', 'block');
                }

            } else {
                // Otherwise put a 0 there
                $('input[name=' + fieldName + ']').val(0);
                $('#submit-form-' +{{$tour}}).css('display', 'none');
            }
            var currentVal2 = parseInt($('input[name=' + fieldName + ']').val());
            $('#num-tour-adult-' + {{$tour}}).val(currentVal2);
            calcOneTourBusCost({{$tour}}, currentVal2, 0, 0, 'adult');
            getTourBusSelected({{$tour}});
        });
        // This button will decrement the value till 0
        $('[data-quantity="minus"]').click(function (e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            fieldName = $(this).attr('data-field');
            // Get its current value
            var currentVal = parseInt($('input[name=' + fieldName + ']').val());
            // If it isn't undefined or its greater than 0
            if (!isNaN(currentVal) && currentVal > 0) {
                // Decrement one
                $('input[name=' + fieldName + ']').val(currentVal - 1);
                $('#submit-form-' +{{$tour}}).css('display', 'block');
                if (currentVal === 1) {
                    $('#submit-form-' +{{$tour}}).css('display', 'none');
                }
            } else {
                // Otherwise put a 0 there
                $('input[name=' + fieldName + ']').val(0);
                $('#submit-form-' +{{$tour}}).css('display', 'none');
            }
            var currentVal2 = parseInt($('input[name=' + fieldName + ']').val());
            $('#num-tour-adult-' + {{$tour}}).val(currentVal2);
            calcOneTourBusCost({{$tour}}, currentVal2, 0, 0, 'adult');
            getTourBusSelected({{$tour}});
        });


        $('[data-quantity="plus-child-1"]').click(function (e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            fieldName = $(this).attr('data-field');
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
            $('#num-tour-bus-children-1-' + {{$tour}}).val(currentVal2);
            calcOneTourBusCost({{$tour}}, 0, currentVal2, 0, 'child-1');
            getTourBusSelected({{$tour}});
            //   AddChildToTourBus(currentVal2,{{$tour}});
        });
        // This button will decrement the value till 0
        $('[data-quantity="minus-child-1"]').click(function (e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            fieldName = $(this).attr('data-field');
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
            $('#num-tour-bus-children-1-' + {{$tour}}).val(currentVal2);
            calcOneTourBusCost({{$tour}}, 0, currentVal2, 0, 'child-1');
            getTourBusSelected({{$tour}});
            // AddChildToTourBus(currentVal2,{{$tour}});
        });

        $('[data-quantity="plus-child-2"]').click(function (e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            fieldName = $(this).attr('data-field');
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
            var currentVal3 = parseInt($('input[name=' + fieldName + ']').val());
            $('#num-tour-bus-children-2-' + {{$tour}}).val(currentVal3);
            calcOneTourBusCost({{$tour}}, 0, 0, currentVal3, 'child-2');
            getTourBusSelected({{$tour}});
            // AddChildToTourBus(currentVal2,{{$tour}});
        });
        // This button will decrement the value till 0
        $('[data-quantity="minus-child-2"]').click(function (e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            fieldName = $(this).attr('data-field');
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
            $('#num-tour-bus-children-2-' + {{$tour}}).val(currentVal3);
            calcOneTourBusCost({{$tour}}, 0, 0, currentVal3, 'child-2');
            getTourBusSelected({{$tour}});
            //AddChildToTourBus(currentVal2,{{$tour}});
        });
    });


</script>
