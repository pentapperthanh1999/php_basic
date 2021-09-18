<?php
    if ( $_SERVER['REQUEST_METHOD'] === 'POST') {
        include_once 'UserController.php';
        $user = new UserController();
        $result = $user->createUser($_POST);
    }
?>
