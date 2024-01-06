<div class="col-md-6 col-sm-6 col-xs-6">
    <input type="hidden" name='requirement[{{$i}}][email_counter]' id="email_counter_{{$i}}" value="1"/>
    <div class="application-field-div">

        <label style="width: 100%">
            @if ($requirement->required == '1')
                <span class="required">*</span>
            @endif
                {{$requirement->name}}</label>
        @if ($requirement->required == '1')
            <input type="email" name="email[{{$i}}][0]" class="form-control" required
                   placeholder="{{$requirement->name}}" style="display:inline-block;width:90%"/>
        @else
            <input type="email" name="email[{{$i}}][0]" class="form-control"
                   placeholder="{{$requirement->name}}" style="display:inline-block;width:90%"/>
        @endif
        <a onclick="addEmail('{{$i}}')" class="btn btn-success" style="display:inline-block;">+</a>
    </div>
</div>
