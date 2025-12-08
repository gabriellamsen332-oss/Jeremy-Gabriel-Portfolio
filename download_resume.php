<?php
require_once 'config.php';

$aboutFile = ABOUT_FILE;
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
$bio = $aboutInfo['bio'] ?? 'I am a 19-year-old Information Technology student.';
$email = $aboutInfo['email'] ?? 'gabriellamsen332@gmail.com';
$location = $aboutInfo['location'] ?? 'Arellano St., Pantal, Dagupan City, 2400, North Luzon, Philippines';

header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="' . str_replace(' ', '_', $name) . '_Resume.pdf"');
header('Cache-Control: private');

$html = '<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        h1 { color: #000000ff; text-align: center; border-bottom: 3px solid #000000ff; padding-bottom: 10px; }
        h2 { color: #000000ff; margin-top: 30px; border-bottom: 2px solid #000000ff; padding-bottom: 5px; }
        .info-grid { display: table; width: 100%; margin: 20px 0; }
        .info-row { display: table-row; }
        .info-label { display: table-cell; font-weight: bold; padding: 5px 20px 5px 0; width: 150px; }
        .info-value { display: table-cell; padding: 5px 0; }
        ul { list-style-type: none; padding: 0; }
        li { padding: 8px 0; border-bottom: 1px solid #eee; }
        .footer { text-align: center; margin-top: 50px; color: #000000ff; font-size: 12px; }
    </style>
</head>
<body>
    <h1>' . htmlspecialchars($name) . '</h1>
    <p style="text-align: center; font-size: 18px; color: #000000ff;">' . htmlspecialchars($title) . '</p>
    
    <div class="info-grid">
        <div class="info-row">
            <div class="info-label">Age:</div>
            <div class="info-value">' . htmlspecialchars($age) . '</div>
        </div>
        <div class="info-row">
            <div class="info-label">Block:</div>
            <div class="info-value">' . htmlspecialchars($block) . '</div>
        </div>
        <div class="info-row">
            <div class="info-label">Email:</div>
            <div class="info-value">' . htmlspecialchars($email) . '</div>
        </div>
        <div class="info-row">
            <div class="info-label">Location:</div>
            <div class="info-value">' . htmlspecialchars($location) . '</div>
        </div>
    </div>
    
    <h2>About Me</h2>
    <p>' . nl2br(htmlspecialchars($bio)) . '</p>
    
    <h2>Skills I\'m Learning</h2>
    <ul>
        <li>HTML & CSS</li>
        <li>JavaScript</li>
        <li>PHP</li>
        <li>Database Management</li>
        <li>Programming Fundamentals</li>
    </ul>
    
    <h2>Education</h2>
    <p><strong>Universidad De Dagupan (UDD)</strong><br>
    Bachelor of Science in Information Technology<br>
    Block: ' . htmlspecialchars($block) . '<br>
    Status: Currently Enrolled</p>
    
    <div class="footer">
        Generated on ' . date('F d, Y') . '
    </div>
</body>
</html>';

require_once 'vendor/autoload.php';
use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream(str_replace(' ', '_', $name) . '_Resume.pdf', ['Attachment' => 1]);
exit;
?>
