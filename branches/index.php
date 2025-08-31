<?php
// محتوى تجريبي للملف: index.php
// هذا الملف ضمن: /mnt/data/hr_system_final/branches
?>
<?php
// branches/index.php
require_once '../includes/header.php';
require_once '../config/db.php';
require_once '../includes/auth.php';

if (!has_permission('branches', 'view')) {
    die('غير مصرح بالدخول');
}

$stmt = $conn->query("SELECT * FROM branches ORDER BY id DESC");
$branches = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>قائمة الفروع</h2>
<a href="add.php">➕ إضافة فرع جديد</a>
<table>
    <thead>
        <tr>
            <th>اسم الفرع</th>
            <th>العنوان</th>
            <th>الهاتف</th>
            <th>خيارات</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($branches as $b): ?>
            <tr>
                <td><?= htmlspecialchars($b['name']) ?></td>
                <td><?= htmlspecialchars($b['address']) ?></td>
                <td><?= htmlspecialchars($b['phone']) ?></td>
                <td>
                    <a href="edit.php?id=<?= $b['id'] ?>">✏️ تعديل</a> |
                    <a href="delete.php?id=<?= $b['id'] ?>" onclick="return confirm('هل أنت متأكد من الحذف؟')">🗑️ حذف</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once '../includes/footer.php'; ?>