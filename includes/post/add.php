<?php

    // connect to database
    $database = connectToDB();

    // get all the data from the form using $_POST
    $title = $_POST["title"];
    $content = $_POST["content"];
    $user_id = $_SESSION["user"]["id"];

    // error checking
    if (empty($title)||empty($content)){
        $_SESSION["error"] = "All fields are required";
        header("Location: /manage-posts-add");
        exit;
    } else {
        // create a post
        $sql = "INSERT INTO posts (`title`, `content`, `user_id`) VALUES (:title, :content, :user_id)";
        $query = $database->prepare($sql);
        $query->execute([
            "title" => $title,
            "content" => $content,
            "user_id" => $user_id
        ]);

        // redirect
        $_SESSION["success"] = "Post created successfully.";
        header("Location: /manage-posts");
        exit;
    }
?>