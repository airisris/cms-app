<?php

    // TODO: 1. connect to database
    $database = connectToDB();

    // TODO: 2. get all the data from the form using $_POST
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"]; 
    $confirm_password = $_POST["confirm_password"]; 
    $role = $_POST["role"]; 

    /*
        TODO: 3. error checking
        - make sure all the fields are not empty
        - make sure all the password is match
        - make sure the email provided does not exist in the system
    */
    if (empty($name)||empty($email)||empty($password)||empty($confirm_password)||empty($role)){
        $_SESSION["error"] = "All fields are required";
        // redirect back to manage-users page
        header("Location: /manage-users-add");
        exit;
    } else if ($password !== $confirm_password){
        $_SESSION["error"] = "Your password is not match";
        // redirect back to signup page
        header("Location: /manage-users-add");
        exit;
    } else {
        // check and make sure the email provided  is not already exists in the users table
        // get user data by email
        $user = getUserByEmail($email);

        // check is the user exists
        if ($user){
            $_SESSION["error"] = "The email provided already exists in our system";
            // redirect back to login page
            header("Location: /manage-users-add");
            exit;
        } else {
            // 6. create a user account
            // 6.1 SQL command
            $sql = "INSERT INTO users (`name`, `email`, `password`, `role`) VALUES (:name, :email, :password, :role)";
            // 6.2 prepare
            $query = $database->prepare($sql);
            // 6.3 execute
            $query->execute([
                "name" => $name,
                "email" => $email,
                "password" => password_hash($password, PASSWORD_DEFAULT),
                "role" => $role
            ]);

            //step 4 do garnish
            $_SESSION["success"] = "Account created successfully.";

            // TODO: 5. redirect back to the /manage-users page
            header("Location: /manage-users");
            exit;
        }
    }

    // TODO: 4. create the user account. You need to assign the role to the user
    /*
        role options:
        - user
        - editor
        - admin
    */
?>