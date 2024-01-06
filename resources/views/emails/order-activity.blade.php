<div class="col-md-12 col-xs-12 col-sm-12">
    <h1>Activity Order from Palmoasis Holidays</h1>
    @php $i=1 ; @endphp
    @foreach($order->card as $card)
        <h4>Tour {{$i}}</h4>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-4">
                Activity Name:
            </label>
            <label class="control-label col-md-2 col-sm-3 col-xs-4">
                {{$card->activity->name_en}}
            </label>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-4">
                Activity Type:
            </label>
            <label class="control-label col-md-2 col-sm-3 col-xs-4">
                {{$card->category->name_en}}
            </label>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-4">
                Pick up Point:
            </label>
            <label class="control-label col-md-2 col-sm-3 col-xs-4">
                {{$card->pick_up}}
            </label>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-4">
                Drop off Point:
            </label>
            <label class="control-label col-md-2 col-sm-3 col-xs-4">
                {{$card->drop_off}}
            </label>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-4">
                Name:
            </label>
            <label class="control-label col-md-2 col-sm-3 col-xs-4">
                {{$card->people[0]->first_name.' '.$card->people[0]->last_name}}
            </label>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-4">
                Number of Persons:
            </label>
            <label class="control-label col-md-2 col-sm-3 col-xs-4">
                {{$card->number_of_person()}}
            </label>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-4">
                Mobile Number:
            </label>
            <label class="control-label col-md-2 col-sm-3 col-xs-4">
                {{$card->mobile}}
            </label>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-4">
                Email:
            </label>
            <label class="control-label col-md-2 col-sm-3 col-xs-4">
                {{$card->email}}
            </label>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-4">
                Price:
            </label>
            <label class="control-label col-md-2 col-sm-3 col-xs-4">
                {{$card->price}}
            </label>
        </div>
        <hr>
        @php $i++; @endphp
    @endforeach
    <div class="form-group">
        <label class="control-label col-md-2 col-sm-3 col-xs-4">
           Total Price:
        </label>
        <label class="control-label col-md-2 col-sm-3 col-xs-4">
            {{$order->total_price()}}
        </label>
    </div>
</div>

