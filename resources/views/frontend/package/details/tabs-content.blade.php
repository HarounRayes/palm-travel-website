<div class="package-details-box" id="tab1primary">
    <div class="section">
        <h1 class="s-property-title">
            {{trans('messages.Overview')}}
        </h1>

        <div class="s-property-content" style="margin-top: -15px;">
            <p>
                {!! $package->overview !!}
            </p>

        </div>
    </div>
</div>


@if ($hotel && $hotel->count() > 0)
    <div class="package-details-box" id="tab4primary">
        <div class="acc-body">
            @include('frontend.blocks.hotel')
        </div>
    </div>
@endif
@if ($package->flights && $package->flight === true && $package->flights->count() > 0)
    <div class="package-details-box" id="tab5primary">
        <div class="panel-body recent-property-widget">
            <h4 class="s-property-title">
                {{trans('messages.Flight_Details')}}
            </h4>
            @include('frontend.blocks._flight')
        </div>
    </div>
@endif
@if ($package->transfers && $package->transfers->count() > 0)
    <div class="package-details-box" id="tab11primary">
        <div class="panel-body recent-property-widget">
            <h4 class="s-property-title">
                {{trans('messages.Transfers')}}
            </h4>
            @include('frontend.blocks._transfer')
        </div>
    </div>
@endif
@if ($package->inclusions && $package->inclusions->count() > 0)
    <div class="package-details-box active in" id="tab3primary">
        <div class="section">
            @include('frontend.blocks.in')
        </div>
    </div>
@endif
@if ($package->exclusions && $package->exclusions->count() > 0)
    <div class="package-details-box active in" id="tab9primary">
        <div class="section">
            @include('frontend.blocks.out')
        </div>
    </div>
@endif
@if ($package->days && $package->days->count() > 0)
    <div class="package-details-box" id="tab6primary">
        <div class="section">
            <h4 class="s-property-title">
                {{trans('messages.Your_Holiday_itinaraly')}}
            </h4>
            <div class="day-timeline">
                @include('frontend.blocks.day')
            </div>
        </div>

    </div>
@endif
@if (($package->terms_condition != '' ) && $package->cancellation_policy
!= '')
    <div class="package-details-box" id="tab7primary">
        <div class="acc-body">
            @if($package->terms_condition != '' )
                <div class="section">
                    @if(isset($package->open_term) && $package->open_term == '1')
                        <h1 class="s-property-title slide" data-toggle="collapse"
                            data-target="#terms-condition-3">
                            <i class="fas fa-minus first"></i>
                            {{trans('messages.Terms_and_Condition')}}
                        </h1>
                        <div
                            class="s-property-content panel-collapse fqa-body"
                            id="terms-condition-3">
                            <p>
                                {!! $package->terms_condition !!}
                            </p>
                        </div>
                    @else
                        <h1 class="s-property-title slide" data-toggle="collapse"
                            data-target="#terms-condition-3">
                            <i class="fas fa-plus"></i>
                            {{trans('messages.Terms_and_Condition')}}
                        </h1>
                        <div
                            class="s-property-content panel-collapse collapse fqa-body"
                            id="terms-condition-3">
                            <p>
                                {!! $package->terms_condition !!}
                            </p>
                        </div>
                    @endif
                </div>
            @endif
            @if($package->cancellation_policy != '')
                <div class="section">
                    @if(isset($package->open_cancellation) && $package->open_cancellation == '1')
                        <h1 class="s-property-title slide" data-toggle="collapse"
                            data-target="#cancellation-policy-3">
                            <i class="fas fa-minus first"></i>
                            {{trans('messages.Cancellation_Policy')}}
                        </h1>
                        <div
                            class="s-property-content panel-collapse fqa-body"
                            id="cancellation-policy-3">
                            <p>
                                {!! $package->cancellation_policy !!}
                            </p>
                        </div>
                    @else
                        <h1 class="s-property-title slide" data-toggle="collapse"
                            data-target="#cancellation-policy-3">
                            <i class="fas fa-plus"></i>
                            {{trans('messages.Cancellation_Policy')}}
                        </h1>
                        <div
                            class="s-property-content panel-collapse collapse fqa-body"
                            id="cancellation-policy-3">
                            <p>
                                {!! $package->cancellation_policy !!}
                            </p>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
@endif

