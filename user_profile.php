<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css?v=<?php echo filemtime('style.css'); ?>">
        <link rel="icon" href="images/PlanCraft Logo1.png" type="icon">
        <?php 
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            if (isset($_SESSION['user'])) {
                echo '<title>' . htmlspecialchars($_SESSION['user']['username']) . '\'s profile </title>';
            } else {
                header("Location: login.php");
            }
        ?>
    </head>
    <body>
        <header id="header_part">
            <div class="logo">
                <a class="link-wrapper" href="index.php">
                    <img class="logo-img-header" id="h_logo" src="images/PlanCraft Long Logo.png" alt="PlanCraft Long Logo">
                </a> 
            </div>

            <div id="s_header">
                <?php

                    if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                    }
                    if (!isset($_SESSION['user'])) {
                        echo '
                            <a class="eventbtn" href="login.php">Add Your Event</a>
                            <a href="login.php" class="eventbtn">Log In</a>
                            <a href="signup.php" class="eventbtn">Sign Up</a>
                        ';
                    } else {
                            echo '
                                <a class="eventbtn" href="create_event.php">Add Your Event</a>
                                <a href="user_profile.php" style="width: 15%;">
                                    <img id="pf-img" src="images/profile.png">
                                </a>
                            ';
                    }

                ?>
                <nav class="nav_class">
                    <div class="dropdown">
                        <img class="menu-icon" src="images/Menu Image.png" alt="Menu Icon" width="50"/>
                        <div class="dropdown-content">
                            <a href="Events.html">Events</a>
                            <a href="About.html">About Us</a>
                            <a href="Contact.html">Contact Us</a>
                            <a href="index.php">Homepage</a>
                            <?php
                                if (isset($_SESSION['user'])) {
                                    echo '<a href="logout.php">Log out</a>';
                                }
                            ?>
                        </div>
                    </div>
                </nav>
            </div>
        </header>

        <div class="profile-box">
            <h1>Your profile</h1>
            <?php echo '<p>Name: ' . htmlspecialchars($_SESSION['user']['first']) . ' ' . htmlspecialchars($_SESSION['user']['last']) ?>
            <?php echo '<p>Username: ' . htmlspecialchars($_SESSION['user']['username']) . '</p>' ?>
            <?php echo '<p>Email: ' . htmlspecialchars($_SESSION['user']['email']) . '</p>' ?>
            <a href="change-password.php" class="btn">Change Password</a>
            <h2>Events I've hosted</h2>
            <div class="events-grid-profile">
                <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "webpage design project";

                    $user_id = $_SESSION['user']['id'];
                    
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    
                    $sql = "SELECT * FROM events WHERE host_id = '$user_id'";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $image = "";
                            if ($row['img'] != NULL && $row['img'] != "") {
                                $image = '<img src="' . $row['img'] . '" alt="' . $row['name'] . '" class="event-image">';
                            }
                            echo '
                                <div class="event-box-profile">
                                    <a class="link-wrapper" href="event.php?id=' . $row['ID'] . '">'
                                        . $image . 
                                        '<div class="event-content">
                                            <div class="event-name">' . $row['name'] . '</div>
                                            <div class="event-location">Location: ' . $row['place'] . '</div>
                                            <div class="event-datetime">Date: ' . $row['date'] . '</div>
                                            <div class="event-datetime">Capacity: ' . $row['current_cap'] . '/' . $row['capacity'] . '</div>
                                        </div>
                                    </a>
                                </div>
                            ';
                        }
                    } else {
                        echo '<h3>None</h3>';
                    }
                ?>
            </div>
            <h2>My future events</h2>
            <div class="events-grid-profile">
                <?php
                    $user_events = $_SESSION['user']['events'];
                    $user_events = explode(',', $user_events);
                    $found = FALSE;

                    foreach ($user_events as $user_event) {
                        $sql = "SELECT * FROM events WHERE ID = '$user_event' AND host_id <> '$user_id'";
                        $row = $conn->query($sql);
                        if ($row->num_rows == 1) {
                            $row = $row->fetch_assoc();
                            $current_time = time();
                            $event_time = $row['date'];
                            $event_time = strtotime($row['date']);
                            if ($event_time > $current_time) {
                                $found = TRUE;
                                $image = "";
                                if ($row['img'] != NULL && $row['img'] != "") {
                                    $image = '<img src="' . $row['img'] . '" alt="' . $row['name'] . '" class="event-image">';
                                }
                                echo '
                                    <div class="event-box-profile">
                                        <a class="link-wrapper" href="event.php?id=' . $row['ID'] . '">'
                                            . $image . 
                                            '<div class="event-content">
                                                <div class="event-name">' . $row['name'] . '</div>
                                                <div class="event-location">Location: ' . $row['place'] . '</div>
                                                <div class="event-datetime">Date: ' . $row['date'] . '</div>
                                                <div class="event-datetime">Capacity: ' . $row['current_cap'] . '/' . $row['capacity'] . '</div>
                                            </div>
                                        </a>
                                    </div>
                                ';
                            }
                        }
                    }
                    if (!$found) {
                        echo '<h3>None</h3>';
                    }
                ?>
            </div>
            <h2>Events I've attended</h2>
            <div class="events-grid-profile">
                <?php
                    $found = FALSE;
                    $user_events = $_SESSION['user']['events'];
                    $user_events = explode(',', $user_events);
                    foreach ($user_events as $user_event) {
                        $sql = "SELECT * FROM events WHERE ID = '$user_event' AND host_id <> '$user_id'";
                        $row = $conn->query($sql);
                        if ($row->num_rows == 1) {
                            $row = $row->fetch_assoc();
                            $current_time = time();
                            $event_time = $row['date'];
                            $event_time = strtotime($row['date']);
                            if ($event_time <= $current_time) {
                                $found = TRUE;
                                $image = "";
                                if ($row['img'] != NULL && $row['img'] != "") {
                                    $image = '<img src="' . $row['img'] . '" alt="' . $row['name'] . '" class="event-image">';
                                }
                                echo '
                                    <div class="event-box-profile">
                                        <a class="link-wrapper" href="event.php?id=' . $row['ID'] . '">'
                                            . $image . 
                                            '<div class="event-content">
                                                <div class="event-name">' . $row['name'] . '</div>
                                                <div class="event-location">Location: ' . $row['place'] . '</div>
                                                <div class="event-datetime">Date: ' . $row['date'] . '</div>
                                                <div class="event-datetime">Capacity: ' . $row['current_cap'] . '/' . $row['capacity'] . '</div>
                                            </div>
                                        </a>
                                    </div>
                                ';
                            }
                        }
                    }
                    if (!$found) {
                        echo '<h3>None</h3>';
                    }
                ?>
            </div>
        </div>
        <footer>
            <div class="footer-container">
                <div class="footer-section">
                    <h3>Resources</h3>
                    <ul>
                        <li><a href="#">Jordan's Public Holidays</a></li>
                        <li><a href="#">Security & Privacy Policy</a></li>
                        <li><a href="#">Feedback</a></li>
                        <li><a href="#">Terms of Use</a></li>
                    </ul>
                </div>
        
                <div class="footer-section">
                    <h3>Contact Support</h3>
                    <p>Email: support@PlanCraft.jo</p>
                    <p>Phone: +962 7 91800000</p>
                </div>
        
                <div class="footer-section">
                    <h3>Follow Us</h3>
                    <ul class="social-media">
                        <li>
                            <a href="https://www.facebook.com/" target="_blank">
                                <img src="images/facebook_icon.png" alt="Facebook" class="social-icon" />
                                Facebook
                            </a>
                        </li>
                        <li>
                            <a href="https://x.com/?lang=en" target="_blank">
                                <img src="images/twitter_icon.png" alt="Twitter" class="social-icon" />
                                Twitter
                            </a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/" target="_blank">
                                <img src="images/instagram_icon.png" alt="Instagram" class="social-icon" />
                                Instagram
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        
            <div class="footer-bottom">
                <p>&copy; 2025 PlanCraft. All rights reserved.</p>
            </div>
        </footer>
    </body>
</html>