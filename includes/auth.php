<?php
// محتوى تجريبي للملف: auth.php
// هذا الملف ضمن: /mnt/data/hr_system_final/includes
?>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['admin'])) {
    header("Location: /admin/login.php");
    exit;
}
