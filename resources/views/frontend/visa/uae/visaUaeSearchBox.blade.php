<div class="row">
    <div class="row search-uae-container">
        <form method="get" action="{{route('visa.uae.search')}}">
            <div class="col-md-3 col-xs-6 label-div">
                <label>{{trans('messages.choose-your-nationality')}}</label>
            </div>
            <div class="col-md-3 col-xs-6">
                <select id="lunchBegins" class="selectpicker" onchange="setVisaType(this.value)"
                        data-live-search-style="begins" name="nationality" required data-live-search="true"
                        title="{{trans('messages.Your-Nationality')}}">
                    <option value="">{{trans('messages.Your-Nationality')}}</option>
                    @foreach($nationalities as $nationality)
                        <option
                            value="{{$nationality->symbol}}" {{ request()->nationality == $nationality->symbol ? "selected" : "" }}>{{$nationality->name}}</option>
                    @endforeach
                </select>
            </div>
            <div id="visa-types" style="display: contents">
                @if(isset($types))
                    <div class="col-md-2 col-xs-4 label-div">
                        <label>{{trans('messages.visa-type')}}</label>
                    </div>
                    <div class="col-md-2 col-xs-4" style="padding: 6px 0;">
                        <select id="lunchBegins" class="selectpicker"
                                data-live-search-style="begins" name="type" required data-live-search="true"
                                title="{{trans('messages.visa-type')}}">
                            <option value="">{{trans('messages.visa-type')}}</option>
                            @foreach($types as $type)
                                <option
                                    value="{{$type->symbol}}" {{ request()->type == $type->symbol ? "selected" : "" }}>{{$type->name}}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
            </div>

            <div class="col-md-2 col-xs-4" style="padding-top: 10px">
                <input type="submit" value="{{trans('messages.search')}}" class="visa-type-input">
            </div>
        </form>
        </form>
    </div>
