<?php
// محتوى تجريبي للملف: delete.php
// هذا الملف ضمن: /mnt/data/hr_system_final/documents
?>
<?php
// documents/delete.php
require_once '../config/db.php';
require_once '../includes/auth.php';

$id = $_GET['id'] ?? 0;
$employee_id = $_GET['employee_id'] ?? 0;

$stmt = $conn->prepare("SELECT file_path FROM documents WHERE id = ?");
$stmt->execute([$id]);
$file = $stmt->fetchColumn();

if ($file && file_exists("../assets/uploads/$file")) {
    unlink("../assets/uploads/$file");
}

$conn->prepare("DELETE FROM documents WHERE id = ?")->execute([$id]);

header("Location: index.php?employee_id=$employee_id");
exit;
