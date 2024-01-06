<div class="card card-default div-hotel">
    <div class="card-header">
        <h5 class="card-title">
            {{$hotel->name_en}} {{($count_hotel+1)}}
            <input type="hidden" name="hotel[hotel_id][]" value="{{$hotel->id}}">
        </h5>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget-custom="remove"><i class="fas fa-times"></i></button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Start Price</label>
                    <input class="form-control" type="number" min="1" name="hotel[price][]">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Check In</label>
                    <input class="form-control datepicker-{{$hotel->id}}" id="check-in-datepicker-hotel-{{$count_hotel}}-{{$hotel->id}}" type="text" name="hotel[check_in][]">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Check out</label>
                    <input class="form-control datepicker-{{$hotel->id}}" id="check-out-datepicker-hotel-{{$count_hotel}}-{{$hotel->id}}" type="text" name="hotel[check_out][]">
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="form-group clearfix">
                        <div class="icheck-primary d-inline">
                            <input type="checkbox" id="checkboxPrimary1{{$count_hotel}}" name="hotel[bookable][{{$count_hotel}}]" value="1">
                            <label for="checkboxPrimary1{{$count_hotel}}">
                                bookable
                            </label>
                        </div>
                        <div class="icheck-primary d-inline">
                            <input type="checkbox" id="checkboxPrimary2{{$count_hotel}}" name="hotel[enquiry][{{$count_hotel}}]" value="1">
                            <label for="checkboxPrimary2{{$count_hotel}}">
                                enquiry
                            </label>
                        </div>
                        <div class="icheck-primary d-inline">
                            <input type="checkbox" id="checkboxPrimary3{{$count_hotel}}" name="hotel[sold_out][{{$count_hotel}}]" value="1">
                            <label for="checkboxPrimary3{{$count_hotel}}">
                                sold out
                            </label>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <hr>
        <div class="row">
            <div class="col-12 col-md-12">
                <div class="form-group clearfix">
                    <table class="table table-bordered">
                        <tbody>
                        <tr class="bg_f7">
                            <th>number</th>
                            <th>Adult</th>
                            <th>Children (0-2)</th>
                            <th>Children (3-5)</th>
                            <th>Children(6-11)</th>
                        </tr>
                        <tr>
                            <td>One</td>
                            <td>
                                <input type="number" placeholder="Adults" class="form-control" name="hotel[packagehotelpricing][adult_1][]" id="one_adult_no_child"/>
                            </td>
                            <td>
                                <input type="number" placeholder="Child (0-2)" class="form-control" name="hotel[packagehotelpricing][child_0_2_1][]" id="one_adult_one_0_2"/>
                            </td>
                            <td>
                                <input type="number" placeholder="Child (3-5)" class="form-control" name="hotel[packagehotelpricing][child_3_5_1][]" id="one_adult_tow_0_2"/>
                            </td>
                            <td>
                                <input type="number" placeholder="Child (6-11)" class="form-control" name="hotel[packagehotelpricing][child_6_11_1][]" id="one_adult_one_3_5"/>
                            </td>

                        </tr>
                        <tr>
                            <td>Two</td>
                            <td>
                                <input type="number" placeholder="Adults" class="form-control" name="hotel[packagehotelpricing][adult_2][]" id="tow_adult_no_child"/>
                            </td>
                            <td>
                                <input type="number" placeholder="Child (0-2)" class="form-control" name="hotel[packagehotelpricing][child_0_2_2][]" id="tow_adult_one_0_2"/>
                            </td>
                            <td>
                                <input type="number" placeholder="Child (3-5)" class="form-control" name="hotel[packagehotelpricing][child_3_5_2][]" id="tow_adult_tow_0_2"/>
                            </td>
                            <td>
                                <input type="number" placeholder="Child (6-11)" class="form-control" name="hotel[packagehotelpricing][child_6_11_2][]" id="tow_adult_one_3_5"/>
                            </td>
                        </tr>

                        <tr>
                            <td>Three</td>
                            <td>
                                <input type="number" placeholder="Adults" class="form-control" name="hotel[packagehotelpricing][adult_3][]" id="three_adult_no_child"/>
                            </td>
                            <td>
                                <input type="number" placeholder="Child (0-2)" class="form-control" name="hotel[packagehotelpricing][child_0_2_3][]" id="three_adult_one_0_2"/>
                            </td>

                            <td>
                                <input type="number" placeholder="Child (3-5)" class="form-control" name="hotel[packagehotelpricing][child_3_5_3][]" id="three_adult_one_3_5"/>
                            </td>

                            <td>
                                <input type="number" placeholder="Child (6-11)" class="form-control" name="hotel[packagehotelpricing][child_6_11_3][]" id="three_adult_one_6_10"/>
                            </td>

                        </tr>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header">
                            <h3 class="card-title" style="width: 100%">
                                <input type="button" class="btn btn-primary btn-sm " value="+" style="width: 50px"
                                       onclick="add_hotel_princing_details({{$count_hotel}})">Pricing details</h3>
                        </div>
                        <div class="card-body" id='div-container-hotel-pricing-details-{{$count_hotel}}'>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-1">
                                <label>Segments    </label>
                            </div>
                            <div class="col-sm-10">
                                @if($all_hotels)
                                    <select class="form-control select2bs4" id="package-hotel-segment-{{$count_hotel}}" style="width: 100%;">
                                        <option value="">Select Segment</option>
                                        @foreach($all_hotels as $hotel)
                                            <option value="{{$hotel->id}}">{{$hotel->name_en}}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                            <div class="col-sm-1">
                                <input type="button" class="btn btn-primary btn-sm " value="+" style="width: 50px" onclick="add_hotel_segment({{$count_hotel}})">
                            </div>
                        </div>
                    </div>
                    <div class="card-body" id='div-container-hotel-segment-{{$count_hotel}}'>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
