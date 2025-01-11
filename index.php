<!--
    fix header responsiveness
-->

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="style.css?v=<?php echo filemtime('style.css'); ?>">
        <link rel="icon" href="images/PlanCraft Logo1.png" type="icon">
        <title>PlanCraft Jo</title>
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

        <main>
            <!-- headline section -->
            <section id="headline">
                <div class="headline-content">
                    <h1>Planning Community Events in Jordan</h1>
                    <p class="home_paragraph">Welcome to your hub for discovering, organizing, and participating in community events across Jordan. Our platform connects individuals, organizations, and volunteers to foster collaboration and engagement through a diverse range of activities.</p>
                    
                    <p class="home_paragraph">Whether you're looking to participate in local clean-up drives, cultural festivals, educational workshops, or social gatherings, we provide a comprehensive listing of events that cater to all interests and age groups.</p>
                    <p class="home_paragraph">Join us in building a vibrant community where everyone can contribute to positive change and enjoy meaningful experiences together. With just a few clicks, you can explore upcoming events, register for those that resonate with you, or even create your own events to invite others to join.</p>
                    <p class="home_paragraph">Together, we can make a difference in our neighborhoods and strengthen the bonds within our communities.</p>

                    <a href="events.php" class="cta-button">Explore Events</a>
                </div>
            </section>

            <section id="events">
                <h2>Featured Events</h2>
                <div class="events-grid-main">
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
                            for ($x = 0; $x < 2; $x++) {
                                if ($row = $result->fetch_assoc()) {

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
                                        <div class="event-box-main">
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
                            }
                        } else {
                            echo "<h3 style='text-align: center;color:white'>No events found.</h3>";
                        }
                        $conn->close();
                    ?>
                </div>
            </section>

            <section id="how-it-works">
                <h2>How It Works</h2>
                <div class="how-it-works-container">
                    <a href="events.php" class="link-wrapper">
                        <div class="how-it-card">
                            <img src="images/discover_icon.png" alt="Discover Icon" class="icon" />
                            <h3>Discover</h3>
                            <p>Browse through our list of community events that suit your interests.</p>
                        </div>
                    </a>
                    <a href="signup.php" class="link-wrapper">
                        <div class="how-it-card">
                            <img src="images/register_icon.png" alt="Register Icon" class="icon" />
                            <h3>Register</h3>
                            <p>Sign up for events that interest you with just a few clicks.</p>
                        </div>
                    </a>
                    <a href="create_event.php" class="link-wrapper">
                        <div class="how-it-card">
                            <img src="images/create_icon.png" alt="Create Icon" class="icon" />
                            <h3>Create</h3>
                            <p>Organize your own events and invite others to join in!</p>
                        </div>
                    </a>
                </div>
            </section>

        </main>

        <footer>
            <div class="footer-container">
                <div class="footer-section">
                    <h3>Resources</h3>
                    <ul>
                        <li><a href="holidays.php">Jordan's Public Holidays</a></li>
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