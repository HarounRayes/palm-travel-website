<div class="panel-body recent-property-widget">

    <ul>
        <li>
            <div class="col-md-12 col-sm-12 col-xs-12 blg-entry">
                @if (isset($hotel->image) && $hotel->image != '')
                <div class="o-pull-left-en o-pull-right-ar blg-thumb p0">
                    <a href="{{$hotel->website_link}}" target="_blank">
                        <img src="{{url('storage/app/public/images/hotel/'.$hotel->image)}}"
                             class="hotel-img">
                    </a>
                </div>
                @endif

                <h5>
                    <a href="{{$hotel->website_link}}" target="_blank">
                        {{$hotel->name}}
                    </a>
                    <span class="property-star o-pull-left-ar o-pull-right-en">
                       @for ($k = 1; $k < 6; $k++)
                            @if ($hotel->star_rate >= $k)
                                <i class="fas fa-star yellow" aria-hidden="true"></i>
                            @else
                                <i class="fas fa-star" aria-hidden="true"></i>
                            @endif
                        @endfor
                    </span>
                </h5>
                <span class="property-price">
                    <i class="fas fa-calendar" aria-hidden="true" style="color:blue"></i>
            {{trans('messages.Check_in')}}:
                    <span class="span-date">
                       {{$hotelPackage->getCheckInFormate()}}
                    </span>
                    {{trans('messages.Check_out')}}
                    <span class="span-date">
                        {{$hotelPackage->getCheckOutFormate()}}
                    </span>
                </span>
            </div>
            <div class="col-md-12 col-xs-12 col-sm-12 padding-top-10">
                {!! $hotel->info .' <a href="'.$hotel->website_link.'" target="_blank">'.trans('messages.see-more').'</a>' !!}
            </div>
        </li>
        @if ($segments)
        @foreach ($segments as $segment)
        <li>
            <div class="col-md-12 col-sm-12 col-xs-12 blg-entry">
                @if (isset($segment->hotel->image) && $segment->hotel->image != '')
                <div class="o-pull-left-en o-pull-right-ar blg-thumb p0">
                    <a href="{{$segment->hotel->website_link}}" target="_blank">
                        <img src="{{url('storage/app/public/images/hotel/'.$segment->hotel->image)}}"
                             class="hotel-img">
                    </a>
                </div>
                @endif

                <h5>
                    <a href="{{$segment->hotel->website_link}}" target="_blank">
                        {{$segment->hotel->name}}
                    </a>
                    <span class="property-star o-pull-left-ar o-pull-right-en">
@for ($k = 1; $k < 6; $k++)
                                    @if ($segment->hotel->star_rate >= $k)
                                        <i class="fas fa-star yellow" aria-hidden="true"></i>
                                    @else
                                        <i class="fas fa-star" aria-hidden="true"></i>
                                    @endif
                                @endfor

</span>
                </h5>
                <span class="property-price">
<i class="fas fa-calendar" aria-hidden="true" style="color:blue"></i>
            {{trans('messages.Check_in')}}:
<span class="span-date">
{{$segment->getCheckInFormate()}}

</span>
            {{trans('messages.Check_out')}}:

<span class="span-date">
{{$segment->getCheckOutFormate()}}

</span>
</span>
            </div>
            <div class="col-md-12 col-xs-12 col-sm-12 padding-top-10">
                {!! $segment->hotel->info !!}
            </div>
        </li>
        @endforeach
        @endif
    </ul>
</div>
