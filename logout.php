<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
        session_unset();
        session_destroy();
        if (isset($_SERVER['HTTP_REFERER'])) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            header("Location: index.php");
        }
    }
?>