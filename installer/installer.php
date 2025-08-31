<?php
// محتوى تجريبي للملف: installer.php
// هذا الملف ضمن: /mnt/data/hr_system_final/installer
?>
<?php
// ملف: installer/installer.php
// يقوم بإنشاء قاعدة البيانات والجداول تلقائيًا عند التثبيت الأول

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'hr_system';

// الاتصال بالسيرفر
$conn = new mysqli($host, $user, $password);
if ($conn->connect_error) {
    die("فشل الاتصال بالسيرفر: " . $conn->connect_error);
}

// إنشاء قاعدة البيانات إذا لم تكن موجودة
$conn->query("CREATE DATABASE IF NOT EXISTS $dbname CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");

// اختيار قاعدة البيانات
$conn->select_db($dbname);

// استيراد ملف SQL للجداول
$sql = file_get_contents('schema.sql');

if ($conn->multi_query($sql)) {
    echo "<h3>✅ تم إنشاء قاعدة البيانات والجداول بنجاح.</h3>";
} else {
    echo "<h3>❌ حدث خطأ أثناء إنشاء الجداول: " . $conn->error . "</h3>";
}

$conn->close();
