<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Basic</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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

$(document).ready(function(){
    $('.slider').click(function() {
        console.log('123')
        var attrChecked = $('#is_active');
        var value = $('#is_active').prop('value');
        if (value == 0) {
            console.log('active' + value);
            attrChecked.attr('value', 1);
            console.log('sau' + value);
            console.log($('#is_active').val());
        } else if (value == 1) {
            console.log('truoc' + value);
            attrChecked.attr('value', 0);
            console.log('disable' + value);
            console.log($('#is_active').val());
        } else {
            console.log("khong co gia tri");
        }
    });
})
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

    $(document).on('click' , '.btn-edit' ,function(){
        var id = this.id;
        $.ajax({
            url: 'read.php',
            type: 'POST',
            dataType: 'JSON',
            data: {"id":id,"type":"single"},
            success:function(response){
                $("#edit-modal").modal('show');
                $('#title').val(response.title);
                $('#description').val(response.description);
                $('#url').val(response.url);
                $("#category").val(response.category);
                $("#id").val(id);
            }
        });
    });
    
    $(document).on('click' ,'#update' ,function() {
            $.ajax({
                    url: 'edit.php',
                    type: 'POST',
                    dataType: 'JSON',
                    data: $("#frmEdit").serialize(),
                    success:function(response){
                        $("#messageModal").modal('show');
                        $("#msg").html(response);
                        $("#edit-modal").modal('hide');
                        loadData();
                    }
                });
        });
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
