<?php

    // 1. connect to database
    $database = connectToDB();

    // 2. get the user_id from the form
    $post_id = $_POST["post_id"];
    
    // 3. delete the user
    $sql = "DELETE FROM posts WHERE id = :id";
    $query = $database->prepare( $sql );
    $query->execute([
        "id" => $post_id
    ]);

    // 4. redirect to manage users
    header("Location: /manage-posts"); 
    exit;
?>