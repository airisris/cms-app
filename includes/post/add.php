<?php

    // connect to database
    $database = connectToDB();

    // get all the data from the form using $_POST
    $title = $_POST["title"];
    $content = $_POST["content"];
    $user_id = $_SESSION["user"]["id"];
    $image = $_FILES["image"];

    // error checking
    if (empty($title)||empty($content)){
        $_SESSION["error"] = "All fields are required";
        header("Location: /manage-posts-add");
        exit;
    } 

    // trigger the file upload
    // make sure $image is not empty
    if ( !empty( $image ) ) {
        // where is the upload folder
        $target_folder = "uploads/";
        // add the image name to the upload folder path
        // YYYYMMDDHHmmssvvv
        $target_path = $target_folder . date("YmdHisv") . "_" . basename($image["name"]);
        // move the file to the uploads folder
        move_uploaded_file($image["tmp_name"] , $target_path);
    }


        // create a post
        $sql = "INSERT INTO posts (`title`, `content`, `image`, `user_id`) VALUES (:title, :content, :image, :user_id)";
        $query = $database->prepare($sql);
        $query->execute([
            "title" => $title,
            "content" => $content,
            "image" => isset($target_path) ? $target_path : "",
            "user_id" => $user_id
        ]);

        // redirect
        $_SESSION["success"] = "Post created successfully.";
        header("Location: /manage-posts");
        exit;

?>