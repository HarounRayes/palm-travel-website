@extends('layouts.app')

@section('content')
    @if(Cookie::get('activity_cart'))
        @php
            $cookie_data = stripslashes(Cookie::get('activity_cart'));
            $cart_data = json_decode($cookie_data, true);
            $totalcart = count($cart_data);
            $total_cart_price =0;
        @endphp
        @foreach($cart_data as $cart)
            @php
                $total_cart_price += $cart['price'];;
            @endphp
        @endforeach
    @else
        @php
            $total_cart_price=0;
            $totalcart =0;
        @endphp
    @endif
    <div class="content-area home-area-1 recent-property" style="background-color: #fff;">
        <div class="container">

            <div class="row">
                <div class="page-head-cart">
                    <h2> {{trans('messages.Your-Cart')}} </h2>
                    <span>{{$totalcart}} {{trans('messages.Activities-Added-to-Your-Cart')}}</span>
                </div>
            </div>
            <div class="row">
                <div class="proerty-th">
                    <div class="cart-container">
                        <form method="post" action="{{route('activity.card')}}">
                            @csrf

                            <div class="col-md-8 col-sm-8 ">
                                @if(isset($cart_data) && $cart_data)
                                    @foreach($cart_data as $cart)
                                        @php
                                            $cart_activity = \App\ActivityTour::find($cart['activity_id']);
                                            $cart_activity_tour_category = \App\ActivityTourCategory::find($cart['id']);
                                        @endphp
                                        <input type="hidden" id="main_passenger"
                                               name="person[{{$cart['id']}}][main_passenger]" value="1"/>
                                        <div class="row ">
                                            <div class="col-xs-12">
                                                <div class="activity-cart-view-box">
                                                    <a class="delete"
                                                       onclick="deleteActivityFromCard('{{$cart['id']}}')">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                    <div class="activity-cart-details-bar">
                                                        <div class="col-md-3 col-sm-4 col-xs-12 no-padding">
                                                            <img
                                                                src="{{url('storage/app/public/images/activity/'.$cart_activity->image)}}"/>
                                                        </div>
                                                        <div class="col-md-9 col-sm-8 col-xs-12">
                                                            <h3>{{$cart_activity->name}}</h3>
                                                            <p><b> {{trans('messages.Booking-Date')}}
                                                                    : </b>{{$cart['created_at']}}</p>
                                                            <p><b> {{trans('messages.Activity-Date')}}
                                                                    : </b>{{$cart['date']}}</p>
                                                            <p><b> {{trans('messages.Number-of-Person')}}
                                                                    : </b>{{$cart['adult']}}  {{trans('messages.Adults')}}
                                                                , {{$cart['child']}} {{trans('messages.Child')}}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="activity-cart-deadline-bar">
                                                        <div class="col-xs-12">
                                                            {!! $cart_activity->deadline !!}
                                                        </div>
                                                        <div class="col-md-6 col-sm-6 col-xs-6"></div>
                                                    </div>
                                                    <div class="activity-cart-price-bar">
                                                        <p><span>{{trans('messages.total-net-amount')}}: </span> <span
                                                                class="bold"> {{$cart['price']}} {{trans('messages.this_currency')}}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row m-b-15">
                                            <div class="col-xs-12">
                                                <div class="activity-cart-view-box" style="padding:5px 15px 15px;">
                                                    <div class="radio" style="display: inline-block">
                                                        <label class="no-padding">
                                                            <input class="checked-person-type"
                                                                   name="person_main_{{$cart['id']}}"
                                                                   data-card="{{$cart['id']}}"
                                                                   type="radio" value="1" checked="" data-number="1">
                                                            {{trans('messages.Enter-the-lead')}}
                                                        </label>
                                                    </div>
                                                    <div class="radio" style="display: inline-block">
                                                        <label class="no-padding">
                                                            <input class="checked-person-type"
                                                                   name="person_main_{{$cart['id']}}"
                                                                   data-card="{{$cart['id']}}"
                                                                   type="radio" value="0"
                                                                   data-number="{{$cart['adult']}}">
                                                            {{trans('messages.enter-all-data')}}
                                                        </label>
                                                    </div>


                                                    <div class=" info-section-{{$cart['id']}}"
                                                         id="lead-info-{{$cart['id']}}">
                                                        <input type="hidden"
                                                               name="person[{{$cart['id']}}][main_passenger]"
                                                               value="1">
                                                        <h4>{{trans('messages.Lead-passenger')}}</h4>
                                                        <div class="row">
                                                            <div class="col-xs-6">
                                                                <label>{{trans('messages.Name')}}</label>
                                                                <input
                                                                    name="person[{{$cart['id']}}][firstname][0]"
                                                                    type="text"
                                                                    class="form-control"
                                                                    placeholder="{{trans('messages.Name')}}"/>
                                                            </div>
                                                            <div class="col-xs-6">
                                                                <label>{{trans('messages.Surname')}}</label>
                                                                <input
                                                                    name="person[{{$cart['id']}}][lastname][0]"
                                                                    type="text"
                                                                    class="form-control"
                                                                    placeholder="{{trans('messages.Surname')}}"
                                                                />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <hr>
                                                        @if($cart_activity_tour_category->type == 'private' && !$cart_activity_tour_category->private_is_shared)
                                                            <div class="col-xs-6 col-md-6">
                                                                <label>{{trans('messages.pick-up2')}}</label>
                                                                <input name="info[{{$cart['id']}}][pick_up]"
                                                                       type="text" class="form-control"
                                                                       placeholder="{{trans('messages.Hotel-name')}}"/>
                                                            </div>
                                                            <div class="col-xs-6 col-md-6">
                                                                <label>{{trans('messages.drop-off2')}}</label>
                                                                <input name="info[{{$cart['id']}}][drop_off]"
                                                                       type="text" class="form-control"
                                                                       placeholder="{{trans('messages.Hotel-name')}}"/>
                                                            </div>
                                                        @endif
                                                        <div class="col-xs-6 col-md-6">
                                                            <label>{{trans('messages.Email')}}</label>
                                                            <input name="info[{{$cart['id']}}][email]"
                                                                   type="email" class="form-control" required
                                                                   placeholder="{{trans('messages.Email')}}"/>
                                                        </div>
                                                        <div class="col-xs-6 col-md-6">
                                                            <label>{{trans('messages.Country-Code')}}</label>
                                                            <input name="info[{{$cart['id']}}][country_code]"
                                                                   type="text" class="form-control" required
                                                                   placeholder="{{trans('messages.Country-Code')}}"/>
                                                        </div>
                                                        <div class="col-xs-6 col-md-6">
                                                            <label>{{trans('messages.Mobile')}}</label>
                                                            <input name="info[{{$cart['id']}}][mobile]"
                                                                   type="text" class="form-control" required
                                                                   placeholder="{{trans('messages.Mobile')}}"/>
                                                        </div>
                                                        @if($cart_activity_tour_category->type == 'shared' && $cart_activity_tour_category->shared_note != '')
                                                            <div class="col-xs-12 col-md-12">
                                                                <h4 style="color: #ce0505">{{trans('Note')}}</h4>
                                                                <p>{{$cart_activity_tour_category->shared_note}}</p>
                                                            </div>

                                                        @elseif($cart_activity_tour_category->type == 'private' && $cart_activity_tour_category->private_is_shared)
                                                            <div class="col-xs-12 col-md-12">
                                                                <h4 style="color: #ce0505">{{trans('Note')}}</h4>
                                                                <p>{{$cart_activity_tour_category->private_note}}</p>
                                                            </div>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <label class="activity-label label label-info text-center">
                                        {{trans('messages.no-tours')}}
                                    </label>
                                @endif
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="row ">
                                    <div class="col-xs-12">
                                        <div class="activity-cart-view-box">
                                            <table>
                                                <thead>
                                                <th> {{trans('messages.Services')}}</th>
                                                <th> {{trans('messages.Net-Price')}}</th>
                                                </thead>
                                                <tbody>
                                                @if(isset($cart_data) && $cart_data)
                                                    @foreach($cart_data as $cart)
                                                        @php
                                                            $cart_activity = \App\ActivityTour::find($cart['activity_id']);
                                                        @endphp
                                                        <tr>
                                                            <td>{{$cart_activity->name}}</td>
                                                            <td>{{$cart['price']}}</td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div
                                        class="col-xs-12 {{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">

                                    {!! RecaptchaV3::field('activities') !!}
                                    @if ($errors->has('g-recaptcha-response'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                                    @endif

                                </div>
                                <div class="col-xs-12">
                                    <div class="activity-checkout-view-box">

                                        <p>
                                            {{trans('messages.Total-net-price-to-pay')}}:
                                            <span class="bold" style="font-size: 18px">
                                                    {{$total_cart_price}} {{trans('messages.this_currency')}}</span>
                                        </p>
                                        @if(Cookie::get('activity_cart') && $total_cart_price)
                                            <p style="text-align: unset;">
                                                <input class="" type="checkbox" required/>
                                                {{trans('messages.I-have-read-and-accept')}}
                                            </p>

                                            <p>
                                                <input class="btn btn-primary" type="submit" name="activity_submit"
                                                       value="{{trans('messages.Send-Enquiry')}}">
                                                @if (Config::get('global_models.activity-checkout') == '1')
                                                    <input class="btn btn-primary" type="submit"
                                                           name="activity_checkout"
                                                           value="{{trans('messages.Checkout')}}">
                                                @endif
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>

            </div>

        </div>

    </div>
    </div>
@endsection
