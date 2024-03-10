<h4>{{trans('messages.Upload-Your-Documents')}}</h4>
@foreach ($visa->requirements_documents as $requirement)
    <div class="row p-b-15">
        <div class="col-md-6 col-sm-6 col-xs-6">
            <li class="file-name">{{$requirement->requirement->name}}</li>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6" style="display: inline-flex">
            <span class="required">*</span>
            <input required type="file" name="file[{{$requirement->requirement->field}}][{{$i}}]" class="form-control"
                   placeholder="{{$requirement->requirement->name}}"/>
        </div>
    </div>

@endforeach
