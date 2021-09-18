<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        include_once 'UserController.php';
        $user = new UserController();
        $result = $user->editUser($_POST);
        echo json_encode($result);
    }
?>