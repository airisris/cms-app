<?php
    // connect to database
    function connectToDB(){
        // Connect to Database
        // 1. database info
        $host = "127.0.0.1";
        $database_name ="cms-app"; // connecting to which database
        $database_user = "root";
        $database_password ="";
    
        // 2. connect PHP with the MySQL database
        // PDO (PHP Database Object)
        $database = new PDO(
            "mysql:host=$host;dbname=$database_name", // host and db name
            $database_user, // username
            $database_password // password
        );

    return $database;
    }

    /*
        get user data by email
        input: email
        output: user data
    */
    function getUserByEmail($email){

        // connect to database
        $database = connectToDB();

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

        return $user;
    }

    /* 
        check if user is logged in
        if user is logged in, return true
        if user is not logged in, return false
    */
    function isUserLoggedIn(){
        return isset($_SESSION["user"]);
    }

    /*
        check if current user is an admin
    */
    function isAdmin(){
        // check if user session is set or not
        if (isset($_SESSION["user"])) {
            // check if user is an admin
            if ($_SESSION["user"]["role"] === 'admin') {
                return true;
            }
        }
            return false;
    }

    /*
        check if current user is an editor or admin
    */
    function isEditor(){
        return isset($_SESSION["user"]) && ($_SESSION["user"]["role"] === 'admin' || $_SESSION["user"]["role"] === 'editor') ? true : false;
    }

?>