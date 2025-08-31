<?php
// محتوى تجريبي للملف: index.php
// هذا الملف ضمن: /mnt/data/hr_system_final/rewards
?>
<?php
require_once '../config/db.php';
include '../includes/auth.php';
include '../includes/header.php';

$result = $conn->query("SELECT r.*, e.name AS employee_name 
                        FROM rewards r 
                        JOIN employees e ON r.employee_id = e.id 
                        ORDER BY reward_date DESC");
?>

<h2>قائمة المكافآت</h2>
<a href="add.php" class="btn btn-success">+ إضافة مكافأة</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>الموظف</th>
            <th>المبلغ</th>
            <th>الوصف</th>
            <th>التاريخ</th>
            <th>إجراءات</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['employee_name']) ?></td>
                <td><?= number_format($row['amount'], 2) ?></td>
                <td><?= htmlspecialchars($row['description']) ?></td>
                <td><?= $row['reward_date'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">تعديل</a>
                    <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد؟')">حذف</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include '../includes/footer.php'; ?>