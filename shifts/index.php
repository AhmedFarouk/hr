<?php
// محتوى تجريبي للملف: index.php
// هذا الملف ضمن: /mnt/data/hr_system_final/shifts
?>
<?php
require_once '../config/db.php';
include '../includes/auth.php';
include '../includes/header.php';

$query = "SELECT shifts.*, branches.name AS branch_name 
          FROM shifts 
          LEFT JOIN branches ON shifts.branch_id = branches.id 
          ORDER BY shifts.start_time";
$result = $conn->query($query);
?>

<h2>إدارة الورديات</h2>
<a href="add.php" class="btn btn-success mb-3">إضافة وردية جديدة</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>الاسم</th>
            <th>الفرع</th>
            <th>من</th>
            <th>إلى</th>
            <th>ملاحظات</th>
            <th>إجراءات</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['branch_name']) ?></td>
                <td><?= $row['start_time'] ?></td>
                <td><?= $row['end_time'] ?></td>
                <td><?= htmlspecialchars($row['notes']) ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">تعديل</a>
                    <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include '../includes/footer.php'; ?>