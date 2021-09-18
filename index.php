<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Basic</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/4.0.0-alpha.1/css/bootstrap-switch.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="public/assets/css/style.css">
    

    <link rel="shortcut icon" href="#">
</head>
<?php require_once "UserController.php"; 
    $users = new UserController();
    $result = $users->readData();
?>
<body>
    <div class="container-fluid">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title m-b-0">Users</h3>
                <button type="button" class="btn btn-primary btn-add" data-toggle="modal" data-target="#createModal" data-whatever="@mdo"><i class="fas fa-plus"></i></button>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                  </div>
                  <input type="text" id="search-input"  name ="search" class="form-control" placeholder="Search...">
                </div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                        <thead align="center">
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Full Name</th>
                                <th>Date Of Birth</th>
                                <th>Avatar</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <div id="notification">
                            
                        </div>
                            <tbody align="center" id="load_data">
                                <!-- show data -->
                                <?php require_once "list.php" ?>
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous">
</script>
<script
    src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/js/bootstrap-switch.min.js"></script>
<script src="public/assets/js/main.js"></script>
<?php include "users/show.php"; ?>
<?php include "users/create.php"; ?>
<?php include "users/edit.php"; ?>
</html>
<script>
       
function loadData() {
    $.ajax({
        url: 'read.php',
        type: 'POST',
        data: {"type":"all"},
        success:function(response){
            $("#load_data").html(response);
        }
    });
}

/*function toggleStatus(status) {
    $('.slider').click(function() {
        // var attrChecked = $('#is_active');
        var attrChecked = status;
        var value = status.prop('value');
        if (value == 0) {
            console.log('active' + value);
            attrChecked.attr({
                'value': 1,
                'checked':true
            });
        } else if (value == 1) {
            attrChecked.attr({
                'value': 0,
                'checked': false
            })
            attrChecked.removeProp('checked');
            // console.log("khong co gia tri");
        }
    });
    return status;
}
// xu ly tham so truyen vao form create,
$(document).ready(function() {
    $('.btn-add').click(function() {
       toggleStatus($('#is_active'));
    });
    $('.btn-edit').click(function() {
        toggleStatus($('#edit_is_active'));
    });
})*/

$(function() {
    $("#is_active").bootstrapSwitch({
        onSwitchChange: function(e, state) { 
            if ( state == true ) {
                $(this).attr('value', 1);
            } else {
                $(this).attr('value', 0);
            }
        }
    });

});

//tao nguoi dung moi bang ajax
$(document).ready(function(){
    $('#create_user_form').on('submit', function(e) {
        e.preventDefault();
        var username = $('#username').val();
        var password = $('#password').val();
        var fullname = $('#fullname').val();
        //dinh dang lai ngay thang
        var day = new Date($('#day_of_birth').val());
        var day_of_birth = day.getFullYear() + '-' + (day.getMonth() + 1) + '-' + day.getDate();
        var avatar = $('#avatar').val();
        if ( avatar != '') {
            
        }

        var is_active = $('#is_active').val();

        var formData = new FormData($(this)[0]);
        formData.append('username', username);
        formData.append('password', password);
        formData.append('fullname', fullname);
        formData.append('day_of_birth', day_of_birth);
        formData.append('avatar', avatar);
        formData.append('is_active', is_active);
        /*var data;
        data = new FormData();
        data.append( 'file', $( '#avatar' )[0].files[0] );*/
        $.ajax({
            url: 'create.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            cache:false,
            success: function(data) {
                loadData();
                $("#create_user_form")[0].reset();
                $('#notification').html("<div class='alert alert-success'>");
                $('#notification > .alert-success').html(`<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;`)
                .append("</button>");
                $('#notification > .alert-success')
                .append("<span>Thêm mới thành công!</span>");
                $('#notification > .alert-success')
                .append('</div>');
                $('#createModal').modal('hide');
                
            },  error: function(data){
                console.log("error");
                console.log(data);
            }
        });
        
    });
    $(document).on('click' , '.btn-edit' ,function(e) {
        //e.preventDefault();
            var id = this.id;
            $.ajax({
            url: 'read.php',
            type: 'POST',
            data: {
                "id":id, 
                "type":"single"
            },
            dataType: 'JSON',
            success: function(response) {
                console.log(response)
                $('#edit_username').val(response.username);
                console.log(response.avatar);
                $('#edit_password').val(response.password);
                $('#edit_fullname').val(response.fullname);
                $("#edit_day_of_birth").val(response.day_of_birth);
                /*$('#edit_avatar').val(response.avatar);*/
                $("#edit_is_active").val(response.is_active);
                $("#id").val(id);
                $("#editModal").modal('show');
            }
        });
    });
    $(document).on('submit' ,'#edit_user_form' , function(e) {
        //e.preventDefault();
        // e.stopImmediatePropagation();
        console.log('da click  submit')
        var edit_username = $('#edit_username').val();
        var edit_password = $('#edit_password').val();
        var edit_fullname = $('#edit_fullname').val();
        //dinh dang lai ngay thang
        var day = new Date($('#edit_day_of_birth').val());
        var edit_day_of_birth = day.getFullYear() + '-' + (day.getMonth() + 1) + '-' + day.getDate();
        var edit_avatar = $('#edit_avatar').val();
        var edit_is_active = $('#edit_is_active').val();

        var editFormData = new FormData(jQuery("#edit_user_form")[0]);

        // editFormData.append('edit_username', edit_username);
        // editFormData.append('edit_password', edit_password);
        // editFormData.append('edit_fullname', edit_fullname);
        // editFormData.append('edit_day_of_birth', edit_day_of_birth);
        //editFormData.append('edit_avatar', edit_avatar);
        // editFormData.append('edit_is_active', edit_is_active);
        
        $.ajax({
            url: 'edit.php',
            type: 'POST',
            data: editFormData,
            processData: false,
            contentType: false,
            cache:false,
            success:function(response) {
                console.log('gui du lieu thanh cong');
                $("#editModal").modal('hide');
                loadData();
            }
        });
        e.preventDefault();
    });
    /*$("#edit_avatar").on("change", function() {
        $("#edit_user_form").submit();
    });*/

    //xoa ban ghi bang ajax
    $(document).on('click' , '.btn-delete', function() {
        var result = confirm("Bạn có chắc chắn muốn xóa bản ghi này không?");
        if  ( result ) {
            var id = this.id;
            $.ajax({
                url: 'delete.php',
                type: 'POST',
                data: { "id":id },
                success: function() {
                    $('#notification').html("<div class='alert alert-success'>");
                    $('#notification > .alert-success').html(`<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;`)
                    .append("</button>");
                    $('#notification > .alert-success')
                    .append("<span>Xóa bản ghi thành công!</span>");
                    $('#notification > .alert-success')
                    .append('</div>');
                    loadData();
                }
            });
        }
    });
    //tim kiem bang ajax;
    /*$('#search-input').keyup(function() {
        var txtSearch = $(this).val();
        if ( txtSearch != '' ) {
            console.log("no Result")
        } else {
            $.ajax({
                url: 'search.php',
                method: 'POST',
                data: {
                    txtSearch: txtSearch
                },
                dataType: 'text',
                success: function(data) {
                    $('#search-input').html(data);
                }
            })
        }
    });*/
});
    
</script>
