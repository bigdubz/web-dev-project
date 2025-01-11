<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="style.css?v=<?php echo filemtime('style.css'); ?>">
        <link rel="icon" href="images/PlanCraft Logo1.png" type="icon">
        <script src="script.js?v=<?php echo filemtime('script.js'); ?>"></script>
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
            $host_id = $event['host_id'];
            $sql = "SELECT username FROM credentials WHERE ID = '$host_id'";
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
                <a href="events.php" class="eventbtn">Explore Events</a>
                <?php
                    if (!isset($_SESSION['user'])) {
                        echo '
                            <a href="login.php" class="eventbtn">Create Your Own Event</a>
                            <a href="login.php" class="eventbtn">Log In</a>
                            <a href="signup.php" class="eventbtn">Sign Up</a>
                        ';
                    } else {
                            echo '
                                <a class="eventbtn" href="create_event.php">Create Your Own Event</a>
                                <a id="link-logo" class="link-wrapper" href="user_profile.php">
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
            <?php 
                $current_time = time();
                $event_time = $event['date'];
                $event_time = strtotime($event_time);
                $finished = $current_time >= $event_time;

                $disabled = $event['current_cap'] >= $event['capacity'];
                $guest = !isset($_SESSION['user']);
                $is_host = FALSE;
                $already_signed_up = FALSE;
                if (!$guest) {
                    $user_events = explode(',', $_SESSION['user']['events']);
                    foreach ($user_events as $user_event_id) {
                        if ($user_event_id == $event_id) {
                            $already_signed_up = TRUE;
                            break;
                        }
                    }

                    $is_host = $_SESSION['user']['id'] == $host_id;
                }
                $can_sign_up_after_log_in = !$guest || $disabled || $finished
            ?>
            <div class="event-page-image">
                <img class="event-page-img" src="<?php echo $event['img'] ?>" alt="<?php echo $event_name ?>">
            </div>
            <div class="event-page-details">
                <h1 class="event-page-title"><?php echo $event_name ?></h1>
                <p>
                    <strong>Host:</strong> 
                    <button class="host-button" onclick="window.location.href='profile.php?id=<?php echo $host_id ?>';">
                        <?php echo $user['username']?>
                    </button>
                </p>
                <p><strong>Location:</strong> <?php echo $event['place'] ?></p>
                <p><strong>Date & Time:</strong> <?php echo $event['date'] ?></p>
                <p><strong><?php if ($finished) echo 'Attended:'; else echo 'Capacity:' ?></strong> <?php echo $event['current_cap'] . '/' . $event['capacity']?></p>
                <p class="event-page-description">
                    <strong>Description:</strong> <?php echo $event['description'] ?>
                </p>
                <div class="event-actions">
                    <button <?php if ($can_sign_up_after_log_in) echo 'hidden' ?> class="signup-button" onclick="window.location.href='login.php'">
                        Log in to sign up for this event
                    </button>
                    <button <?php if (!$can_sign_up_after_log_in || $is_host) echo 'hidden' ?> id="sign-up-button" <?php if ($disabled || $already_signed_up || $finished) { echo 'disabled'; }?> class="signup-button" onclick="show_sign_up_confirmation_button()">
                        <?php 
                            if ($finished) {
                                echo 'This event has ended';
                            } else if ($already_signed_up) {
                                echo 'Already signed up for event';
                            } else if ($disabled) {
                                echo 'This event is currently at full capacity';
                            } else {
                                echo 'Sign up for this event';
                            }
                        ?>
                    </button>
                    <button hidden id="sign-up-confirm" class="signup-button" onclick="window.location.href='signup_to_event.php?id=<?php echo $event_id ?>'">
                        Click again to confirm sign up
                    </button>
                    <button id="withdraw-button" <?php if (!$already_signed_up || $finished) echo 'hidden'; ?> class="signup-button withdraw" onclick="show_withdraw_confirmation_button()">
                        Withdraw From Event
                    </button>
                    <button hidden id="withdraw-confirm" <?php if (!$already_signed_up) echo 'hidden'; ?> class="signup-button withdraw" onclick="window.location.href='withdraw.php?id=<?php echo $event_id ?>'">
                        Click again to confirm withdraw
                    </button>
                    <button id="delete-event-button" <?php if (!$is_host) echo 'hidden'; ?> class="signup-button withdraw" onclick="show_delete_confirmation_button()">
                        Delete event
                    </button>
                    <button hidden id="delete-event-confirm" <?php if (!$is_host) echo 'hidden'; ?> class="signup-button withdraw" onclick="window.location.href='delete_event.php?id=<?php echo $event_id ?>'">
                        Click again to confirm delete
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
