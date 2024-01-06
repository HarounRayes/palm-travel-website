<div class="col-md-4 col-sm-3 col-xs-6">
    <div class="application-field-div">
        @if ($requirement->required == '1')
            <span class="required">*</span>
        @endif
        <label>{{$requirement->name}}</label>
        @if ($requirement->required == '1')
                <input required type="text" name="requirement[{{$i}}][{{$requirement->field}}]" class="form-control"
                       placeholder="{{$requirement->name}}"/>
        @else
            <input type="text" name="requirement[{{$i}}][{{$requirement->field}}]" class="form-control"
                   placeholder="{{$requirement->name}}"/>
        @endif
    </div>
</div>
