
<input type="hidden" id="tour-type-{{$tour}}" name="tour-type-{{$tour}}" value="{{$type}}"/>
<input type="hidden" id="is-isset-tour-{{$tour}}" name="is-isset-tour-{{$j}}" value="1"/>
<input type="hidden" class="num-tour-adult" name="num-tour-adult-{{$tour}}" id="num-tour-adult-{{$tour}}" value="0"/>

<input type="hidden" name="child-1-{{$tour}}" value="0">
<input type="hidden" name="child-2-{{$tour}}" value="0">

<div class="row" style="margin-top:10px;" >
    <div class="col-xs-6 padding-0-5">
        <p class="no-padding">{{trans('messages.Adults2')}}  </p>
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
    </div>

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

<!-- here new secript  @@@@@@@@@@@@@@@@@ -->

<script>
    (function () {
        // This button will increment the value
        $('[data-quantity="plus"]').click(function (e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var fieldName = $(this).attr('data-field');
            // Get its current value
            var currentVal = parseInt($('input[name=' + fieldName + ']').val());
            // If is not undefined
            if (!isNaN(currentVal)) {
                // Increment
                $('input[name=' + fieldName + ']').val(currentVal + 1);
                $('#submit-form-' +{{$tour}}).css('display', 'block');
            } else {
                // Otherwise put a 0 there
                $('input[name=' + fieldName + ']').val(0);
                $('#submit-form-' +{{$tour}}).css('display', 'none');
            }
            var currentVal2 = parseInt($('input[name=' + fieldName + ']').val());
            if (!isNaN(currentVal2) && currentVal2 === 0) {
                $('#submit-form-' + '{{$tour}}').css('display', 'none');
            }
            getTourSelected(currentVal2,{{$tour}}, '{{$type}}');
        });
        // This button will decrement the value till 0
        $('[data-quantity="minus"]').click(function (e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var fieldName = $(this).attr('data-field');
            // Get its current value
            var currentVal = parseInt($('input[name=' + fieldName + ']').val());
            // If it isn't undefined or its greater than 0
            if (!isNaN(currentVal) && currentVal > 0) {
                // Decrement one
                $('input[name=' + fieldName + ']').val(currentVal - 1);
                $('#submit-form-' +{{$tour}}).css('display', 'block');
            } else {
                // Otherwise put a 0 there
                $('input[name=' + fieldName + ']').val(0);
                $('#submit-form-' +{{$tour}}).css('display', 'none');
            }
            var currentVal2 = parseInt($('input[name=' + fieldName + ']').val());
            if (!isNaN(currentVal2) && currentVal2 === 0) {
                $('#submit-form-' + '{{$tour}}').css('display', 'none');
            }
            getTourSelected(currentVal2,{{$tour}}, '{{$type}}');
        });
    })();


</script>
<!-- here new secript @@@@@@@@@@@@@@@@@ -->
