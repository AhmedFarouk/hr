<?php
// محتوى تجريبي للملف: index.php
// هذا الملف ضمن: /mnt/data/hr_system_final/admin
?>
<?php
// admin/index.php
// لوحة تحكم المشرف - صفحة رئيسية بعد تسجيل الدخول

require_once '../config/db.php';
require_once '../includes/auth.php';
include '../includes/header.php';

// تحقق من الصلاحيات
if (!has_permission('admin_dashboard', 'view')) {
    die("غير مصرح لك بعرض هذه الصفحة.");
}

?>

<h2>لوحة تحكم المشرف</h2>

<div class="dashboard">
    <ul>
        <li><a href="../employees/index.php">إدارة الموظفين</a></li>
        <li><a href="../attendance/index.php">سجل الحضور</a></li>
        <li><a href="../salaries/index.php">المرتبات</a></li>
        <li><a href="../tasks/index.php">المهام</a></li>
        <li><a href="permissions/">الصلاحيات</a></li>
    </ul>
</div>

<?php include '../includes/footer.php'; ?>