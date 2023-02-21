<div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Create Role
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('create.role') }}" method="post" id="add-role-form">
                    @csrf
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <input class="form-control" type="text" name="name" placeholder="role name" id="example-text-input">
                            <span class="text-danger error-text name_error"></span>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
            </div>
        </div>
    </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>