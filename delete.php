<?php
    if (isset($_POST['id'])) {
        include_once 'UserController.php';
        $user = new UserController();
        $result = $user->delete($_POST['id']);
    }
?>
