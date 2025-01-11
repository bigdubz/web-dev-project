<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css?v=<?php echo filemtime('style.css'); ?>">
        <link rel="icon" href="images/PlanCraft Logo1.png" type="icon">
        <title>Create Event</title>
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
                            <a href="events.php">Events</a>
                            <a href="index.php">Homepage</a>
                            <a href="holidays.php">Jordan's holidays</a>
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

        <h1 style="text-align: center;margin-top: 4%;">Create Event</h1>
        <div class="login-form">
            <form method="post" action="create_event.php" enctype="multipart/form-data">

                <label for="name">Event Name</label>
                <input id="name" required name="evname" type="text" pattern=".{3,1000}$" title="Must contain at least 3 characters and at most 1000 characters" placeholder="Enter the name of your event">

                <label for="place">Event Location</label>
                <input id="place" required name="place" type="text" pattern=".{3,1000}$" title="Must contain at least 3 characters and at most 1000 characters" placeholder="Enter the location">

                <label for="date">Event Date</label>
                <input id="date" required name="date" type="datetime-local">

                <label for="cap">Maximum Capacity</label>
                <input id="cap" required name="cap" type="number" min="5" max="1000" title="Must be between 5 and 1000 (inclusive)" placeholder="Enter maximum capacity">
                
                <label for="desc">Description</label>
                <textarea id="desc" name="desc" rows="4" cols="50" placeholder="Describe your event!"></textarea>

                <label for="evimg">Event Photo</label>
                <input id="evimg" name="evimg" type="file" accept=".png, .jpg, .jpeg">

                <button type="submit" class="btn">Create Event!</button>

                <?php
                    if (!isset($_SESSION['user'])) {
                        header("Location: login.php");
                    }
                            
                    if (isset($_POST['evname']) && isset($_POST['place']) && isset($_POST['date']) && isset($_POST['cap'])) {
                        $name = str_replace("'", "\'", $_POST['evname']);
                        $place = str_replace("'", "\'", $_POST['place']);
                        $date = str_replace("'", "\'", $_POST['date']);
                        $capacity = str_replace("'", "\'", $_POST['cap']);
                        $desc = str_replace("'", "\'", $_POST['desc']);

                        $user_id = $_SESSION['user']['id'];

                        $servername = "localhost";
                        $dbname = "webpage design project";

                        $conn = new mysqli($servername, "root", "", $dbname);

                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $targetFilePath = "";
                        $too_large = isset($_FILES["evimg"]) && $_FILES["evimg"]["error"] == 1;
                        if ($too_large) {
                            echo '<p>Error: Image file is too big</p>';
                            $sql = "";
                        } else if (isset($_FILES["evimg"]) && $_FILES["evimg"]["error"] == 0) {
                            $targetDir = "uploads/";
                            $fileName = basename($_FILES["evimg"]["name"]);
                            $targetFilePath = $targetDir . $fileName;
                            move_uploaded_file($_FILES["evimg"]["tmp_name"], $targetFilePath);
                            $sql = "INSERT INTO events (name, date, place, capacity, description, current_cap, img, host_id) VALUES ('$name', '$date', '$place', '$capacity', '$desc', 0, '$targetFilePath', '$user_id')";
                        } else {
                            $sql = "INSERT INTO events (name, date, place, capacity, description, current_cap, host_id) VALUES ('$name', '$date', '$place', '$capacity', '$desc', 0, '$user_id')";
                        }

                        if (!$too_large && $conn->query($sql) === TRUE) {
                            header("Location: user_profile.php");
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