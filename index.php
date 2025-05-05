<?php
    session_start();
    require "includes/functions.php";
    /*
        decide what page to load depending on the url the user visit

        pages routes:

        localhost:9002/ -> home.php
        localhost:9002/login -> login.php
        localhost:9002/signup -> signup.php
        localhost:9002/logout -> logout.php

        action routes:

        localhost:9002/auth/login -> includes/auth/do_login.php
        localhost:9002/auth/signup -> includes/auth/do_signup.php
        localhost:9002/auth/add -> includes/label/add_label.php
        localhost:9002/auth/complete -> includes/label/complete_label.php
        localhost:9002/auth/delete -> includes/label/delete_label.php

    */

    // global variable $_SERVER
    // figure out what path the user is visiting
    $path = $_SERVER["REQUEST_URI"];

    // once you figure outh the path, then we need to load relevant content based on the path
    switch ($path){
        case '/login':
            require "pages/login.php";
            break;
        case '/signup':
            require "pages/signup.php";
            break;
        case '/logout':
            require "pages/logout.php";
            break;
        case '/manage-users':
            require "pages/manage-users.php";
            break;
        case '/manage-users-add':
            require "pages/manage-users-add.php";
            break;
        case '/manage-users-edit':
            require "pages/manage-users-edit.php";
            break;
        case '/manage-users-changepwd':
            require "pages/manage-users-changepwd.php";
            break;
        case '/manage-posts':
            require "pages/manage-posts.php";
            break;
        case '/manage-posts-add':
            require "pages/manage-posts-add.php";
            break;
        case '/manage-posts-edit':
            require "pages/manage-posts-edit.php";
            break;
        case '/dashboard':
            require "pages/dashboard.php";
            break;
        case '/post':
            require "pages/post.php";
            break;
        //actions routes
        case '/auth/login':
            require "includes/auth/do_login.php";
            break;
        case '/auth/signup':
            require "includes/auth/do_signup.php";
            break;

        default:
            require "pages/home.php";
            break;
    }
?>