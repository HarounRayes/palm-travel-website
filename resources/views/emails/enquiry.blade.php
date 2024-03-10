<div class="col-md-12 col-xs-12 col-sm-12">
    <h1> Enquiry Package from Palmoasis Holidays</h1>
    <div class="form-group">
        <label class="control-label col-md-2 col-sm-3 col-xs-4">
            Package Name:
        </label>
        <label class="control-label col-md-2 col-sm-3 col-xs-4">
            {{$enquiry->package->name_en}}
        </label>
    </div>
    <div class="form-group">
        <label class="control-label col-md-2 col-sm-3 col-xs-4">
            Number of Persons:
        </label>
        <label class="control-label col-md-2 col-sm-3 col-xs-4">
            {{$enquiry->number_of_person()}}
        </label>
    </div>
    <div class="form-group">
        <label class="control-label col-md-2 col-sm-3 col-xs-4">
            Full Name:
        </label>
        <label class="control-label col-md-2 col-sm-3 col-xs-4">
            {{$enquiry->enquiry_name()}}
        </label>
    </div>

        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-4">
                Mobile Number:
            </label>
            <label class="control-label col-md-2 col-sm-3 col-xs-4">
                {{$enquiry->enquiry_phone()}}
            </label>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-4">
                Email:
            </label>
            <label class="control-label col-md-2 col-sm-3 col-xs-4">
                {{$enquiry->enquiry_email()}}
            </label>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-4">
                Address:
            </label>
            <label class="control-label col-md-2 col-sm-3 col-xs-4">
                {{$enquiry->address}}
            </label>
        </div>

    <div class="form-group">
        <label class="control-label col-md-2 col-sm-3 col-xs-4">
            Message:
        </label>
        <label class="control-label col-md-2 col-sm-3 col-xs-4">
            {{$enquiry->message}}
        </label>
    </div>
</div>
