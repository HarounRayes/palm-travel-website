<div class="box-two proerty-item recent-property-widget package-box">
    <ul>
        <li class="p-0">
            <div class="item-thumb ">
                @if($package->defaultHotel())
                    <a href="{{route('details',['symbol' => $package->symbol,'hotel' => $package->defaultHotel()->symbol])}}"
                       style="cursor: pointer">
                        <img alt="" class="package-img" src="{{url('storage/app/public/images/package/'.$package->image)}}">
                    </a>
                @else
                    <a href="#" style="cursor: pointer">
                        <img alt="" class="package-img" src="{{url('storage/app/public/images/package/'.$package->image)}}">
                    </a>
                @endif
                <span class="property-seeker wow bounceInRight ">
                    @if ($package->labels)
                        @foreach ($package->labels as $label)
                            @if ($label->value != '')
                                <b class="b-2" style="font-size: 25px; background-color:{{$label->color}};">
                                  {{$label->value}}
                                </b>
                                <br><br>
                            @endif
                        @endforeach
                    @endif
                </span>
            </div>
        </li>
    </ul>
    <div class="item-entry overflow">
        <h5>
            {{$package->name}}
            @if(Auth::guard('member')->check())
                @if(in_array($package->id , Auth::guard('member')->user()->favorites_ids()))
                    <b class="basket-icon active">
                        <a href="#"
                           onclick="DeleteFavoritePackage('{{$package->id}}','{{Auth::guard('member')->id()}}')"
                           title="{{trans('messages.delete_from_favorites')}}">
                            <img src="{{ asset('img/star-remove.png') }}" style="width:30px;"/>
                        </a>
                    </b>
                @else
                    <b class="basket-icon">
                        <a href="#" onclick="AddFavoritePackage('{{$package->id}}' ,'{{Auth::guard('member')->id()}}')"
                           title="{{trans('messages.add_to_favorites')}}">
                            <img src="{{asset('img/bookmark_add.png')}}" style="width:30px;"/>
                        </a>
                    </b>
                @endif
            @else
                <b class="basket-icon">
                    <a href="#" onclick="AddFavoritePackage('{{$package->id}}' ,'0')"
                       title="{{trans('messages.add_to_favorites')}}">
                        <img src="{{asset('img/bookmark_add.png')}}" style="width:30px;"/>
                    </a>
                </b>
            @endif
        </h5>
        <style>
            .package-info{
  /*border:1px solid;*/
  position:relative;
  height:200px;
}
.package-info-text{
  height:20px;
}
.package-info-text2{
  height:20px;
}
.package-info-text:nth-child(4)~.package-info-text{
  left:100px;
  top:-80px;
  position:relative;  
}
        </style>
        <ul class="package-info">
            @if (isset($package->flight) && $package->flight == '1')
                <li>
           <span class="package-info-text">
{{trans('messages.Flight')}}
          </span>

                    <span class="package-info-text2">
         {{trans('messages.Included')}}
          </span>
                    <img class="package-info-img" src="{{asset('frontend/img/tick-inc.png')}}" width="25">

                </li>
            @endif
            @if (isset($package->hotels) && $package->hotels == '1')
                <li> <span class="package-info-text">
          {{trans('messages.Hotel')}}
          </span> <span class="package-info-text2">
          {{trans('messages.Included')}}
          </span> <img class="package-info-img" src="{{asset('frontend/img/tick-inc.png')}}" width="25"></li>
            @endif
            @if (isset($package->transfer) && $package->transfer == '1')
                <li> <span class="package-info-text">
          {{trans('messages.Transfers')}}
          </span> <span class="package-info-text2">
          {{trans('messages.Included')}}
          </span> <img class="package-info-img" src="{{asset('frontend/img/tick-inc.png')}}" width="25"></li>
            @endif
            @if (isset($package->activity) && $package->activity == '1')
                <li> <span class="package-info-text">
           {{trans('messages.Activity')}}
          </span> <span class="package-info-text2">
          {{trans('messages.Included')}}
          </span> <img class="package-info-img" src="{{asset('frontend/img/tick-inc.png')}}" width="25"></li>
            @endif

        </ul>
        <hr style="margin: 8px 0;">
        <div class="col-md-12 col-xs-12 no-padding">
            @if($package->packageHotels)
                @foreach($package->packageHotels as $hotel)
                        <?php
                        if (count($package->packageHotels) == 1) {
                            $col = 'col-md-12 col-sm-12 col-xs-12';
                        } elseif (count($package->packageHotels) == 2) {
                            $col = 'col-md-6 col-sm-6 col-xs-6';
                        } else {
                            $col = 'col-md-4 col-sm-4 col-xs-4';
                        }

                        if ($hotel->sold_out == '1') {
                            $sold_class = 'sold-hotel';
                        } else {
                            $sold_class = '';
                        }
                        ?>
                    <div class="hotel-buttom-area <?= $col ?> <?= $sold_class ?> center hotel-button wow fadeInLeft ">
                        <div class="hotel-button-details " data-hotel="{{$hotel->hotel_id}}">
                            @if ($hotel->sold_out == '1')
                                <a href="#"
                                   class="disabled-href">
                                    @else
                                        <a href="{{route('details',['symbol' => $package->symbol,'hotel' => $hotel->hotel->symbol])}}">
                                            @endif
                                            <div class="hotel-stars">
                                    <span style="color: #fff">
                                        {{$hotel->hotel->star_rate}}

                                    </span>
                                                <span>
                                        @for ($k = 1; $k < 6; $k++)
                                                        @if ($hotel->hotel->star_rate >= $k)
                                                            <i class="fas fa-star" aria-hidden="true"></i>
                                                        @endif
                                                    @endfor
                                    </span>
                                            </div>
                                            <div class="hotel-price">
                                                <span class="price"> <?= $hotel->price ?> </span>
                                                <span class="price-currency">
                                       {{trans('messages.this_currency')}}
                                    </span>
                                            </div>
                                            <div class="hotel-view">
                                    <span>
                                   {{trans('messages.View_details_2')}}
                                    </span>
                                            </div>
                                        </a>
                        </div>

                            <?php if ($hotel->sold_out == '1') { ?>
                        <div style="width: 100%">
                            <div class="sold-slide-in" id="sold-slide-in-<?= $hotel->hotel->id ?>">
                                <div class="text">
                                    {{trans('messages.sold_out')}}
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
