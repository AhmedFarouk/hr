<?php
// محتوى تجريبي للملف: save.php
// هذا الملف ضمن: /mnt/data/hr_system_final/admin/permissions
?>
<?php
// admin/permissions/save.php
// حفظ التعديلات على صلاحيات مشرف عبر POST

require_once '../../config/db.php';
require_once '../../includes/auth.php';

if (!has_permission('permissions', 'edit')) {
    die("غير مصرح لك");
}

$admin_id = $_POST['admin_id'] ?? null;
$role = $_POST['role'] ?? '';

if ($admin_id && $role) {
    $stmt = $conn->prepare("UPDATE admins SET role = ? WHERE id = ?");
    $stmt->execute([$role, $admin_id]);
    echo "تم التحديث بنجاح";
} else {
    echo "بيانات غير صالحة";
}
