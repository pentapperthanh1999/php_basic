<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form enctype="multipart/form-data" method="POST" id="edit_user_form">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Username:</label>
                        <input type="text" class="form-control" id="edit_username" name="edit_username" required>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-form-label">Password:</label>
                        <input class="form-control" name="edit_password" id="edit_password" type="password" autocomplete="off" required>
                        </input>
                    </div>
                    <div class="form-group">
                        <label for="fullname" class="col-form-label">Fullname:</label>
                        <input type="text" class="form-control" name="edit_fullname" id="edit_fullname"></input>
                    </div>
                    <div class="form-group">
                        <label for="day_of_birth" class="col-form-label">Birthday:</label>
                        <input type="date" class="form-control" id="edit_day_of_birth" name="edit_day_of_birth" required></input>
                    </div>
                    <div class="form-group">
                        <label for="avatar" class="col-form-label">Avatar:</label>
                        <input type="file" class="form-control" accept="image/*" id="edit_avatar" name="edit_avatar"></input>
                    </div>
                    <div class="form-group" class="switch_status">
                        <label>Status:</label>
                        <label class="switch">
                        <input type="checkbox" id="edit_is_active"  name="edit_is_active">
                        <span class="slider"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <input type="text" name="id"
                                id="id" class="form-control"
                                hidden="true">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn-edit">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
