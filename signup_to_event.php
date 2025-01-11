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

        $sql = "SELECT events FROM credentials WHERE ID = '$user_id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $user_events_ = $result->fetch_assoc()['events'];
        }

        $already_signed_up = FALSE;
        $user_events = explode(',', $user_events_);
        foreach ($user_events as $user_event_id) {
            if ($user_event_id == $event_id) {
                $already_signed_up = TRUE;
                break;
            }
        }
        if (!$already_signed_up) {
            $sql = "SELECT * FROM events WHERE ID = '$event_id'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $event = $result->fetch_assoc();
            } else {
                die("404 event not found");
            }
            $has_space = $event['current_cap'] < $event['capacity'];
            if ($has_space) {
                $new_cap = $event['current_cap'] + 1;
                $sql = "UPDATE events SET current_cap = '$new_cap' WHERE ID = '$event_id'";

                if ($conn->query($sql) === FALSE) {
                    die("Error occurred");
                }
                $new_events = $user_events_ ? $user_events_ . ',' . $event_id : $event_id;
                $sql = "UPDATE credentials SET events = '$new_events' WHERE ID = '$user_id'";

                if ($conn->query($sql) === TRUE) {
                    $_SESSION['user']['events'] = $new_events;
                    header("Location: event.php?id=" . $event_id);
                } else {
                    die("Error occurred");
                }
            } else {
                header("Location: event.php?id=" . $event_id);
            }
        } else {
            header("Location: event.php?id=" . $event_id);
        }
        $conn->close();
    }
?>