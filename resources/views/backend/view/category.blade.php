<div class="card card-default tour_category">
    <input type="hidden" value="{{$category->id}}" name="categoryIds[]">
    <div class="card-header">
        <h5 class="card-title">
            {{$category->category->name_en}}
            <input class="form-control" type="hidden" name="category[category_id][{{$category->id}}]"
                   value="{{$category->category->id}}">
        </h5>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget-custom="remove"><i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <div class="col-2 col-sm-2" style="padding-top: 37px;">
                <div class="form-group">
                    @if ($category->type == "shared")
                        <input checked type="radio" name="category[type][{{$category->id}}]" value='shared'/>
                    @else
                        <input type="radio" name="category[type][{{$category->id}}]" value='shared'/>
                    @endif
                    <label>Shared</label>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="disabledinput" class="control-label">
                        Price for Adult
                    </label>
                    <div class="control-label">
                        <input name="category[adult_price][{{$category->id}}]" type="number"
                               class="form-control" value="{{$category->adult_price}}"/>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="disabledinput" class="control-label">
                        Price for Child (6 - 11)
                    </label>
                    <div class="control-label">
                        <input name="category[child_6_11_price][{{$category->id}}]" type="number"
                               class="form-control" value="{{$category->child_6_11_price}}"/>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="disabledinput" class="control-label">
                        Price for Child (3 - 5)
                    </label>
                    <div class="control-label">
                        <input name="category[child_3_5_price][{{$category->id}}]" type="number"
                               class="form-control" value="{{$category->child_3_5_price}}"/>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="disabledinput" class="control-label">
                        Price for Infant
                    </label>
                    <div class="control-label">
                        <input name="category[infant_price][{{$category->id}}]" type="number"
                               class="form-control" value="{{$category->infant_price}}"/>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>English Shared Note</label>
                    <textarea name="category[shared_note_en][{{$category->id}}]"
                              class="form-control">{{$category->shared_note}}</textarea>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>Arabic Shared Note</label>
                    <textarea name="category[shared_note_ar][{{$category->id}}]"
                              class="form-control">{{$category->shared_note}}</textarea>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-2 col-sm-2" style="padding-top: 37px;">
                <div class="form-group">
                    @if ($category->type == "private")
                        <input checked type="radio" name="category[type][{{$category->id}}]" value='private'/>
                    @else
                        <input type="radio" name="category[type][{{$category->id}}]" value='private'/>
                    @endif
                    <label>Private</label>
                </div>
            </div>
            <div class="col">
                <div class="form-group">

                    <label for="disabledinput" class="control-label">
                        Price for (1-4) person
                    </label>
                    <div class="control-label">
                        <input name="category[person_1_4_price][{{$category->id}}]" type="number"
                               class="form-control" value="{{$category->person_1_4_price}}"/>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">

                    <label for="disabledinput" class="control-label">
                        Price for (1-8) person
                    </label>
                    <div class="control-label">
                        <input name="category[person_1_8_price][{{$category->id}}]" type="number"
                               class="form-control" value="{{$category->person_1_8_price}}"/>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">

                    <label for="disabledinput" class="control-label">
                        Price for (1-12) person
                    </label>
                    <div class="control-label">
                        <input name="category[person_1_12_price][{{$category->id}}]" type="number"
                               class="form-control" value="{{$category->person_1_12_price}}"/>
                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>
        <hr>
        <div class="row">
            <div class="col">
                <div class="form-group">

                    <input type="checkbox" name="category[private_is_shared][{{$category->id}}]" {{($category->private_is_shared) ? "checked" :""}} />
                    <label style="margin-right: 20px">Private shared tour</label>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>English Private Note</label>
                    <textarea name="category[private_note_en][{{$category->id}}]" class="form-control">{{$category->private_note_en}}</textarea>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>Arabic Private Note</label>
                    <textarea name="category[private_note_ar][{{$category->id}}]" class="form-control">{{$category->private_note_ar}}</textarea>
                </div>
            </div>
        </div>
        <hr>
    </div>
</div>
