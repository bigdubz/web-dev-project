<?php
    $event_id = $_GET['id'];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "webpage design project";
    $event_id = $_GET['id'];

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
    $new_cap = $event['current_cap'] + 1;
    $sql = "UPDATE events SET current_cap = '$new_cap' WHERE ID = '$event_id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: user_profile.php");
    } else {
        die("Error occurred");
    }
?>