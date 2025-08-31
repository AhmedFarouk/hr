<?php
// محتوى تجريبي للملف: index.php
// هذا الملف ضمن: /mnt/data/hr_system_final/leaves
?>
<?php
require_once '../config/db.php';
include '../includes/auth.php';
include '../includes/header.php';

// استعلام لجلب الإجازات مع بيانات الموظف
$sql = "SELECT leaves.*, employees.name AS employee_name 
        FROM leaves 
        JOIN employees ON leaves.employee_id = employees.id 
        ORDER BY leaves.start_date DESC";
$result = $conn->query($sql);
?>

<h2>قائمة الإجازات</h2>
<a href="add.php" class="btn btn-primary">إضافة إجازة جديدة</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>الموظف</th>
            <th>نوع الإجازة</th>
            <th>من</th>
            <th>إلى</th>
            <th>الحالة</th>
            <th>خيارات</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['employee_name'] ?></td>
                <td><?= $row['leave_type'] ?></td>
                <td><?= $row['start_date'] ?></td>
                <td><?= $row['end_date'] ?></td>
                <td><?= $row['status'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">تعديل</a>
                    <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('هل أنت متأكد؟');" class="btn btn-sm btn-danger">حذف</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include '../includes/footer.php'; ?>