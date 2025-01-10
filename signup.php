<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css?v=<?php echo filemtime('style.css'); ?>">
        <link rel="icon" href="images/PlanCraft Logo1.png" type="icon">
        <script src="script.js"></script>
        <title>Sign Up</title>
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

        <h1 style="text-align: center;margin-top: 4%;">Create a new account</h1>
        <div class="login-form">
            <form method="get" action="signup.php">
                <label for="username">Username*</label>
                <input id="username" required name="username" type="text" pattern="^[A-z0-9._]{4,20}$" title="Must contain at least 4 characters and at most 20 characters, can only contain alphanumeric characters (will be used to sign in)" placeholder="Enter your username">

                <div id="user-first-last-name">
                    <div>
                        <label for="first_name">First name*</label>
                        <input id="first_name" required name="first" type="text" pattern="[A-z]{,50}" title="Your first name (will be displayed on your events)" placeholder="Enter your first name">
                    </div>

                    <div>
                        <label for="last_name">Last name</label>
                        <input id="last_name" name="last" type="text" pattern="[A-z]{,50}" title="Your last name (will be displayed on your events)" placeholder="Enter your last name">
                    </div>
                </div>

                <label for="email">Email*</label>
                <input id="email" required name="email" type="text" pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$" title="Must be a valid email" placeholder="Enter your email">

                <label for="password">Password*</label>
                <input id="pwd" required name="pwd" type="password" pattern=".{4,20}$" title="Must contain at least 4 characters and at most 20 characters" onkeyup="validate()" placeholder="Enter your password">

                <label for="confpwd">Confirm password*</label>
                <input id="confpwd" required type="password" pattern=".{4,20}$" title="Passwords must match" onkeyup="validate()" placeholder="Confirm your password">

                <p id="pwd-conf-warning" hidden>Passwords must match!</p>
                <button disabled id="submit" type="submit" class="btn">Create Account!</button>

                <?php
                    if (isset($_SESSION['user'])) {
                        header("Location: index.php");
                    } else if (isset($_GET['username']) && isset($_GET['email']) && isset($_GET['pwd']) && isset($_GET['first'])) {
                        $username = strtolower($_GET['username']);
                        $email = $_GET['email'];
                        $password = $_GET['pwd'];
                        $first_name = $_GET['first'];
                        $last_name = $_GET['last'];

                        $servername = "localhost";
                        $dbname = "webpage design project";

                        $conn = new mysqli($servername, "root", "", $dbname);

                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $check = "SELECT (username) FROM credentials WHERE username = '$username'";
                        $qcheck = $conn->query($check);

                        if ($qcheck->num_rows != 0) {
                            echo "<p>This username already exists!</p>";
                        } else {
                            $sql = "INSERT INTO credentials (username, first_name, last_name, email, password) VALUES ('$username', '$first_name', '$last_name', '$email', '$password')";
                            if ($conn->query($sql) === TRUE) {
                                $sql = "SELECT * FROM credentials WHERE username = '$username'";
                                $result = $conn->query($sql);
                                if ($result->num_rows == 1) {
                                    $row = $result->fetch_assoc();
                                    $_SESSION['user'] = [
                                        'id' => htmlspecialchars($row['ID']),
                                        'first' => $first_name,
                                        'last' => $last_name,
                                        'username' => $username,
                                        'email' => htmlspecialchars($row['email']),
                                        'events' => $row['events'] != NULL ? htmlspecialchars($row['events']) : ""
                                    ];
                                }
                                session_regenerate_id(true);
                                header("Location: index.php");
                            } else {
                                echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
                            }
                        }
                        $conn->close();
                    }
                ?>
        </form>
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