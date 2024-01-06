<div class="container">
    <div class="row">
        <div class="page-head-content" style="padding: 80px 0 0 !important">
            <div class="col-md-5 col-sm-5 col-xs-1"></div>
            <div class="col-md-6 col-sm-6 col-xs-10">
                <div class="visa-search-box">
                    <div class="visa-search-box-title">
                        {{trans('messages.start-application')}}
                    </div>
                    <div class="visa-search-box-content">
                        <div class="row text-center">
                            <div class="col-xs-6">
                                <div class="checkbox-visa-type">
                                    <div class="radio">
                                        <label class="no-padding">
                                            <input class="radio-visa" id="radio-visa-type-outbound"
                                                   name="radio-visa-type" {{$outbound_checked}} type="radio" value="0">
                                            {{trans('messages.Outbound Visa')}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="checkbox-visa-type">
                                    <div class="radio">
                                        <label class="no-padding">
                                            <input class="radio-visa" id="radio-visa-type-uae" name="radio-visa-type"
                                                   {{ $uae_checked }} type="radio" value="1">
                                            {{trans('messages.uae-visa')}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" id="visa-type-form">
                                @if($outbound_checked != '')
                                    @include('frontend.visa.visaTypeOutbound')
                                @else
                                    @include('frontend.visa.visaTypeUae')
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-1 col-sm-1 col-xs-1"></div>
        </div>
    </div>
</div>
