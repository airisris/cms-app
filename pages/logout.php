<?php
    // for log out user

    // remove the user session
    unset($_SESSION["user"]);

    // redirect back to index.php
    header("Location: /");
    exit;
?>