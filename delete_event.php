<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "webpage design project";
    $event_id = $_GET['id'];

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $user_id = isset($_SESSION['user']) ? $_SESSION['user']['id'] : -1;
    if ($user_id == -1) {
        header("Location: login.php");
    } 
    else {
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM events WHERE ID = '$event_id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $event = $result->fetch_assoc();
        } else {
            die("404 event not found");
        }

        if ($user_id != $event['host_id']) {
            header("Location: login.php");
        } else {
            $sql = "DELETE FROM events WHERE ID = '$event_id'";
            if ($conn->query($sql) === TRUE) {
                header("Location: user_profile.php");
            } else {
                die("An error occurred while deleting the event.");
            }
        }
    }
?>