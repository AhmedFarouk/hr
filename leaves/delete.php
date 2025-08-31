<?php
// محتوى تجريبي للملف: delete.php
// هذا الملف ضمن: /mnt/data/hr_system_final/leaves
?>
<?php
require_once '../config/db.php';
include '../includes/auth.php';

$id = $_GET['id'];
$conn->query("DELETE FROM leaves WHERE id = $id");
header("Location: index.php");
exit;
