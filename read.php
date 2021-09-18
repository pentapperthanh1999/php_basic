<?php
    include_once 'UserController.php';

    $user = new UserController();

    switch($_POST["type"]) {
    
        case "single":

            if(isset($_POST["id"])) {
                $result = $user->getUserById($_POST["id"]);
                if(!empty($result)) {
                    $responseArray["username"] = $result[0]["username"];
                    $responseArray["password"] = $result[0]["password"];
                    $responseArray["fullname"] = $result[0]["fullname"];
                    $responseArray["day_of_birth"] = $result[0]["day_of_birth"];
                    $responseArray["avatar"] = $result[0]["avatar"];
                    $responseArray["is_active"] = $result[0]["is_active"];
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
