<?php
// محتوى تجريبي للملف: index.php
// هذا الملف ضمن: /mnt/data/hr_system_final/admin/permissions
?>
<?php
// admin/permissions/index.php
// عرض وتعديل صلاحيات المشرفين

require_once '../../config/db.php';
require_once '../../includes/auth.php';
include '../../includes/header.php';

if (!has_permission('permissions', 'view')) {
    die("غير مصرح لك بعرض هذه الصفحة.");
}

// جلب المشرفين
$admins = $conn->query("SELECT * FROM admins")->fetchAll(PDO::FETCH_ASSOC);

?>

<h3>إدارة صلاحيات المشرفين</h3>

<table>
    <tr>
        <th>الاسم</th>
        <th>اسم المستخدم</th>
        <th>الصلاحيات</th>
        <th>تحكم</th>
    </tr>
    <?php foreach ($admins as $admin): ?>
        <tr>
            <td><?= htmlspecialchars($admin['name']) ?></td>
            <td><?= htmlspecialchars($admin['username']) ?></td>
            <td><?= htmlspecialchars($admin['role']) ?></td>
            <td>
                <a href="edit.php?id=<?= $admin['id'] ?>">تعديل الصلاحيات</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include '../../includes/footer.php'; ?>