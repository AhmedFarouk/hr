<?php
// محتوى تجريبي للملف: delete.php
// هذا الملف ضمن: /mnt/data/hr_system_final/branches
?>
<?php
// branches/delete.php
require_once '../config/db.php';
require_once '../includes/auth.php';

if (!has_permission('branches', 'delete')) {
    die('غير مصرح بالدخول');
}

$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM branches WHERE id = ?");
$stmt->execute([$id]);

header("Location: index.php");
exit;
