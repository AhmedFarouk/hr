<?php
// محتوى تجريبي للملف: index.php
// هذا الملف ضمن: /mnt/data/hr_system_final/tasks
?>
<?php
require_once '../config/db.php';
include '../includes/auth.php';
include '../includes/header.php';

$query = "SELECT tasks.*, employees.name AS employee_name
          FROM tasks
          LEFT JOIN employees ON tasks.employee_id = employees.id
          ORDER BY tasks.due_date DESC";
$result = $conn->query($query);
?>

<h2>إدارة المهام</h2>
<a href="add.php" class="btn btn-success mb-3">إضافة مهمة</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>الموظف</th>
            <th>عنوان المهمة</th>
            <th>الوصف</th>
            <th>تاريخ الاستحقاق</th>
            <th>الحالة</th>
            <th>إجراءات</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['employee_name']) ?></td>
                <td><?= htmlspecialchars($row['title']) ?></td>
                <td><?= htmlspecialchars($row['description']) ?></td>
                <td><?= $row['due_date'] ?></td>
                <td><?= $row['status'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">تعديل</a>
                    <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include '../includes/footer.php'; ?>