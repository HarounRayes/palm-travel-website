<div class="modal left fade tour-list" id="ModalOfTour" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">
                    {{trans('messages.Add_tour')}}
                </h4>
            </div>
            <div class="modal-body"></div>
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->

<div class="modal fade" id="myModalTour" role="dialog">
    <div class="modal-dialog" style="width:90% !important">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 style="margin: 10px 0;">
                    {{trans('messages.My_tours')}}
                </h4>
            </div>

            <div class="modal-body" style="padding-top: 10px;">

            </div>

            <div class="modal-footer">
            </div>
        </div>

    </div>
</div>
<div class="modal fade" id="ModalPayment" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 style="margin: 10px 0;">
                    {{trans('messages.Payment_information')}} :
                </h4>
            </div>

            <div class="modal-body" style="padding-top: 10px;">

            </div>
            <div class="modal-footer">
            </div>
        </div>

    </div>
</div>
