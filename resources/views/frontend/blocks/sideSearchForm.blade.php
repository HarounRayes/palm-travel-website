<div class="panel-body search-widget" style="overflow-y: scroll;height: 100%;">
    <span>
        <a id="menu-search-bar-close" title="{{trans('messages.close')}}">x</a>
    </span>

    <fieldset class="padding-5">
        <div class="row">
            <div class="col-xs-12">
                <label for="price-range">
                   {{trans('messages.Price_range')}} :
                </label>
                <input type="text" class="span2" value="" data-slider-min="{{$country->hotelPackageMinPrice()}}"
                       data-slider-max="{{$country->hotelPackageMaxPrice()}}" data-slider-step="10"
                       data-slider-value="[{{$price_from}},{{$price_to}}]" id="price-range" name='price'><br />
                <b class="pull-left color">{{$country->hotelPackageMinPrice()}}</b>
                <b class="pull-right color">{{$country->hotelPackageMaxPrice()}}</b>
            </div>

        </div>
    </fieldset>
    <fieldset class="padding-5">
        <div class="row">
            <div class="col-xs-12">
                <label for="Date">
                 {{trans('messages.Date')}} :
                </label>
                <input type="text" class="span2" value="" data-slider-min="1"
                       data-slider-max="12" data-slider-step="1" name="date"
                       data-slider-value="[{{$date_from}},{{$date_to}}]" id="property-geo" ><br />
                <b class="pull-left color">{{trans('messages.Jan')}}</b>
                <b class="pull-right color">{{trans('messages.Nov')}}</b>
            </div>

        </div>
    </fieldset>
    <fieldset>
        <div class="row">
            <div class="col-xs-12">
                <label>
                    {{trans('messages.Stars')}}
                </label>
                <select name="star" id="lunchBegins" class="selectpicker">
                    <option value="0">  {{trans('messages.Stars')}} </option>
                    @for($i =3;$i<6;$i++)
                        <option {{ request()->star == $i ? "selected" : "" }} value="{{$i}}">{{$i}}</option>

                    @endfor
                </select>
            </div>

        </div>
    </fieldset>

    <fieldset class="padding-5">

        <label>
            {{trans('messages.Type')}}:
        </label>
        @foreach($types as $type)
            @if(($type->id) % 2 == 1)
                <div class="row">
                    @endif
                    <div class="col-xs-6 padding-0-5">
                        <div class="checkbox">
                            <label>
                                    <input {{(request()->type && in_array($type->id,request()->type))?"checked":""}} value="{{$type->id}}" type="checkbox" name='type[]'>
                                    {{$type->name}}
                            </label>
                        </div>
                    </div>
                    @if(($type->id) % 2 == 0)
                </div>
            @endif
        @endforeach

    </fieldset>

    <fieldset class="padding-5">

        <label>
            {{trans('messages.Offers')}} :
        </label>

        @foreach($offers as $offer)
            @if(($offer->id) % 2 == 1)
                <div class="row">
                    @endif
                    <div class="col-xs-6 padding-0-5">
                        <div class="checkbox">
                            <label>
                                <input {{(request()->offer && in_array($offer->id,request()->offer))?"checked":""}} value="{{$offer->id}}" type="checkbox" name='offer[]'>
                                {{$offer->name}}
                            </label>
                        </div>
                    </div>

                    @if(($offer->id) % 2 == 0)
                </div>
            @endif
        @endforeach
    </fieldset>

    <fieldset>
        <div class="row">
            <div class="col-xs-12">
                <input class="button btn largesearch-btn" value=" {{trans('messages.search')}} " type="submit">
            </div>
        </div>
    </fieldset>

</div>
