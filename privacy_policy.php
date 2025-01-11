<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="style.css?v=<?php echo filemtime('style.css'); ?>">
        <link rel="icon" href="PlanCraft Logo1.png" type="image/icon type">
        <title>Security & Privacy Policy - PlanCraft Jo</title>
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
            <section id="privacy-policy">
                <h1>Security & Privacy Policy</h1>
                <p>Last updated: January 10, 2025</p>

                <h2>1. Introduction</h2>
                <p>At PlanCraft Jo, we are committed to protecting your privacy and ensuring the security of your personal information. This policy outlines how we collect, use, and protect your data when you use our services.</p>

                <h2>2. Information We Collect</h2>
                <p>We may collect personal information from you when you register for an account, create an event, or participate in community events. This information may include:</p>
                <ul>
                    <li>Name</li>
                    <li>Email address</li>
                    <li>Phone number</li>
                    <li>Payment information if applicable</li>
                    <li>Event participation details</li>
                </ul>

                <h2>3. How We Use Your Information</h2>
                <p>Your information is used to:</p>
                <ul>
                    <li>Facilitate event registrations and communications.</li>
                    <li>Improve our services and user experience.</li>
                    <li>Send you updates and promotional materials (with your consent).</li>
                    <li>Ensure compliance with legal obligations.</li>
                </ul>

                <h2>4. Data Security</h2>
                <p>We implement a variety of security measures to maintain the safety of your personal information. These include:</p>
                <ul>
                    <li>Encryption of sensitive data during transmission.</li>
                    <li>Regular security audits and vulnerability assessments.</li>
                    <li>Access controls to limit who can view your personal information.</li>
                </ul>

                <h2>5. Sharing Your Information</h2>
                <p>We do not sell or rent your personal information to third parties. We may share your information with trusted partners who assist us in operating our website or conducting our business, as long as those parties agree to keep this information confidential.</p>

                <h2>6. Your Rights</h2>
                <p>You have the right to:</p>
                <ul>
                    <li>Request access to the personal data we hold about you.</li>
                    <li>Request correction of any inaccurate data.</li>
                    <li>Request deletion of your personal data under certain circumstances.</li>
                    <li>Withdraw consent for processing your data at any time.</li>
                </ul>

                <h2>7. Changes to This Policy</h2>
                <p>We may update this Security & Privacy Policy from time to time. Any changes will be posted on this page with an updated effective date. Your continued use of our services after any changes constitutes acceptance of the new policy.</p>

                <h2>8. Contact Us</h2>
                <p>If you have any questions about this Security & Privacy Policy, please contact us at support@PlanCraft.jo.</p>
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
    </body>
</html>
