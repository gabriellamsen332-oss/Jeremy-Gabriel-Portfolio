<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Me - Jeremy Gabriel</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <h1>Jeremy Gabriel L. Batac</h1>
            </div>
            <ul class="nav-links">
                <li><a href="index.html">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php" class="active">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="contact-section">
            <div class="container">
                <h2>Contact Me</h2>
                <p>Have a question or want to work together? Feel free to reach out!</p>

                <?php
                if (isset($_GET['status'])) {
                    $msg = isset($_GET['msg']) ? $_GET['msg'] : '';
                    
                    if ($_GET['status'] == 'success') {
                        if ($msg == 'email_pending') {
                            echo '<div class="alert alert-success">Thank you! Your message has been saved. Email notification is pending.</div>';
                        } else {
                            echo '<div class="alert alert-success">✓ Thank you for your message! I have received it and will get back to you soon.</div>';
                        }
                    } elseif ($_GET['status'] == 'error') {
                        if ($msg == 'missing_fields') {
                            echo '<div class="alert alert-error">✗ Please fill in all required fields.</div>';
                        } elseif ($msg == 'invalid_email') {
                            echo '<div class="alert alert-error">✗ Please enter a valid email address.</div>';
                        } else {
                            echo '<div class="alert alert-error">✗ Sorry, there was an error sending your message. Please try again.</div>';
                        }
                    }
                }
                ?>

                <form action="submit_contact.php" method="POST" class="contact-form">
                    <div class="form-group">
                        <label for="name">Name *</label>
                        <input type="text" id="name" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="subject">Subject *</label>
                        <input type="text" id="subject" name="subject" required>
                    </div>

                    <div class="form-group">
                        <label for="message">Message *</label>
                        <textarea id="message" name="message" rows="6" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>

                <div class="contact-info">
                    <h3>Other Ways to Reach Me</h3>
                    <p><strong>Email:</strong>gabriellamsen332@gmail.com</p>
                    <p><strong>Location:</strong> Arellano St., Pantal, Dagupan City, 2400, North Luzon, Philippines</p>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Jeremy Gabriel L. Batac. All rights reserved.</p>
    </footer>

    <script src="assets/js/main.js"></script>
</body>
</html>