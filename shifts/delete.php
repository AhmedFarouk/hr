<?php
// محتوى تجريبي للملف: delete.php
// هذا الملف ضمن: /mnt/data/hr_system_final/shifts
?>
<?php
require_once '../config/db.php';
include '../includes/auth.php';

$id = intval($_GET['id']);

// تحقق من وجود ربط مع الحضور
$check = $conn->query("SELECT COUNT(*) AS total FROM attendance WHERE shift_id = $id");
$count = $check->fetch_assoc()['total'];
if ($count > 0) {
    die("لا يمكن حذف هذه الوردية لأنها مرتبطة بسجلات حضور.");
}

$conn->query("DELETE FROM shifts WHERE id = $id");
header("Location: index.php");
exit;
