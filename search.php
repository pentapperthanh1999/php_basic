<?php include_once 'UserController.php';

if (isset($_POST['search'])) {
    $user = new UserController();
    $result = $user->search($_POST['search']);
}
