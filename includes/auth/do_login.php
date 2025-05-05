<?php
    // Connect to Database
    $database = connectToDB();

    // 3. get the data from the login form
    $email = $_POST["email"];
    $password = $_POST["password"];

    // 4. check for error (make sure all the fields are filled)
    if (empty($email) || empty($password)){
        echo "All fields are required";
    } else {
        // 5. get the user data by email
        // 5.1 SQL command
        $sql = "SELECT * FROM users WHERE email = :email";
        // 5.2 prepare
        $query = $database->prepare($sql);
        // 5.3 execute
        $query->execute([
            "email" => $email
        ]);
        // 5.4 fetch
        $user = $query->fetch(); // return the first row of the list

        // check if the user exists
        if($user){
            // 6. check if password is correct or not
            if (password_verify($password, $user["password"])){
                // 7. store the user data in the session storage to login the user
                $_SESSION["user"] = $user;

                //8. redirect the user back to /
                header("Location: /dashboard");
                exit;
            } else {
                echo "The password provided is incorrect";
            }
        } else {
            echo "The email provided does not exist";
        }

    }
?>