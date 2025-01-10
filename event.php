<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="style.css?v=<?php echo filemtime('style.css'); ?>">
        <link rel="icon" href="images/PlanCraft Logo1.png" type="icon">
        <script src="script.js?v=<?php echo filemtime('style.css'); ?>"></script>
        <?php
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            if (!isset($_GET['id'])) {
                die("Bad event!");
            }
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
                $event_name = $event['name'];
            } else {
                die("404 event not found");
            }
            $user_id = $event['host_id'];
            $sql = "SELECT username FROM credentials WHERE ID = '$user_id'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
            } else {
                die("Something went wrong.");
            }
            echo '<title>' . $event_name . '</title>';
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

        <div class="event-page-box">
            <div class="event-page-image">
                <img class="event-page-img" src="<?php echo $event['img'] ?>" alt="<?php echo $event_name ?>">
            </div>
            <div class="event-page-details">
                <h1 class="event-page-title"><?php echo $event_name ?></h1>
                <p>
                    <strong>Host:</strong> 
                    <button class="host-button" onclick="window.location.href='profile.php?id=<?php echo $user_id ?>';">
                        <?php echo $user['username']?>
                    </button>
                </p>
                <p><strong>Location:</strong> <?php echo $event['place'] ?></p>
                <p><strong>Date & Time:</strong> <?php echo $event['date'] ?></p>
                <p><strong>Capacity:</strong> <?php echo $event['current_cap'] . '/' . $event['capacity']?></p>
                <p class="event-page-description">
                    <strong>Description:</strong> <?php echo $event['description'] ?>
                </p>
                <div class="event-actions">
                    <?php $disabled = $event['current_cap'] == $event['capacity'] ?>
                    <button id="sign-up-button" <?php if ($disabled) { echo 'disabled';}?> class="signup-button" onclick="show_confirmation_button()">
                        <?php 
                            if (!$disabled) {
                                echo 'Sign Up for Event';
                            } else {
                                echo 'Full';
                            }
                        ?>
                    </button>
                    <button hidden id="sign-up-confirm" class="signup-button" onclick="window.location.href='signup_to_event.php?id=<?php echo $event_id ?>'">
                        Click again to confirm sign up
                    </button>
                </div>
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
