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
            $sql = "SELECT * FROM credentials WHERE ID = '$host_id'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
            } else {
                die("Something went wrong.");
            }
            echo '<title>' . $event_name . '</title>';
            $conn->close();
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
                        <?php echo $user['first_name'] . ' ' . $user['last_name'] ?>
                    </button>
                </p>
                <p>
                    <strong>Location:</strong> <?php echo $event['place'] ?>
                    <?php 
                        if (!$finished && $is_host) {
                            echo '
                                <button class="host-button" onclick="show_change_loc_form()">
                                    Change
                                </button>
                            ';
                        }
                    ?>
                </p>

                <div id="change-loc" hidden class="login-form">
                    <form method="post" action="change_loc.php?id=<?php echo $event_id ?>">
                        <label for="change-location">New location</label>
                        <input id="change-location" required name="new" type="text" title="Must be a valid location" placeholder="Enter new location">
                        <button type="submit" class="btn">Change Location</button>
                    </form>
                </div>

                <p>
                    <strong>Date & Time:</strong> <?php echo $event['date'] ?>
                    <?php 
                        if (!$finished && $is_host) {
                            echo '
                                <button class="host-button" onclick="show_change_date_form()">
                                    Change
                                </button>
                            ';
                        }
                    ?>
                </p>

                <div id="change-date" hidden class="login-form">
                    <form method="post" action="change_date.php?id=<?php echo $event_id ?>">
                        <label for="change-datee">New date and time</label>
                        <input id="change-datee" required name="new" type="datetime-local" placeholder="Enter new date and time">
                        <button type="submit" class="btn">Change Date And Time</button>
                    </form>
                </div>

                <p>
                    <strong><?php if ($finished) echo 'Attended:'; else echo 'Capacity:' ?></strong> <?php echo $event['current_cap'] . '/' . $event['capacity']?>
                    <?php 
                        if (!$finished && $is_host) {
                            echo '
                                <button class="host-button" onclick="show_change_cap_form()">
                                    Change
                                </button>
                            ';
                        }
                    ?>
                </p>

                <div id="change-cap" hidden class="login-form">
                    <form method="post" action="change_cap.php?id=<?php echo $event_id ?>">
                        <label for="change-capa">New capacity</label>
                        <input id="change-capa" required name="new" type="number" min="5" max="1000" title="Must be between 5 and 1000 (inclusive)" placeholder="Enter new capacity">
                        <button type="submit" class="btn">Change Capacity</button>
                    </form>
                </div>

                <p class="event-page-description">
                    <strong>Description:</strong> <?php echo $event['description'] ?>
                    <?php 
                        if (!$finished && $is_host) {
                            echo '
                                <button class="host-button" onclick="show_change_desc_form()">
                                    Change
                                </button>
                            ';
                        }
                    ?>
                </p>

                <div id="change-des" hidden class="login-form">
                    <form method="post" action="change_desc.php?id=<?php echo $event_id ?>">
                        <label for="change-desc">New description</label>
                        <textarea id="change-desc" required name="new" placeholder="Enter new description"></textarea>
                        <button type="submit" class="btn">Change Description</button>
                    </form>
                </div>

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
                    <button id="delete-event-button" <?php if ($finished) echo 'disabled' ?> <?php if (!$is_host) echo 'hidden'; ?> class="signup-button withdraw" onclick="show_delete_confirmation_button()">
                        <?php
                            if ($finished) {
                                echo 'Event ended, cannot delete';
                            } else {
                                echo 'Delete event';
                            }
                        ?>
                    </button>
                    <button hidden id="delete-event-confirm" <?php if (!$is_host) echo 'hidden'; ?> class="signup-button withdraw" onclick="window.location.href='delete_event.php?id=<?php echo $event_id ?>'">
                        <?php
                            if ($finished) {
                                echo 'Cannot delete an event that has already finished';
                            } else {
                                echo 'Click again to confirm delete'; 
                            } 
                        ?>
                    </button>
                </div>
            </div>
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
