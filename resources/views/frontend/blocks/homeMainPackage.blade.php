
<div class="box-two proerty-item recent-property-widget">
    <ul>
        <li>
            <div class="item-thumb ">
                @if($package->defaultHotel())
                    <a href="{{route('details',['symbol' => $package->symbol,'hotel' => $package->defaultHotel()->symbol])}}"
                       style="cursor: pointer">
                        <style>
                            .image_container_edit {
                              position: relative;
                              width: 360px;
                              height: 220px;
                              margin-top: 10px;
                              background: rgba(0, 0, 0, 0);
                              transform: rotate(-5deg) skew(5deg) scale(0.8);
                              transition: 0.5s;
                            }
                            .image_container_edit img {
                              position: absolute;
                              /*width: 100%;*/
                              transition: 0.5s;
                            }
                            .image_container_edit:hover img:nth-child(4) {
                              transform: translate(160px, -160px);
                              opacity: 1;
                            }
                            .image_container_edit:hover img:nth-child(3) {
                              transform: translate(120px, -120px);
                              opacity: 0.8;
                            }
                            .image_container_edit:hover img:nth-child(2) {
                              transform: translate(80px, -80px);
                              opacity: 0.6;
                            }
                            .image_container_edit:hover img:nth-child(1) {
                              transform: translate(40px, -40px);
                              opacity: 0.4;
                            }
                        </style>
                        <div class="image_container_edit">
                            <img src="{{url('storage/app/public/images/package/'.$package->image)}}">
                        </div>
                        
                    </a>
                @else
                    <a href="#" style="cursor: pointer">
                        
                        <div class="image_container_edit">
                            <img src="{{url('storage/app/public/images/package/'.$package->image)}}">
                        </div>
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
        <h6>
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
        </h6>
        <h1 class="s-property-title">
            {{trans('messages.Inclusions')}}
        </h1>
        <center style="padding-left: 0%;">
            @if (isset($package->flight) && $package->flight == '1')
                <span class="proerty-price o-pull-left-en o-pull-right-ar">
                    <b>
                        <div class=" wow bounceInRight details-option-div" data-wow-delay="0.45s" data-toggle="tooltip"
                             data-placement="bottom"
                             title="{{trans('messages.Flight')}}">
                            <i class="fas fa-plane" aria-hidden="true"></i>
                           {{trans('messages.Flight')}}
                        </div>
                    </b>
                </span>
            @endif
            @if (isset($package->hotels) && $package->hotels == '1')
                <span class="proerty-price o-pull-left-en o-pull-right-ar">
                    <b>
                        <div class=" wow bounceInRight details-option-div" data-wow-delay="0.45s" data-toggle="tooltip"
                             data-placement="bottom"
                             title="{{trans('messages.Hotel')}}">
                            <i class="fas fa-bed" aria-hidden="true"></i>
                            {{trans('messages.Hotel')}}
                        </div>
                    </b>
                </span>
            @endif
            @if (isset($package->transfer) && $package->transfer == '1')
                <span class="proerty-price o-pull-left-en o-pull-right-ar">
                    <b>
                        <div class="wow bounceInRight details-option-div" data-wow-delay="0.45s"
                             title="{{trans('messages.Transfers')}}">
                            <i class="fas fa-car" aria-hidden="true"></i>
                         {{trans('messages.Transfers')}}
                        </div>
                    </b>
                </span>
            @endif
            @if (isset($package->activity) && $package->activity == '1')
                <span class="proerty-price o-pull-left-en o-pull-right-ar">
                    <b>
                        <div class="wow bounceInRight details-option-div" data-wow-delay="0.45s"
                             title="{{trans('messages.Activity')}}">
                            <img src="{{asset('frontend/img/icon/activites.png')}}"
                                 style="width:17px;display: inline-block"/>
                            {{trans('messages.Activity')}}
                        </div>
                    </b>
                </span>
            @endif
        </center>
        <br>
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
