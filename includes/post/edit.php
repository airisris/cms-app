<?php

    // 1. connect to Database
    $database = connectToDB();

    // 2. data from the update form
    $id = $_POST["id"];
    $title = $_POST["title"];
    $content = $_POST["content"];
    $status = $_POST["status"]; 
    $image = $_FILES["image"];

    // 3. check error
    if (empty($title)||empty($content)||empty($status)){
        $_SESSION["error"] = "All fields are required";
        // redirect back to manage-users-edit page
        header("Location: /manage-posts-edit?id=". $id);
        exit;
    }

    // if image is not empty, then do image upload
    if (!empty($image["name"])){
        // where is the upload folder
        $target_folder = "uploads/";
        // add the image name to the upload folder path
        $target_path = $target_folder . date("YmdHisv") . "_" . basename( $image["name"] );
        // move the file to the uploads folder
        move_uploaded_file( $image["tmp_name"] , $target_path );
    

        // edit post with image path
        $sql = "UPDATE posts SET title = :title, content = :content, status = :status, image = :image WHERE id = :id";
        $query = $database->prepare($sql);
        $query->execute([
            "id" => $id,
            "title" => $title,
            "content" => $content,
            "status" => $status,
            "image" => $target_path
        ]);
    } else {

        // edit post without image path
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