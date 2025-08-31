<?php
// محتوى تجريبي للملف: delete.php
// هذا الملف ضمن: /mnt/data/hr_system_final/penalties
?>
<?php
require_once '../config/db.php';
include '../includes/auth.php';

$id = $_GET['id'];
$conn->query("DELETE FROM penalties WHERE id = $id");
header("Location: index.php");
exit;
