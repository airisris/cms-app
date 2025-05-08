<?php

    // 1. connect to Database
    $database = connectToDB();

    // 2. data from the update form
    $id = $_POST["id"];
    $name = $_POST["name"];
    $role = $_POST["role"]; 

    // 3. check error
    if (empty($id)||empty($name)||empty($role)){
        $_SESSION["error"] = "All fields are required";
        // redirect back to manage-users-edit page
        header("Location: /manage-users-edit?id=". $id);
        exit;
    } else {
        // 4. update user
        // 4.1 SQL command (recipe)
        $sql = "UPDATE users SET name = :name, role = :role WHERE id = :id";
        // 4.2 prepare your SQL query (prepare your material)
        $query = $database->prepare($sql);
        // 4.3 execute the SQL query (cook it)
        $query->execute([
            "id" => $id,
            "name" => $name,
            "role" => $role
        ]);
    }
        // 5. redirect
        $_SESSION["success"] = "Edit user successful.";
        header("Location: /manage-users");
        exit;
?>