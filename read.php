<?php
    include_once 'UserController.php';

    $user = new UserController();

    switch($_POST["type"]) {
        case "single":
            if (isset($_POST["id"])) {
                $result = $user->getUserById($_POST["id"]);
                if(!empty($result)) {
                    $responseArray["username"] = $result["username"];
                    $responseArray["password"] = $result["password"];
                    $responseArray["fullname"] = $result["fullname"];
                    $responseArray["day_of_birth"] = $result["day_of_birth"];
                    $responseArray["avatar"] = $result["avatar"];
                    $responseArray["is_active"] = $result["is_active"];
                    echo json_encode($responseArray);
                }
            }
            break;
        case "all":
            $result = $user->readData();
            require_once "list.php";
            break;
        default:
            break;
    }
?>
