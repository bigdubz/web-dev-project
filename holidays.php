<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="style.css?v=<?php echo filemtime('style.css'); ?>">
        <link rel="icon" href="PlanCraft Logo1.png" type="image/icon type">
        <title>Jordan's Public Holidays - PlanCraft Jo</title>
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

        <main>
            <section id="public-holidays">
                <h1>Upcoming Holidays (January 2025 to December 2025)</h1>
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Day</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>More Information</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>26 Jan</td><td>Sunday</td><td>Al Isra' wal Miraj (Tentative Date)</td><td>Observance</td><td><a href="https://en.wikipedia.org/wiki/Isra%27_and_Mi%27raj" target="_blank">Visit Wiki</a></td></tr>
                        <tr><td>1 Mar</td><td>Saturday</td><td>Ramadan begins (Tentative Date)</td><td>Observance</td><td><a href="https://en.wikipedia.org/wiki/Ramadan" target="_blank">Visit Wiki</a></td></tr>
                        <tr><td>30 Mar</td><td>Sunday</td><td>Eid al-Fitr (Tentative Date)</td><td>National Holiday</td><td rowspan="4"><a href="https://en.wikipedia.org/wiki/Eid_al-Fitr" target="_blank">Visit Wiki</a></td></tr>
                        <tr><td>31 Mar</td><td>Monday</td><td>Eid al-Fitr holiday (Tentative Date)</td><td>National Holiday</td></tr>
                        <tr><td>1 Apr</td><td>Tuesday</td><td>Eid al-Fitr holiday (Tentative Date)</td><td>National Holiday</td></tr>
                        <tr><td>2 Apr</td><td>Wednesday</td><td>Eid al-Fitr holiday (Tentative Date)</td><td>National Holiday</td></tr>
                        <tr><td>18 Apr</td><td>Friday</td><td>Orthodox Good Friday</td><td>Observance</td><td rowspan="2"><a href="https://en.wikipedia.org/wiki/Good_Friday" target="_blank">Visit Wiki</a></td></tr>
                        <tr><td>18 Apr</td><td>Friday</td><td>Good Friday</td><td>Observance</td></tr>
                        <tr><td>20 Apr</td><td>Sunday</td><td>Easter Sunday</td><td>Observance</td><td rowspan="4"><a href="https://en.wikipedia.org/wiki/Easter" target="_blank">Visit Wiki</a></td></tr>
                        <tr><td>20 Apr</td><td>Sunday</td><td>Orthodox Easter Day</td><td>Optional Holiday</td></tr>
                        <tr><td>21 Apr</td><td>Monday</td><td>Easter Monday</td><td>Observance</td></tr>
                        <tr><td>21 Apr</td><td>Monday</td><td>Orthodox Easter Monday</td><td>Optional Holiday</td></tr>
                        <tr><td>1 May</td><td>Thursday</td><td>Labour Day</td><td>National Holiday</td><td><a href="https://en.wikipedia.org/wiki/Labour_Day" target="_blank">Visit Wiki</a></td></tr>
                        <tr><td>25 May</td><td>Sunday</td><td>Independence Day</td><td>National Holiday</td><td><a href="https://en.wikipedia.org/wiki/Independence_Day_(Jordan)" target="_blank">Visit Wiki </a></td></tr>
                        <tr><td>5 June</td><td>Thursday</td><td>Arafah (Tentative Date)</td><td>Observance</td><td><a href="https://en.wikipedia.org/wiki/Day_of_Arafah" target="_blank">Visit Wiki</a></<td></tr>
                        <tr><td>6 June</td><td>Friday</td><td>Eid al-Adha (Tentative Date)</td><td>Observance</td><td rowspan="4"><a href="https://en.wikipedia.org/wiki/Eid_al-Adha" target="_blank">Visit Wiki	</a></td></tr>
                        <tr><td>7 June</td><td>Saturday</td><td>Eid al-Adha (Tentative Date)</td><td>Observance</td></tr>
                        <tr><td>8 June</td><td>Sunday</td><td>Eid al-Adha (Tentative Date)</td><td>Observance</td></tr>
                        <tr><td>9 June</td><td>Monday</td><td>Eid al-Adha (Tentative Date)</td><td>Observance</td></tr>
                        <tr><td>26 June</td><td>Thursday</td><td>Muharram/New Year (Tentative Date)</td><td>Observance</td><td><a href="https://en.wikipedia.org/wiki/Muharram" target="_blank">Visit Wiki</a></td></tr>
                        <tr><td>4 Sep</td><td>Thursday</td><td>Prophet's Birthday (Tentative Date)</td><td>National Holiday</td><td><a href="https://en.wikipedia.org/wiki/Mawlid" target="_blank">Visit Wiki</a></td></tr>
                        <tr><td>25 Dec</td><td>Thursday</td><td>Christmas Day</td><td>National Holiday</td><td><a href="https://en.wikipedia.org/wiki/Christmas" target="_blank">Visit Wiki</a></td></tr>
                    </tbody>
                </table>
            </section>
        </main>

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