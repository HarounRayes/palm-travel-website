
    <ul>
        <li>
            <a class="active" href="#tab1primary" >
                <i class="fas fa-file-alt"></i>
                <br> {{trans('messages.Overview')}}
            </a>
        </li>
        @if ($hotel && $hotel->count() > 0)
            <li>
                <a class="" href="#tab4primary" >
                    <i class="fas fa-bed" aria-hidden="true"></i>
                    <br>
                    {{trans('messages.Hotel')}}
                </a>
            </li>
        @endif
        @if($package->flights && $package->flight === true && $package->flights->count() > 0)
            <li>
                <a class="" href="#tab5primary" >
                    <i class="fas fa-fighter-jet"></i>
                    <br>
                    {{trans('messages.Flight')}}
                </a>
            </li>
        @endif
        @if ($package->transfers && $package->transfers->count() > 0)
            <li>
                <a class="" href="#tab11primary" >
                    <i class="fa fa-bus"></i>
                    <br>
                    {{trans('messages.Transfers')}}
                </a>
            </li>
        @endif
        @if ($package->inclusions && $package->inclusions->count() > 0)
            <li>
                <a class="" href="#tab3primary" >
                    <i class="fas fa-th-list">
                    </i>
                    <br>
                    {{trans('messages.Inclusion')}}
                </a>
            </li>
        @endif
        @if ($package->exclusions && $package->exclusions->count() > 0)
            <li>
                <a class="" href="#tab9primary" >
                    <i class="fas fa-th-list">
                    </i>
                    <br>
                    {{trans('messages.not_Included')}}
                </a>
            </li>
        @endif

        @if($package->days && $package->days->count() > 0)
            <li>
                <a class="" href="#tab6primary" >
                    <i class="fas fa-suitcase">
                    </i>
                    <br>
                    {{trans('messages.Itinerary2')}}
                </a>
            </li>
        @endif
        @if ($package->terms_condition != '' || $package->cancellation_policy !=
        '')
            <li>
                <a class="" class="hidden-xs" href="#tab7primary" >
                    <i class="fas fa-pen-nib">
                    </i>
                    <br>
                    {{trans('messages.Terms_and_Condition')}}
                </a>
            </li>
        @endif
    </ul>
