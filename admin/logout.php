<?php
// محتوى تجريبي للملف: logout.php
// هذا الملف ضمن: /mnt/data/hr_system_final/admin
?>
<?php
// admin/logout.php
// تسجيل الخروج للمشرف

session_start();
session_unset();
session_destroy();

header("Location: ../index.php");
exit;
