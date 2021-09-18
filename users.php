<?php
require_once('config.php');
class Users {
    private $DB;

    public function __construct(){
        $db = new Database();
        $this->DB = $db->connect();
    }

    public function showAllUsers()
    {   
        $sql = "SELECT * from tbl_users";
        $result = array();
        $result = mysqli_query($this->DB, $sql);
        if ( $result && mysqli_num_rows($result ) > 0 ) {
            while ( $row = $result->fetch_assoc() ) {
                echo '<tr class="row_element">
                    <td>'.$row['id'].'</td>
                    <td>'.$row['username'].'</td>
                    <td>'.$row['password'].'</td>
                    <td>'.$row['fullname'].'</td>
                    <td>'.$row['day_of_birth'].'</td>
                    <td>
                        <img class="avatar-cover" src="data:image/jpeg;base64,'.base64_encode( $row['avatar'] ).'"/>
                    </td>
                    <td>'.($row['is_active'] == 1 ? 'active':'disable').'</td>
                    <td class="action">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#showModal" data-whatever="@mdo"><i class="far fa-eye"></i></button>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editModal" data-whatever="@mdo"><i class="far fa-edit"></i></button>
                        <button type="button" class="btn btn-danger btn-delete" id="'.$row['id'].'"><i class="far fa-trash-alt"></i></button>
                    </td>
                </tr>';
            }
        }
    }

    public function createUser()
    {
        $sql = "INSERT INTO tbl_users (username, password, fullname, day_of_birth, avatar, is_active) VALUES ('admin34', '123456', 'nguyen van ba', '1999-05-02', '', 1)";
        $query = mysqli_query($this->DB, $sql);
        if($query == true) {
            echo "success";
        } else {
            echo "error";
        }
    }

    public function deteleUser($id)
    {
        $user = new Users();
        $sql = "DELETE FROM `tbl_users` where id='$id'";
        $query = mysqli_query($this->DB, $sql);
    }
}
