@if(isset($hotelPackage->sold_out) && $hotelPackage->sold_out == '1')
    <div class="col-xs-12 mar-t-10">
        <div class="sold-out-label">
            {{trans('messages.sold_out')}}
        </div>
    </div>
@elseif($package->checkBookablePackage())
    <form method="post" id="enquiry_form">
        <input type="hidden" id="is_booking" name="is_booking" value="0">
        <input type="hidden" name="hotel_package_id" id="hotel_package_id"
               value="{{$hotelPackage->id}}"/>
        <input type="hidden" id="hotel_id" name="hotel_id"
               value="{{$hotel->id}}"/>
        <input type="hidden" id="package_id" name="package_id"
               value="{{$package->id}}"/>
        <input type="hidden" id="package_symbol" value="{{$package->symbol}}"/>
        <div class="col-xs-12 mar-t-10" style="padding: 0px;">
            <div class="col-xs-3 padding-l-5">
                <label><b>
                        {{trans('messages.Adults')}}
                    </b></label>
                <input type="hidden" name="empty"/>
                <input type="hidden" class="num-adult" name="num-adult-0"
                       id="num-adult-0" value="0"/>
                <select id="lunchBegins" class="selectpicker select-adult"
                        title="Select"
                        tabindex="-98"
                        onchange="getSelected(this.value, 'adult', '0')">
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
                <input type="hidden" class="num-child" name="num-child-0"
                       id="num-child-0" value="0"/>
                <select id="lunchBegins" class="selectpicker select-child"
                        title="Select"
                        tabindex="-98" onchange="AddChild(this.value, '0')">
                    <option class="bs-title-option" value="0">
                        {{trans('messages.Select')}}
                    </option>
                    <option>0</option>
                    <option>1</option>
                    <option>2</option>
                </select>
            </div>


            <div class="col-sm-6" id="child-added-0" style="padding: 0px;">
                <input type="hidden" class="num-Child-0" name="num-Child-0-0"
                       id="num-Child-0-0" value="0"/>
                <input type="hidden" class="num-Child-1" name="num-Child-1-0"
                       id="num-Child-1-0" value="0"/>
            </div>
        </div>
        <div class="col-xs-12 mar-t-10" style="padding: 0px;">

            <label><b>
                    {{trans('messages.Room_Cost')}}
                    <input type="hidden" id="room-cost-0" name="room-cost-0"
                           value="0"/>
                    <span class="room-cost-div" id="room-cost-div-0">0</span>
                    {{trans('messages.this_currency')}}
                </b></label>
        </div>

        <input id="room-counter" name="room-counter" type="hidden" value="0"/>
        <input id="tour-counter" name="tour-counter" type="hidden" value="0"/>
        <div id="add-room"></div>
        <div id="add-day-tour"></div>

        <div class="col-xs-12 mar-t-10" style="padding: 0px;">
            <a class="navbar-btn nav-button wow fadeInRight btn nav-button-add-room"
               onclick="addRoom()" data-wow-delay="0.5s">
                {{trans('messages.Add_Room')}}
            </a>
        </div>
        <div class="col-xs-12 mar-t-10" id="view-tour-area"
             style="padding: 0px;display:none">
            <a class="navbar-btn nav-button wow fadeInRight btn nav-button-details"
               data-wow-delay="0.5s" onclick="viewSessionTours()">
                {{trans('messages.View_tours')}}
            </a>
            <label>
                <b>
                    <input type="hidden" name="cost"
                           id="cost-all-tours-selected-input" value="0"/>
                    <input type="hidden" id="count-all-tours-selected-input"
                           value="0"/>
                    {{trans('messages.total_tour_cost')}}
                    <span id="cost-all-tours-selected-div">0</span>
                    {{trans('messages.this_currency')}}
                </b>
            </label>
        </div>
        <div class="col-xs-12 mar-t-10" style="padding: 0px;">
            @if ($hotelPackage && isset($hotelPackage->enquiry) && $hotelPackage->enquiry == '1')

                <button type="button" id="enquiry_submit"
                        class="navbar-btn nav-button wow fadeInRight btn nav-button-enquiry"
                        data-wow-delay="0.5s">
                    {{trans('messages.Enquiry')}}
                </button>
            @endif
            <label><b>
                    <input type="hidden" name="cost" id="cost-total-input"
                           value="0"/>
                    {{trans('messages.Total_Cost')}}
                    <span id="total-cost-div">0</span>
                    {{trans('messages.this_currency')}}
                </b></label>
        </div>

        @if ($hotelPackage && isset($hotelPackage->bookable) && $hotelPackage->bookable == '1')
            <input type="hidden" name="book_hotel" value="{{$hotel->name}}"/>
            <input type="hidden" id="cost-total-input-book"
                   name="cost-total-input-book" value="0"/>

            <input type="hidden" id="total-number"
                   name="total-number" value="{{ $package->number}}"/>

            <input type="hidden" id="package-number"
                   name="package-number"
                   value="{{($package->number - $package->used)}}"/>

            <input type="hidden" name="book_package"
                   value="{{$package->name}}"/>

            <div class="col-xs-12 mar-t-10" style="padding: 0px;">
                <button type="button"
                        class="navbar-btn nav-button wow fadeInRight btn nav-button-book"
                        id="book_submit" data-wow-delay="0.5s">
                    {{trans('messages.Book_Now')}}
                </button>
            </div>
        @endif
    </form>
@else
    <div class="col-xs-12 mar-t-10">
        <div class="sold-out-label">
            {{trans('messages.sold_out')}}
        </div>
    </div>
@endif
