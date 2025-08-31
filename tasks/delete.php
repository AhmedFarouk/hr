<?php
// محتوى تجريبي للملف: delete.php
// هذا الملف ضمن: /mnt/data/hr_system_final/tasks
?>
<?php
require_once '../config/db.php';
include '../includes/auth.php';

$id = intval($_GET['id']);
$conn->query("DELETE FROM tasks WHERE id = $id");
header("Location: index.php");
exit;
