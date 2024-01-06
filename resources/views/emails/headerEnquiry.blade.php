<div class="col-md-12 col-xs-12 col-sm-12">
    <h1> Enquiry from Palmoasis Holidays</h1>
    <div class="form-group" >
        <label class="control-label col-md-2 col-sm-3 col-xs-4">
            Full name :
        </label>
        <label class="control-label col-md-2 col-sm-3 col-xs-4">
            {{$enquiry->name}}
        </label>
    </div>
    <div class="form-group" >
        <label class="control-label col-md-2 col-sm-3 col-xs-4">
            Mobile :
        </label>
        <label class="control-label col-md-2 col-sm-3 col-xs-4">
            {{$enquiry->phone}}
        </label>
    </div>
    <div class="form-group" >
        <label class="control-label col-md-2 col-sm-3 col-xs-4">
            Email :
        </label>
        <label class="control-label col-md-2 col-sm-3 col-xs-4">
            {{$enquiry->email}}
        </label>
    </div>
    <div class="form-group" >
        <label class="control-label col-md-2 col-sm-3 col-xs-4">
            Address :
        </label>
        <label class="control-label col-md-2 col-sm-3 col-xs-4">
            {{$enquiry->address}}
        </label>
    </div>

    <div class="form-group" >
        <label class="control-label col-md-2 col-sm-3 col-xs-4">
            Message :
        </label>
        <label class="control-label col-md-2 col-sm-3 col-xs-4">
            {{$enquiry->message}}
        </label>
    </div>
</div>
