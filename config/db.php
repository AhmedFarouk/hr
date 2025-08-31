<?php
// محتوى تجريبي للملف: db.php
// هذا الملف ضمن: /mnt/data/hr_system_final/config
?>
<?php
// config/db.php
// هذا الملف مسؤول عن الاتصال بقاعدة البيانات باستخدام PDO

$host = 'localhost';
$dbname = 'hr_system';
$user = 'root';
$pass = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("فشل الاتصال بقاعدة البيانات: " . $e->getMessage());
}
