<?php

    // TODO: 1. connect to database
    $database = connectToDB();

    // TODO: 2. get all the data from the form using $_POST
    $id = $_POST["id"];
    $password = $_POST["password"]; 
    $confirm_password = $_POST["confirm_password"]; 

    if (empty($password)||empty($confirm_password)){
        $_SESSION["error"] = "All fields are required";
        header("Location: /manage-users-changepwd?id=" . $id); // pass in the id to the url
        exit;
    } else if ($password !== $confirm_password){
        $_SESSION["error"] = "Your password is not match";
        header("Location: /manage-users-changepwd?id=" . $id);
        exit;
    } else {
        // 3. update password for user
        $sql = "UPDATE users SET password = :password WHERE id = :id";
        $query = $database->prepare($sql);
        $query->execute([
            "id" => $id,
            "password" => password_hash($password, PASSWORD_DEFAULT)
        ]);
    }
        // redirect
        $_SESSION["success"] = "Change password successful.";
        header("Location: /manage-users");
        exit;
?>