@if($nationalities->count() != 0)
    <div class="col-12">
        <label>Country nationalities</label>
    </div>
    @foreach($nationalities as $nationality)
        <div class="col-4 col-md-4">
            <section class="section-preview" style="border: 1px solid #e0e0e0;padding: 15px;">
                <!-- Default checked -->
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="defaultChecked2-{{$nationality->id}}" name="visanationality[{{$nationality->id}}]" value="{{$nationality->visa_nationality_id}}">
                    <label class="custom-control-label" for="defaultChecked2-{{$nationality->id}}">
                        {{$nationality->nationality->name_en}}
                    </label>
                    <input type="number" class="form-control custom-control-input-number" placeholder="Price" name="visanationalityprice[{{$nationality->id}}]"/>
                </div>
            </section>
        </div>
    @endforeach
@else
    <div class="col-12">
        <label>No Natiolaity</label>
    </div>
@endif
