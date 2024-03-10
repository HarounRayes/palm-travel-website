<input type="hidden" id="type-tour" value="{{$tour}}"/>
<input type="hidden" id="type-day" value="{{$day}}"/>
<input type="hidden" id="type-counter" value="{{$j}}"/>

@for($count=0;$count<12;$count++)
    <input type="hidden" name="num-tour-bus-child-{{$count}}-{{$tour}}" id="num-tour-bus-child-{{$count}}-{{$tour}}"
           value="0"/>
@endfor

<div class="row">
    <h4 style="margin-bottom: 10px;">{{trans('messages.Type_of_Service')}}</h4>

    @if($car == '1')
        @if($is_car)
            <div class="col-md-4 col-sm-5 col-xs-6 padding-0-5">
                <div class="checkbox-hotel">
                    <div class="radio" style="margin:5px 0">
                        <label class="no-padding">
                            <input class="radio-tour-type radio-tour-type-{{$tour}}" name="radio-tour-type-{{$tour}}"
                                   id="radio-tour-type-{{$tour}}" type="radio" value="1" checked data-tour="{{$tour}}"/>
                            {{trans('messages.Private')}}
                        </label>
                    </div>
                </div>
            </div>
        @else
            <div class="col-md-4 col-sm-5 col-xs-6 padding-0-5">
                <div class="checkbox-hotel">
                    <div class="radio" style="margin:5px 0">
                        <label class="no-padding">
                            <input class="radio-tour-type radio-tour-type-{{$tour}}" name="radio-tour-type-{{$tour}}"
                                   id="radio-tour-type-{{$tour}}" type="radio" value="1" data-tour="{{$tour}}"/>
                            {{trans('messages.Private')}}
                        </label>
                    </div>
                </div>
            </div>
        @endif
    @endif
    @if($bus == '1')
        @if($is_bus)
            <div class="col-md-4 col-sm-5 col-xs-6 padding-0-5">
                <div class="checkbox-hotel">
                    <div class="radio" style="margin:5px 0">
                        <label class="no-padding">
                            <input class="radio-tour-type radio-tour-type-{{$tour}}" name="radio-tour-type-{{$tour}}"
                                   id="radio-tour-type-{{$tour}}" type="radio" checked value="2" data-tour="{{$tour}}"/>
                            {{trans('messages.Sharing')}}
                        </label>
                    </div>
                </div>
            </div>
        @else
            <div class="col-md-4 col-sm-5 col-xs-6 padding-0-5">
                <div class="checkbox-hotel">
                    <div class="radio" style="margin:5px 0">
                        <label class="no-padding">
                            <input class="radio-tour-type radio-tour-type-{{$tour}}" name="radio-tour-type-{{$tour}}"
                                   id="radio-tour-type-{{$tour}}" type="radio" value="2" data-tour="{{$tour}}"/>
                            {{trans('messages.Sharing')}}
                        </label>
                    </div>
                </div>
            </div>
        @endif
    @endif
</div>
