<?php
// محتوى تجريبي للملف: edit.php
// هذا الملف ضمن: /mnt/data/hr_system_final/admin/permissions
?>
<?php
// admin/permissions/edit.php
// تعديل صلاحيات مشرف معين

require_once '../../config/db.php';
require_once '../../includes/auth.php';

if (!has_permission('permissions', 'edit')) {
    die("غير مصرح لك بتعديل الصلاحيات.");
}

$id = $_GET['id'] ?? null;
if (!$id) die("رقم غير صالح");

$stmt = $conn->prepare("SELECT * FROM admins WHERE id = ?");
$stmt->execute([$id]);
$admin = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$admin) die("المشرف غير موجود");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $role = $_POST['role'] ?? '';
    $stmt = $conn->prepare("UPDATE admins SET role = ? WHERE id = ?");
    $stmt->execute([$role, $id]);
    header("Location: index.php");
    exit;
}
?>

<h3>تعديل صلاحيات: <?= htmlspecialchars($admin['name']) ?></h3>

<form method="post">
    <label>الدور / الصلاحيات:</label>
    <input type="text" name="role" value="<?= htmlspecialchars($admin['role']) ?>" required>
    <button type="submit">حفظ</button>
</form>