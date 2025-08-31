<?php
// محتوى تجريبي للملف: index.php
// هذا الملف ضمن: /mnt/data/hr_system_final/attendance
?>
<?php
// attendance/index.php
// عرض قائمة الحضور حسب الموظف أو التاريخ أو الفرع

require_once '../includes/header.php';
require_once '../config/db.php';
require_once '../includes/auth.php';

if (!has_permission('attendance', 'view')) {
    die('Unauthorized access');
}

$attendances = $conn->query("
    SELECT a.*, e.name AS employee_name, b.name AS branch_name
    FROM attendance a
    JOIN employees e ON a.employee_id = e.id
    JOIN branches b ON e.branch_id = b.id
    ORDER BY a.date DESC
")->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>سجلات الحضور</h2>
<table>
    <thead>
        <tr>
            <th>الموظف</th>
            <th>الفرع</th>
            <th>التاريخ</th>
            <th>وقت الدخول</th>
            <th>وقت الخروج</th>
            <th>ملاحظات</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($attendances as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['employee_name']) ?></td>
                <td><?= htmlspecialchars($row['branch_name']) ?></td>
                <td><?= $row['date'] ?></td>
                <td><?= $row['check_in'] ?></td>
                <td><?= $row['check_out'] ?></td>
                <td><?= htmlspecialchars($row['notes']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once '../includes/footer.php'; ?>