@if($hotelPricings)
    <div class="col-xs-12 mar-t-10" style="padding: 0px;">
        <h1 class="s-property-title slide" data-toggle="collapse"
            data-target="#holiday_pricing">
            <i class="fas fa-minus first"></i>
            {{trans('messages.Holiday_Price_start_from')}} {{ $hotelPackage->price }}
            {{trans('messages.this_currency')}}
        </h1>

        <!--<div class="s-property-content panel-collapse fqa-body"-->
        <!--     id="holiday_pricing">-->
        <!--    <div class="table-responsive prcTable">-->
        <!--        <table class="grid highlight info-table" width="100%">-->
        <!--            <thead></thead>-->
        <!--            <tbody>-->
        <!--            @foreach($hotelPricings as $hotelPricing)-->
        <!--                <tr>-->
        <!--                    <td class="dec">-->
        <!--                        {{$hotelPricing->cost}}-->
        <!--                    </td>-->
        <!--                    <td class="dec"-->
        <!--                        style="color: #6fbfaa;font-weight: bold">-->
        <!--                        {{$hotelPricing->value}}-->
        <!--                        {{trans('messages.this_currency')}}-->
        <!--                    </td>-->
        <!--                </tr>-->
        <!--            @endforeach-->
        <!--            </tbody>-->
        <!--        </table>-->
        <!--    </div>-->
        <!--</div>-->
    </div>
@endif
@if($hotelPricings)
<table class="table table-responsive table-active table-hover">
  <tbody>
    <tr>
        @foreach($hotelPricings as $hotelPricing)
      <td scope="row" class="table-light"> {{$hotelPricing->cost}}</td>
     <td scope="row" class="bg-success"> {{$hotelPricing->value." ".trans('messages.this_currency')}}</td>
    </tr>
    
   @endforeach
    
  </tbody>
</table>
@endif