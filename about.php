<?php
$aboutFile = 'data/about.txt';
$aboutInfo = [];

if (file_exists($aboutFile)) {
    $content = file_get_contents($aboutFile);
    if ($content) {
        $lines = explode("\n", trim($content));
        foreach ($lines as $line) {
            if (strpos($line, ':') !== false) {
                list($key, $value) = explode(':', $line, 2);
                $aboutInfo[trim($key)] = trim($value);
            }
        }
    }
}

$name = $aboutInfo['name'] ?? 'Jeremy Gabriel L. Batac';
$age = $aboutInfo['age'] ?? '19';
$block = $aboutInfo['block'] ?? '21-ITE-04';
$title = $aboutInfo['title'] ?? 'IT Student';
$bio = $aboutInfo['bio'] ?? 'I am a 19-year-old Information Technology student at the Universidad De Dagupan, currently in Block 21-ITE-04. I am passionate about learning new technologies and developing my skills in programming and web development.';
$email = $aboutInfo['email'] ?? 'gabriellamsen332@gmail.com';
$location = $aboutInfo['location'] ?? 'Arellano St., Pantal, Dagupan City, 2400, North Luzon, Philippines';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Me - Jeremy Gabriel</title>
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
                <li><a href="about.php" class="active">About</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="about-section">
            <div class="container">
                <h2>About Me</h2>
                
                <div class="about-content">
                    <div class="about-image">
                        <img src="assets/img/profile.jpeg" alt="<?php echo htmlspecialchars($name); ?>">
                    </div>
                    
                    <div class="about-text">
                        <h3><?php echo htmlspecialchars($name); ?></h3>
                        <h4><?php echo htmlspecialchars($title); ?></h4>
                        <p><?php echo htmlspecialchars($bio); ?></p>
                        
                        <div class="info-grid">
                            <div class="info-item">
                                <strong>Age:</strong>
                                <span><?php echo htmlspecialchars($age); ?></span>
                            </div>
                            <div class="info-item">
                                <strong>Block:</strong>
                                <span><?php echo htmlspecialchars($block); ?></span>
                            </div>
                            <div class="info-item">
                                <strong>Email:</strong>
                                <span><?php echo htmlspecialchars($email); ?></span>
                            </div>
                            <div class="info-item">
                                <strong>School Address:</strong>
                                <span><?php echo htmlspecialchars($location); ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="skills-section">
                    <h3>Skills I'm Learning</h3>
                    <ul class="skills-list">
                        <li>HTML & CSS</li>
                        <li>JavaScript</li>
                        <li>PHP</li>
                        <li>Database Management</li>
                        <li>Programming Fundamentals</li>
                    </ul>
                </div>

                <div class="description-section">
                    <h3>Description</h3>
                    <div contenteditable="true" class="editable-description" id="description">
                        Click here to edit your description...
                    </div>
                    <button class="btn btn-secondary" id="saveDescription">Save Description</button>
                </div>

                <div class="resume-download">
                    <a href="download_resume.php" class="btn btn-primary" download>
                        <span>📄</span> Download My Resume
                    </a>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Jeremy Gabriel L. Batac. All rights reserved.</p>
    </footer>

    <script src="assets/js/main.js"></script>
    <script>
        const descriptionEl = document.getElementById('description');
        const saveBtn = document.getElementById('saveDescription');
        
        const savedDescription = localStorage.getItem('aboutDescription');
        if (savedDescription) {
            descriptionEl.textContent = savedDescription;
        }
        
        saveBtn.addEventListener('click', () => {
            const description = descriptionEl.textContent;
            localStorage.setItem('aboutDescription', description);
            alert('Description saved successfully!');
        });
    </script>
</body>
</html>