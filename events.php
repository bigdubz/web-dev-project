<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="style.css?v=<?php echo filemtime('style.css'); ?>">
        <link rel="icon" href="images/PlanCraft Logo1.png" type="icon">
        <title>Explore</title>
    </head>

    <body>
        <header id="header_part">
            <div class="logo">
                <a class="link-wrapper" href="index.php">
                    <img class="logo-img-header" id="h_logo" src="images/PlanCraft Long Logo.png" alt="PlanCraft Long Logo">
                </a> 
            </div>

            <div id="s_header">
                <a class="eventbtn big-screen-btn" href="events.php">Explore Events</a>
                <?php
                    if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                    }
                    if (!isset($_SESSION['user'])) {
                        echo '
                            <a class="eventbtn big-screen-btn" href="login.php">Create Your Own Event</a>
                            <a class="eventbtn big-screen-btn" href="login.php">Log In</a>
                            <a class="eventbtn big-screen-btn" href="signup.php">Sign Up</a>
                        ';
                    } else {
                            echo '
                                <a class="eventbtn big-screen-btn" href="create_event.php">Create Your Own Event</a>
                                <a id="link-logo" class="link-wrapper big-screen-btn" href="user_profile.php">
                                    <img id="pf-img" src="images/profile.png" alt="Profile Image">
                                </a>
                            ';
                    }
                ?>
                <nav class="nav_class">
                    <div class="dropdown">
                        <img class="menu-icon" src="images/Menu Image.png" alt="Menu Icon" width="50">
                        <div class="dropdown-content">
                            <a href="index.php">Home</a>
                            <a href="events.php">Events</a>
                            <a href="holidays.php">Jordan's holidays</a>
                            <?php
                                if (isset($_SESSION['user'])) {
                                    echo '
                                        <a href="user_profile.php">My profile</a>
                                        <a href="create_event.php">Create event</a>
                                        <a href="logout.php">Log out</a>
                                    ';
                                } else {
                                    echo '
                                        <a href="login.php">Log in</a>
                                        <a href="signup.php">Sign up</a>
                                    ';
                                }
                            ?>
                        </div>
                    </div>
                </nav>
            </div>
        </header>

        <h1 class="page-header">Events</h1>

        <div class="events-grid">
            <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "webpage design project";
                
                $conn = new mysqli($servername, $username, $password, $dbname);
                
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                
                $sql = "SELECT * FROM events";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        
                        $host_id = $row['host_id'];
                        $sqlusers = "SELECT * FROM credentials WHERE ID = '$host_id'";
                        $resultusers = $conn->query($sqlusers);
                        $host = $resultusers->fetch_assoc();
                        $host_name = $host['first_name'] . ' ' . $host['last_name'];

                        $image = "";
                        if ($row['img'] != NULL && $row['img'] != "") {
                            $image = '<img src="' . $row['img'] . '" alt="' . $row['name'] . '" class="event-image">';
                        }
                        echo '
                            <div class="event-box">
                                <a class="link-wrapper" href="event.php?id=' . $row['ID'] . '">'
                                    . $image . 
                                    '<div class="event-content">
                                        <div class="event-name">' . $row['name'] . '</div>
                                        <div class="event-location">By: ' . $host_name . '</div>
                                        <div class="event-location">Location: ' . $row['place'] . '</div>
                                        <div class="event-datetime">Date: ' . $row['date'] . '</div>
                                        <div class="event-datetime">Capacity: ' . $row['current_cap'] . '/' . $row['capacity'] . '</div>
                                    </div>
                                </a>
                            </div>
                        ';
                    }
                } else {
                    echo "<h3 style='text-align: center'>No events found.</h3>";
                }
            ?>
        </div>

        <footer>
            <div class="footer-container">
                <div class="footer-section">
                    <h3>Resources</h3>
                    <ul>
                        <li><a href="holidays.php">Jordan's Public Holidays</a></li>
                        <li><a href="privacy_policy.php">Security & Privacy Policy</a></li>
                        <li><a href="terms_of_use.php">Terms of Use</a></li>
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