<div class="col-xs-12 mar-t-10 room-{{$counter}}" style="padding: 0px;" >
    <div class="col-xs-3 padding-0-5">
        <label><b>
                {{trans('messages.Adults')}}
            </b></label>
        <input type="hidden" class="num-adult" name="num-adult-{{$counter}}" id="num-adult-{{$counter}}" value="0"/>
        <select id="lunchBegins" class="selectpicker-{{$counter}} select-adult" title="Select" tabindex="-98" onchange="getSelected(this.value, 'adult', '{{$counter}}')">
            <option class="bs-title-option" value="0">
               {{trans('messages.Select')}}
            </option>
            <option>1</option>
            <option>2</option>
            <option>3</option>
        </select>
    </div>
    <div class="col-xs-3 padding-0-5">
        <label><b>
                {{trans('messages.Children')}}
            </b></label>
        <input type="hidden" class="num-child" name="num-child-{{$counter}}" id="num-child-{{$counter}}" value="0"/>
        <select id="lunchBegins" class="selectpicker-{{$counter}} select-child" title="Select" tabindex="-98" onchange="AddChild(this.value, '{{$counter}}')">
            <option class="bs-title-option" value="0">
                {{trans('messages.Select')}}
            </option>
            <option>0</option>
            <option>1</option>
            <option>2</option>
        </select>
    </div>


    <div class="col-sm-6" id="child-added-{{$counter}}" style="padding: 0px;">

    </div>
</div>
<div class="col-xs-12 mar-t-10 room-{{$counter}}" style="padding: 0px;">
    <button class="navbar-btn nav-button wow fadeInRight btn nav-button-delete-room o-pull-right-en o-pull-left-ar" onclick="deleteRoom('{{$counter}}')" data-wow-delay="0.5s">
        {{trans('messages.Delete_Room')}}
    </button>
    <label><b>
            {{trans('messages.Room_Cost')}}
            <input type="hidden" id="room-cost-{{$counter}}" name="room-cost-{{$counter}}" value="" />
            <span class="room-cost-div" id="room-cost-div-{{$counter}}" >0</span> AED
        </b></label>
</div>
