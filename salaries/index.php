<?php
// محتوى تجريبي للملف: index.php
// هذا الملف ضمن: /mnt/data/hr_system_final/salaries
?>
<?php
require_once '../config/db.php';
include '../includes/auth.php';
include '../includes/header.php';

$month = $_GET['month'] ?? date('Y-m');

$result = $conn->query("
    SELECT s.*, e.name AS employee_name
    FROM salaries s
    JOIN employees e ON s.employee_id = e.id
    WHERE DATE_FORMAT(s.salary_month, '%Y-%m') = '$month'
    ORDER BY salary_month DESC
");
?>

<h2>رواتب شهر <?= htmlspecialchars($month) ?></h2>
<a href="calculate.php?month=<?= $month ?>" class="btn btn-primary">إعادة حساب الرواتب</a>
<a href="export_excel.php?month=<?= $month ?>" class="btn btn-success">تصدير Excel</a>
<a href="export_pdf.php?month=<?= $month ?>" class="btn btn-danger">تصدير PDF</a>

<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>الموظف</th>
            <th>الراتب الأساسي</th>
            <th>المكافآت</th>
            <th>الخصومات</th>
            <th>الراتب الصافي</th>
            <th>الشهر</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['employee_name']) ?></td>
                <td><?= number_format($row['base_salary'], 2) ?></td>
                <td><?= number_format($row['rewards'], 2) ?></td>
                <td><?= number_format($row['penalties'], 2) ?></td>
                <td><?= number_format($row['net_salary'], 2) ?></td>
                <td><?= $row['salary_month'] ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include '../includes/footer.php'; ?>