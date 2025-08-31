<?php
// محتوى تجريبي للملف: index.php
// هذا الملف ضمن: /mnt/data/hr_system_final/notifications
?>
<?php
require_once '../config/db.php';
include '../includes/auth.php';
include '../includes/header.php';

// جلب التنبيهات من قاعدة البيانات
$query = "SELECT * FROM notifications ORDER BY created_at DESC";
$result = $conn->query($query);
?>

<h2>مركز التنبيهات</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th>العنوان</th>
            <th>المحتوى</th>
            <th>الحالة</th>
            <th>تاريخ الإنشاء</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['title']) ?></td>
                <td><?= htmlspecialchars($row['message']) ?></td>
                <td><?= $row['is_read'] ? 'تمت قراءته' : 'جديد' ?></td>
                <td><?= $row['created_at'] ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include '../includes/footer.php'; ?>