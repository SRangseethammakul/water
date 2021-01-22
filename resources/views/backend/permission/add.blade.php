<div class="modal fade" id="permissionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Permission</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="permissionForm">
                    <div class="form-group">
                        <label for="permission-name" class="col-form-label">Permission :</label>
                        <input type="text" name="permissionname" class="form-control" id="permission-name">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="saveBtn" class="btn btn-primary">Send message</button>
            </div>
        </div>
    </div>
</div>