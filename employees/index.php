<?php
// محتوى تجريبي للملف: index.php
// هذا الملف ضمن: /mnt/data/hr_system_final/employees
?>
<?php
require_once '../config/db.php';
require_once '../includes/auth.php';
include '../includes/header.php';

$stmt = $conn->query("SELECT * FROM employees ORDER BY id DESC");
$employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <h2>قائمة الموظفين</h2>
    <a href="add.php" class="btn btn-primary mb-3">إضافة موظف</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>الاسم</th>
                <th>رقم الهاتف</th>
                <th>الوظيفة</th>
                <th>الفرع</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employees as $emp): ?>
                <tr>
                    <td><?= htmlspecialchars($emp['name']) ?></td>
                    <td><?= $emp['phone'] ?></td>
                    <td><?= $emp['position'] ?></td>
                    <td><?= $emp['branch'] ?></td>
                    <td>
                        <a href="profile.php?id=<?= $emp['id'] ?>" class="btn btn-info btn-sm">عرض</a>
                        <a href="edit.php?id=<?= $emp['id'] ?>" class="btn btn-warning btn-sm">تعديل</a>
                        <a href="delete.php?id=<?= $emp['id'] ?>" onclick="return confirm('هل أنت متأكد؟')" class="btn btn-danger btn-sm">حذف</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer.php'; ?>