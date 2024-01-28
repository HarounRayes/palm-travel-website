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
<table class="table table-striped table-hover border" style="border: 2px solid rgba(128, 128, 128, 0.178)">
  <thead class="thead-dark bg-primary">
    <th>###</th>
    <th>$</th>
  </thead>
    <tbody>
      @foreach($hotelPricings as $hotelPricing)
        <tr>
          <td scope="row" class="table-light"> {{$hotelPricing->cost}}</td>
          <td scope="row" class=""> {{$hotelPricing->value." ".trans('messages.this_currency')}}</td>
        </tr>
      @endforeach
    </tbody>
</table>
@endif