<div class="col-xs-12 mar-t-10 day-tour-{{$counter_tour}}" style="padding: 0px;">
    <div class="row" style="margin: 0;">

        <div class="col-xs-6 padding-0-5">
            <label><b>{{trans('messages.Day')}} </b></label>
            <select id="selected-day-tour-{{$counter_tour}}" class="selectpicker3" title="Select" tabindex="-98"
                    onchange="addTour(this.value)">
                <option class="bs-title-option" value="0">
                    {{trans('messages.Select')}}
                </option>
                @for ($i=0;$i<count($days) ;$i++)
                    <option value="{{$days[$i]['id']}}">
                        {{trans('messages.Day'.$i++)}}
                    </option>
                @endfor
            </select>
        </div>
        <div id='add-tour-{{$counter_tour}}'></div>
    </div>
</div>
<div class="col-xs-12 mar-t-10 day-tour-{{$counter_tour}}" style="padding: 0px;">
    <button class="navbar-btn nav-button wow fadeInRight btn nav-button-details o-pull-right-en o-pull-left-ar"
            onclick="deleteTour('{{$counter_tour}}')" data-wow-delay="0.5s">
        {{trans('messages.Delete_Tour')}}
    </button>
    <label><b>
            {{trans('messages.Tour_Cost')}}
            <input type="hidden" id="tour-cost-{{$counter_tour}}" name="tour-cost-{{$counter_tour}}" value="0"/>
            <span class="tour-cost-div"
                  id="tour-cost-div-{{$counter_tour}}">0</span> {{trans('messages.this_currency')}}
        </b></label>
</div>
