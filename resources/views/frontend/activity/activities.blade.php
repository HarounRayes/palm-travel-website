@extends('layouts.app')

@section('content')
    @if($info->header_image != '')
        <div class="page-head" style="
            background-image: url({{url('storage/app/public/images/info/'.$info->header_image)}});
            background-size: cover;
            background-position: center;">
        </div>
    @else
        <div class="page-head" style="background-color: #b0a579;">
        </div>
    @endif
    @if (Cookie::get('activity_cart'))
        @php
            $cookie_data = stripslashes(Cookie::get('activity_cart'));
            $cart_data = json_decode($cookie_data, true);
            $items_id_list = array_column($cart_data, 'id');
        @endphp
    @endif
    <form method="get" action="{{route('activity.search')}}">
        <!-- property area -->
        <div class="content-area home-area-1 recent-property" style="background-color: #ECECEC; padding-bottom: 55px;">

            <div class="container">
                @include('frontend.activity.activitySearchBox')

                <div class="row">
                    <div class="col-md-12 col-sm-12 text-center page-title page-title-home p-b-15">
                        {!! $info->intro !!}
                    </div>
                </div>
                <div class="row">
                    <div class="proerty-th">
                        <div class="similar-post-section">
                            <div class="col-md-3 col-sm-4">
                                @include('frontend.activity.activityFilterBox')

                            </div>
                            <div class='col-md-9 col-sm-8 col-xs-12'>
                                @if ($activities && $activities->count() > 0)
                                    @foreach ($activities as $activity)
                                        <div class="row m-b-15">
                                            <div class="activity-view-box">

                                                <div class="col-xs-3 no-padding">
                                                    <img class="cursor_pointer"
                                                         src="{{url('storage/app/public/images/activity/'.$activity->image)}}"
                                                         onclick="ViewActivity({{$activity->id}})"/>
                                                </div>
                                                <div class="col-xs-9">
                                                    <h4 class="cursor_pointer"
                                                        onclick="ViewActivity({{$activity->id}})">
                                                        <b>{{$activity->name}}</b></h4>
                                                    <p>{!! $activity->intro !!}</p>
                                                    <a class="btn-search-submit cursor_pointer" style="padding: 5px 10px"
                                                       onclick="ViewActivity({{$activity->id}})">
                                                    {{trans('messages.see-more')}} </a>
                                                </div>
                                            </div>
                                            @if ($activity->categories)

                                                <div class="activity-category-box">

                                                    @foreach ($activity->categories as $category)

                                                        <div class="col-md-12 col-xs-12 activity-category-box-row">
                                                            <div class="col-xs-3 flex-clolumn">
                                                                <h5 style="margin: 15px 0">{{$category->category->name}}</h5>
                                                            </div>
                                                            <div class="col-xs-3 flex-clolumn">
                                                                @if ($category->type == 'shared')
                                                                    <p><b>{{trans('messages.Adults')}}
                                                                            : </b>{{$category->adult_price}} {{trans('messages.this_currency')}}
                                                                    </p>
                                                                    @if (in_array(6,$ageChild) || in_array(7,$ageChild) || in_array(8,$ageChild) || in_array(9,$ageChild) || in_array(10,$ageChild) || in_array(11,$ageChild))
                                                                        <p><b> {{trans('messages.Child')}}
                                                                                6-11: </b>{{$category->child_6_11_price}} {{trans('messages.this_currency')}}
                                                                        </p>
                                                                    @endif
                                                                    @if (in_array(3,$ageChild) || in_array(4,$ageChild) || in_array(5,$ageChild))
                                                                        <p><b> {{trans('messages.Child')}}
                                                                                3-5: </b>{{$category->child_3_5_price}} {{trans('messages.this_currency')}}
                                                                        </p>
                                                                    @endif
                                                                    @if (in_array(1,$ageChild) || in_array(2,$ageChild))
                                                                        <p><b> {{trans('messages.infant')}}
                                                                                0-2: </b>{{$category->infant_price}} {{trans('messages.this_currency')}}
                                                                        </p>
                                                                    @endif
                                                                @else
                                                                    @if($numberPerson <= 4)
                                                                        <p><b>1-4 {{trans('messages.Person')}}
                                                                                : </b>{{$category->person_1_4_price}}  {{trans('messages.this_currency')}}
                                                                        </p>
                                                                    @elseif($numberPerson <=8)
                                                                        <p><b>1-8 {{trans('messages.Person')}}
                                                                                : </b>{{$category->person_1_8_price}}  {{trans('messages.this_currency')}}
                                                                        </p>
                                                                    @elseif($numberPerson > 8)
                                                                        <p><b>1-12 {{trans('messages.Person')}}
                                                                                : </b>{{$category->person_1_12_price}} {{trans('messages.this_currency')}}
                                                                        </p>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                            <div class="col-xs-2 flex-clolumn"
                                                                 style="flex-direction: column;">
                                                                <label>{{trans('messages.Date1')}}</label>
                                                                @if(isset($cart_data) && in_array($category->id , $items_id_list))
                                                                    <select name="date-activity-{{ $category->id }}"
                                                                            id="date-activity-{{ $category->id }}"
                                                                            class="date-activity selectpicker-activity date-activity-{{ $category->id }}"
                                                                            title="{{trans('messages.Select')}}"
                                                                            tabindex="-98" disabled>
                                                                        @if($period)
                                                                            @foreach ($period as $date)
                                                                                <option
                                                                                    {{$date->format('Y-m-d')==$cart_data[$category->id]['date']?"selected":""}} value="{{ $date->format('Y-m-d')}}">
                                                                                    {{ $date->format('Y-m-d')}}
                                                                                </option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                @else
                                                                    <select name="date-activity-{{ $category->id }}"
                                                                            id="date-activity-{{ $category->id }}"
                                                                            class="date-activity selectpicker-activity date-activity-{{ $category->id }}"
                                                                            title="{{trans('messages.Select')}}"
                                                                            tabindex="-98">
                                                                        @if($period)
                                                                            @foreach ($period as $date)
                                                                                <option
                                                                                    value="{{ $date->format('Y-m-d')}}">
                                                                                    {{ $date->format('Y-m-d')}}
                                                                                </option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                @endif
                                                            </div>
                                                            <div class="col-xs-2 flex-clolumn">
                                                                <h4>{{$activity->totalPrice((request()->adult)?request()->adult:0,$numberPerson,$ageChild,$activity->id , $category->category->id)}}{{trans('messages.this_currency')}}</h4>
                                                            </div>
                                                            <div class="col-xs-2 flex-clolumn no-padding">
                                                                @if(isset($cart_data) && in_array($category->id , $items_id_list))

                                                                    <div class="span-added-card">
                                                                        <i class="fa fa-check"></i>
                                                                        {{trans('messages.added-to-cart')}}
                                                                    </div>
                                                                    <i class="fa fa-trash delete-from-cart"
                                                                       onclick="deleteActivityFromCard({{$category->id}})"
                                                                       title="{{trans('messages.delete-from-cart')}}"></i>
                                                                @else
                                                                    <i class="fa fa-shopping-basket"></i>
                                                                    <a class="btn btn-add-card"
                                                                       onclick="addActivityToCard({{$category->id}},{{$activity->id}},{{$category->activity_category_id}},{{$activity->totalPrice((request()->adult)?request()->adult:0,$numberPerson,$ageChild,$activity->id , $category->category->id)}},'0')">
                                                                        {{trans('messages.add-to-cart')}}
                                                                    </a>
                                                                @endif

                                                            </div>
                                                        </div>
                                                    @endforeach
                                                        <div class="col-md-12 col-xs-12 titles">
                                                            <div class="col-xs-3">
                                                                {{trans('messages.Category')}}
                                                            </div>
                                                            <div class="col-xs-3">
                                                                {{trans('messages.Price-Person')}}
                                                            </div>
                                                            <div class="col-xs-2">
                                                                {{trans('messages.Date')}}
                                                            </div>
                                                            <div class="col-xs-2">
                                                                {{trans('messages.total-price')}}
                                                            </div>
                                                            <div class="col-xs-2">
                                                                <br>
                                                            </div>
                                                        </div>
                                                </div>



                                                <div class="activity-category-box-mobile">
                                                    @foreach ($activity->categories as $category)

                                                        <div class="row activity-category-box-mobile-row">
                                                            <div
                                                                class="col-xs-4 titles"> {{trans('messages.Category')}}</div>
                                                            <div class="col-xs-8 "><h5
                                                                    style="margin: 15px 0">{{$category->category->name}}</h5>
                                                            </div>
                                                        </div>
                                                        <div class="row activity-category-box-mobile-row">
                                                            <div
                                                                class="col-xs-4 titles"> {{trans('messages.Price-Person')}}</div>
                                                            <div class="col-xs-8">
                                                                @if ($category->type == 'shared')
                                                                    <p><b>{{trans('messages.Adults')}}
                                                                            : </b>{{$category->adult_price}} {{trans('messages.this_currency')}}
                                                                    </p>
                                                                    @if (in_array(6,$ageChild) || in_array(7,$ageChild) || in_array(8,$ageChild) || in_array(9,$ageChild) || in_array(10,$ageChild) || in_array(11,$ageChild))
                                                                        <p><b> {{trans('messages.Child')}}
                                                                                6-11: </b>{{$category->child_6_11_price}} {{trans('messages.this_currency')}}
                                                                        </p>
                                                                    @endif
                                                                    @if (in_array(3,$ageChild) || in_array(4,$ageChild) || in_array(5,$ageChild))
                                                                        <p><b> {{trans('messages.Child')}}
                                                                                3-5: </b>{{$category->child_3_5_price}} {{trans('messages.this_currency')}}
                                                                        </p>
                                                                    @endif
                                                                    @if (in_array(1,$ageChild) || in_array(2,$ageChild))
                                                                        <p><b> {{trans('messages.infant')}}
                                                                                0-2: </b>{{$category->infant_price}} {{trans('messages.this_currency')}}
                                                                        </p>
                                                                    @endif
                                                                @else
                                                                    @if($numberPerson <= 4)
                                                                        <p><b>1-4 {{trans('messages.Person')}}
                                                                                : </b>{{$category->person_1_4_price}}  {{trans('messages.this_currency')}}
                                                                        </p>
                                                                    @elseif($numberPerson <=8)
                                                                        <p><b>1-8 {{trans('messages.Person')}}
                                                                                : </b>{{$category->person_1_8_price}}  {{trans('messages.this_currency')}}
                                                                        </p>
                                                                    @elseif($numberPerson > 8)
                                                                        <p><b>1-12 {{trans('messages.Person')}}
                                                                                : </b>{{$category->person_1_12_price}} {{trans('messages.this_currency')}}
                                                                        </p>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row activity-category-box-mobile-row">
                                                            <div
                                                                class="col-xs-4 titles"> {{trans('messages.Date')}}</div>
                                                            <div class="col-xs-8">
                                                                @if(isset($cart_data) && in_array($category->id , $items_id_list))
                                                                    <select
                                                                        id="date-activity-mobile-{{ $category->id }}"
                                                                        class="date-activity selectpicker-activity"
                                                                        title="{{trans('messages.Select')}}"
                                                                        tabindex="-98" disabled>
                                                                        @if($period)
                                                                            @foreach ($period as $date)
                                                                                <option
                                                                                    {{$date->format('Y-m-d')==$cart_data[$category->id]['date']?"selected":""}} value="{{ $date->format('Y-m-d')}}">
                                                                                    {{ $date->format('Y-m-d')}}
                                                                                </option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                @else
                                                                    <select
                                                                        id="date-activity-mobile-{{ $category->id }}"
                                                                        class="date-activity selectpicker-activity"
                                                                        title="{{trans('messages.Select')}}"
                                                                        tabindex="-98">
                                                                        @if($period)
                                                                            @foreach ($period as $date)
                                                                                <option
                                                                                    value="{{ $date->format('Y-m-d')}}">
                                                                                    {{ $date->format('Y-m-d')}}
                                                                                </option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                @endif

                                                            </div>
                                                        </div>
                                                        <div class="row activity-category-box-mobile-row">
                                                            <div
                                                                class="col-xs-4 titles"> {{trans('messages.total-price')}}</div>
                                                            <div class="col-xs-8">
                                                                <h4>{{$activity->totalPrice((request()->adult)?request()->adult:0,$numberPerson,$ageChild,$activity->id , $category->category->id)}}{{trans('messages.this_currency')}}</h4>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="row activity-category-box-mobile-row border-bottom-blue">
                                                            <div class="col-xs-4 titles"></div>
                                                            <div class="col-xs-8 activity-card-mobile"
                                                                 style="padding: 15px">
                                                                @if(isset($cart_data) && in_array($category->id , $items_id_list))
                                                                    <div class="span-added-card">
                                                                        <i class="fa fa-check"></i>
                                                                        {{trans('messages.added-to-cart')}}
                                                                    </div>
                                                                    <i class="fa fa-trash delete-from-cart"
                                                                       onclick="deleteActivityFromCard({{$category->id}})"
                                                                       title="{{trans('messages.delete-from-cart')}}"></i>
                                                                @else
                                                                    <i class="fa fa-shopping-basket"></i>
                                                                    <a class="btn btn-add-card"
                                                                       onclick="addActivityToCard({{$category->id}},{{$activity->id}},{{$category->activity_category_id}},{{$activity->totalPrice((request()->adult)?request()->adult:0,$numberPerson,$ageChild,$activity->id , $category->category->id)}},'1')">
                                                                        {{trans('messages.add-to-cart')}}
                                                                    </a>
                                                                @endif

                                                            </div>
                                                        </div>

                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                @else
                                    <label class="activity-label label label-info text-center">
                                        {{trans('messages.no-tours')}}
                                    </label>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
    <div class="modal left fade tour-list" id="myModalActivity" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">
                        {{trans('messages.Add_tour')}}
                    </h4>
                </div>
                <div class="modal-body"></div>
            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div><!-- modal -->

@endsection
