<div class="home-lager-shearch" style=" padding-top: 25px; margin-top: -25px;">
    <div class="container">
        <div class="col-lg-2 col-md-1"></div>
        <div class="col-lg-8 col-md-10 col-sm-12 large-search">
            <div class="search-form wow pulse">
                    <div class="col-md-12">
                        <div class="col-md-5 margin-bottom-15-xs">
                            <select id="lunchBegins" class="selectpicker" data-live-search="true"
                                    data-live-search-style="begins" name="country" required
                                    title="{{trans('messages.Your_Destinations')}}">
                                <option value="">{{trans('messages.All_Destinations')}}</option>
                                @foreach($countries as $country)
                                        <option value="{{$country->symbol}}" {{ request()->country == $country->symbol ? "selected" : "" }}>{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-5 margin-bottom-15-xs">

                            <select id="basic" class="selectpicker show-tick form-control"
                                  name="month">
                                <option value="0"> {{trans('messages.Month')}} </option>
                                <option value=""> {{trans('messages.All_Months')}}  </option>
                                @foreach(config('constans.months.'.app()->getLocale()) as $key => $month)
                                        <option value="{{$key}}" {{ request()->month == $key ? "selected" : "" }}>{{$month}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-md-2 text-center-xs no-padding">

                            <button class="btn-search-submit" type="submit" value="">{{trans('messages.search')}}</button>
                            <div id="fb-share-button" style="color: #fff">
                                <!--    <svg viewBox="0 0 12 12" preserveAspectRatio="xMidYMid meet">
                                        <path class="svg-icon-path" d="M9.1,0.1V2H8C7.6,2,7.3,2.1,7.1,2.3C7,2.4,6.9,2.7,6.9,3v1.4H9L8.8,6.5H6.9V12H4.7V6.5H2.9V4.4h1.8V2.8 c0-0.9,0.3-1.6,0.7-2.1C6,0.2,6.6,0,7.5,0C8.2,0,8.7,0,9.1,0.1z"></path>
                                    </svg>-->
                                {{trans('messages.share1')}}
                            </div>
                        </div>
                    </div>

            </div>

            <div class="col-lg-2 col-md-1"></div>
        </div>
    </div>
</div>
    <script>
        var fbButton = document.getElementById('fb-share-button');
        fbButton.addEventListener('click', function () {
            window.open('https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}' ,
                'facebook-share-dialog',
                'width=800,height=600'
            );
            return false;
        });
    </script>
