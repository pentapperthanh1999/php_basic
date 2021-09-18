<?php
include_once "config.php";

class UserController
{
    // func tac ca ban ghi trong tbl_users
    public function readData()
    {
        try {
            $db = new Database();
            
            $conn = $db->openConnect();
            
            $sql = "SELECT * FROM `tbl_users` ORDER BY id ASC";

            $result = array();
            $result = mysqli_query($conn, $sql);

            $db->closeConnect();
        } catch (Exception $e) {
            echo "Co van de ve ket noi: " . $e->getMessage();
        }
        if (!empty($result)) {
            return $result;
        }
    }
    // func lay user theo id
    public function getUserById($id)
    {
        try {
            $db = new Database();
            
            $conn = $db->openConnection();
            
            $sql = "SELECT * FROM `tbl_users` WHERE id=" . $id . " ORDER BY id DESC";
            
            $result = array();
            $result = mysqli_query($conn, $sql);
            
            $db->closeConnection();
        } catch (Exception $e) {
            echo "Co van de ve ket noi: " . $e->getMessage();
        }
        if (!empty($result)) {
            return $result;
        }
    }
    // func upload file
    public function uploadFile()
    {   
        $uploadFile = '';
        if ( !empty($_FILES['avatar']['name']) ) {
            $fileName = basename($_FILES['avatar']['name']);
            //xoa khoang trang trong ten file img
            $fileName = preg_replace('/\s+/', '', $fileName);
            $location = 'uploads/'.$fileName;
            $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
            $imageFileType = strtolower($imageFileType);
            $valid_extensions = array("jpg", "jpeg", "png");
             /* Check file extension */
            if (in_array(strtolower($imageFileType), $valid_extensions)) {
                /* Upload file */
                if (move_uploaded_file($_FILES['avatar']['tmp_name'],$location)) {
                    $uploadFile = $location;
                } else {
                    echo 'khong the luu anh vao';
                }
            } else {
                echo 'file khong dung dinh dang';
            }
        } else {
            echo 'file trong';
        }
        //var_dump($uploadFile);
        return $uploadFile;
    }
    //func tao ban ghi    
    public function createUser()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $fullname = $_POST['fullname'];
        $day_of_birth = $_POST['day_of_birth'];
        $is_active = $_POST['is_active'];
        $avatar = self::uploadFile();
        $db = new Database();
        
        $conn = $db->openConnect();
        $sql = "INSERT INTO `tbl_users`(`username`, `password`, `fullname`, `day_of_birth`, `avatar`, `is_active`) 
                VALUES ('". $username ."', '". $password ."', '". $fullname ."', '". $day_of_birth ."', '". $avatar ."', '". $is_active ."')";
        //var_dump($sql);
        $conn->query($sql);

        $db->closeConnect();
    }

    //func xoa ban ghi
    public function delete($id){
        $db = new Database();
        $conn = $db->openConnect();
        
        $sql = "DELETE FROM `tbl_users` where id = '$id'";

        if (mysqli_query($conn, $sql)) {
            echo "Records were deleted successfully.";
        } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
        }

        $db->closeConnect();
    }

    public function search($key)
    {
        $db = new Database();
        $conn = $db->openConnect();
        $key = $_POST["search"];
        $sql = "SELECT * FROM tbl_users WHERE username LIKE '%". $key ."%'";
        $conn->query($sql);
        $db->closeConnect();
    }
}
