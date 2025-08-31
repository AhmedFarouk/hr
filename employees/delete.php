<?php
// محتوى تجريبي للملف: delete.php
// هذا الملف ضمن: /mnt/data/hr_system_final/employees
?>
<?php
require_once '../config/db.php';
require_once '../includes/auth.php';

$id = $_GET['id'] ?? 0;

$conn->prepare("DELETE FROM employees WHERE id = ?")->execute([$id]);

header("Location: index.php");
exit;
