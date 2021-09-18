<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form enctype="multipart/form-data" method="POST" action="create.php" id="create_user_form">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-form-label">Password:</label>
                        <input class="form-control" name="password" id="password" type="password" autocomplete="off" required>
                        </input>
                    </div>
                    <div class="form-group">
                        <label for="fullname" class="col-form-label">Fullname:</label>
                        <input type="text" class="form-control" name="fullname" id="fullname"></input>
                    </div>
                    <div class="form-group">
                        <label for="day_of_birth" class="col-form-label">Birthday:</label>
                        <input type="date" class="form-control" id="day_of_birth" name="day_of_birth" required></input>
                    </div>
                    <div class="form-group">
                        <label for="avatar" class="col-form-label">Avatar:</label>
                        <input type="file" class="form-control" accept="image/*" id="avatar" name="avatar"></input>
                    </div>
                    <div class="form-group" class="switch_status">
                        <label>Status:</label>
                        <input type="checkbox" class="make-switch" id="is_active" name="is_active" data-on-color="primary" data-off-color="info" value="true">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="btn-create" id="btn-create">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
