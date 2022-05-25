<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel2">Modal title</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <h4>Are you sure delete this item ?</h4>
                
            </div>
            <div class="modal-footer">
                <button type="button" id="close_confirm_modal" class="btn btn-secondary" data-dismiss="modal" @click="resetFormData">Close</button>
                <button type="button" class="btn btn-primary" @click="deleteData">Yes</button>
            </div>

        </div>
    </div>
</div>