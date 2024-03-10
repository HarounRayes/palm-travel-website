<div class="row activity-box-search">
        <div class="col-md-12 col-xs-12">
            <div class="col-md-2 col-sm-3 col-xs-6 padding-0-5">
                <label>{{trans('messages.Country')}}</label>
                <select name="country" id="lunchBegins" class="selectpicker-activity" data-live-search="true"
                        title="{{trans('messages.Select')}}" tabindex="-98" required onchange="getCity(this.value)">
                    <option value="">{{trans('messages.Select')}}</option>
                    @foreach ($activity_countries as $country)
                        <option value="{{$country->id}}" {{request()->country == $country->id ? "selected" : ""}}>
                            {{$country->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 col-sm-3 col-xs-6 padding-0-5" id='activity-city-container'>
                <label>{{trans('messages.City')}}</label>
                <select name="city" id="lunchBegins" class="selectpicker-activity" title="{{trans('messages.Select')}}"
                        tabindex="-98" required data-live-search="true">
                    <option value="">{{trans('messages.Select')}} </option>
                    @foreach ($cities as $city)
                        <option value="{{$city->id}}" {{request()->city == $city->id ? "selected" : ""}}>
                            {{$city->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 col-sm-3 col-xs-6 padding-0-5">
                <label>{{trans('messages.from')}} </label>
                <input class="form-control datepicker date-from" name="from" value="{{request()->from}}" type="text" id="date-from" autocomplete="off">
            </div>
            <div class="col-md-2 col-sm-3 col-xs-6 padding-0-5">
                <label>{{trans('messages.to')}} </label>

                <input class="form-control datepicker date-to" name="to" value="{{request()->to}}" type="text" id="date-to" autocomplete="off">
            </div>
            <div class="col-md-2 col-sm-3 col-xs-6 no-padding">
                <div class="col-md-6 col-xs-6 padding-0-5">
                    <label>{{trans('messages.Adults')}} </label>
                    <select id="adult" name="adult" id="lunchBegins" class="selectpicker-activity"
                            title="{{trans('messages.Select')}}" tabindex="-98" required>
                        <option value="0">{{trans('messages.Select')}} </option>
                        @for ($i = 1; $i < 11; $i++)
                            <option value="{{$i}}" {{request()->adult == $i? "selected" : ""}}>{{$i}}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-6 col-xs-6 padding-0-5">
                    <label>{{trans('messages.Child')}} </label>
                    <select id="child" name="child" id="lunchBegins" class="selectpicker-activity"
                            title="{{trans('messages.Select')}}" tabindex="-98" onchange="setActivityChild(this.value)" required>
                        @for ($j = 0; $j < 6; $j++)
                            <option value="{{$j}}" {{ request()->child == $j ? "selected" : "" }}>{{$j}}</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="col-md-2 col-sm-3 col-xs-6 no-padding">
                <div class="col-md-5 col-xs-12 padding-0-5">
                    <label> <br></label>
                    <input type="submit" class='btn-search-submit' value="{{trans('messages.search')}}"/>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-xs-12" id="activity-child-div">
            @if(request()->child && request()->child > 0)
                <div class="col-md-2 col-sm-3 col-xs-3 m-t-20">
                    <label>{{trans('messages.age-of-children')}} </label>
                </div>
                @for($i=1;$i<(request()->child+1);$i++)
                    <?php $ageChild = 'ageChild'.$i ?>
                    <div class="col-md-2 col-sm-2 col-xs-3 m-t-20">
                        <select id="ageChild{{$i}}" name="ageChild{{$i}}" class="selectpicker-activity"
                                title="{{trans('messages.Child')}} {{$i}}" required>
                            @for ($t = 1; $t < 13; $t++)
                                <option value="{{$t}}" {{ request()->$ageChild == $t ? "selected" : "" }}>{{$t}}</option>
                            @endfor
                        </select>
                    </div>
                @endfor
                @endif
        </div>

</div>
