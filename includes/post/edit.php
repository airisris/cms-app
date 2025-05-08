<?php

    // 1. connect to Database
    $database = connectToDB();

    // 2. data from the update form
    $id = $_POST["id"];
    $title = $_POST["title"];
    $content = $_POST["content"];
    $status = $_POST["status"]; 

    // 3. check error
    if (empty($title)||empty($content)||empty($status)){
        $_SESSION["error"] = "All fields are required";
        // redirect back to manage-users-edit page
        header("Location: /manage-posts-edit?id=". $id);
        exit;
    } else {
        // edit post
        $sql = "UPDATE posts SET title = :title, content = :content, status = :status WHERE id = :id";
        $query = $database->prepare($sql);
        $query->execute([
            "id" => $id,
            "title" => $title,
            "content" => $content,
            "status" => $status
        ]);
    }
        // 5. redirect
        $_SESSION["success"] = "Edit post successful.";
        header("Location: /manage-posts");
        exit;
?>