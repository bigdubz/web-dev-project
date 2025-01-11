<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css?v=<?php echo filemtime('style.css'); ?>">
        <link rel="icon" href="images/PlanCraft Logo1.png" type="icon">
        <title>Log in</title>
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
                    if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                    }
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

        <h1 class="page-header">Log in to your account</h1>

        <div class="login-form">
            <form method="get" action="login.php">
                <?php
                    if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                    }
                    if (isset($_SESSION['user'])) {
                        header("Location: index.php");
                    }
                    else {
                        echo '
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" placeholder="Enter your username" required>
                            <label for="password">Password</label>
                            <input type="password" id="password" name="pwd" placeholder="Enter your password" required>
                            <button type="submit" class="btn">Log In</button>
                        ';
                    }
                    if (isset($_GET['username']) && isset($_GET['pwd'])) {
                        $username = $_GET['username'];
                        $pwd = $_GET['pwd'];

                        $servername = "localhost";
                        $dbname = "webpage design project";
                        $conn = new mysqli($servername, "root", "", $dbname);
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        
                        $sql = "SELECT * FROM credentials WHERE username = '$username' AND password = '$pwd'";
                        $result = $conn->query($sql);

                        if ($result->num_rows == 1) {
                            $row = $result->fetch_assoc();
                            $_SESSION['user'] = [
                                'id' => htmlspecialchars($row['ID']),
                                'first' => htmlspecialchars($row['first_name']),
                                'last' => htmlspecialchars($row['last_name']),
                                'username' => $username,
                                'email' => htmlspecialchars($row['email']),
                                'events' => htmlspecialchars($row['events'])
                            ];
                            session_regenerate_id(true);
                            header("Location: index.php");
                        } else {
                            echo "<br><p style='color:red;text-align:center'>Incorrect username or password</p>";
                        }
                        $conn->close();
                    }
                ?>
                <p style='text-align: center'>Don't have an account? <a href='signup.php' style="all:unset;cursor:pointer;color:green;text-decoration:underline";>Sign up now!</a></p>
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