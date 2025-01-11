<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="style.css?v=<?php echo filemtime('style.css'); ?>">
        <link rel="icon" href="PlanCraft Logo1.png" type="image/icon type">
        <title>Terms of Use - PlanCraft Jo</title>
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
            <section id="terms-of-use">
                <h1>Terms of Use</h1>
                <p>Last updated: January 10, 2025</p>

                <h2>1. Introduction</h2>
                <p>Welcome to PlanCraft Jo! These Terms of Use govern your use of our website and services. By accessing or using our platform, you agree to comply with these terms.</p>

                <h2>2. Acceptance of Terms</h2>
                <p>By using our services, you confirm that you accept these terms and that you agree to comply with them. If you do not agree with these terms, please refrain from using our services.</p>

                <h2>3. Changes to Terms</h2>
                <p>We may update these terms from time to time. Any changes will be posted on this page with an updated effective date. Your continued use of the services after any changes constitutes acceptance of the new terms.</p>

                <h2>4. User Responsibilities</h2>
                <p>You are responsible for ensuring that any information you provide is accurate and up-to-date. You agree not to use the platform for any unlawful or prohibited activities.</p>

                <h2>5. Intellectual Property Rights</h2>
                <p>All content on this website, including text, graphics, logos, and images, is the property of PlanCraft Jo or its licensors and is protected by copyright and other intellectual property laws.</p>

                <h2>6. Limitation of Liability</h2>
                <p>PlanCraft Jo shall not be liable for any indirect, incidental, or consequential damages arising from your use of our services.</p>

                <h2>7. Governing Law</h2>
                <p>These terms shall be governed by and construed in accordance with the laws of Jordan.</p>

                <h2>8. Contact Us</h2>
                <p>If you have any questions about these Terms of Use, please contact us at support@PlanCraft.jo.</p>
            </section>
        </main>

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

        <script src="your_script.js"></script>
    </body>
</html>
