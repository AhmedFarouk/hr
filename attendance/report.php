<?php
// محتوى تجريبي للملف: report.php
// هذا الملف ضمن: /mnt/data/hr_system_final/attendance
?>
<?php
// attendance/report.php
// تقرير الحضور حسب الموظف والفترة الزمنية

require_once '../includes/header.php';
require_once '../config/db.php';
require_once '../includes/auth.php';

if (!has_permission('attendance', 'report')) {
    die('Unauthorized access');
}

$employee_id = $_GET['employee_id'] ?? null;
$from = $_GET['from'] ?? null;
$to = $_GET['to'] ?? null;

$sql = "SELECT a.*, e.name FROM attendance a JOIN employees e ON a.employee_id = e.id WHERE 1=1";
$params = [];

if ($employee_id) {
    $sql .= " AND employee_id = ?";
    $params[] = $employee_id;
}

if ($from) {
    $sql .= " AND date >= ?";
    $params[] = $from;
}
if ($to) {
    $sql .= " AND date <= ?";
    $params[] = $to;
}

$stmt = $conn->prepare($sql);
$stmt->execute($params);
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>تقرير الحضور</h2>

<form method="get">
    <label>الموظف:</label>
    <select name="employee_id">
        <option value="">الكل</option>
        <?php
        $emps = $conn->query("SELECT id, name FROM employees")->fetchAll();
        foreach ($emps as $emp) {
            $selected = $employee_id == $emp['id'] ? 'selected' : '';
            echo "<option value='{$emp['id']}' $selected>{$emp['name']}</option>";
        }
        ?>
    </select>
    <label>من:</label>
    <input type="date" name="from" value="<?= $from ?>">
    <label>إلى:</label>
    <input type="date" name="to" value="<?= $to ?>">
    <button type="submit">عرض</button>
</form>

<table>
    <thead>
        <tr>
            <th>الموظف</th>
            <th>التاريخ</th>
            <th>الدخول</th>
            <th>الخروج</th>
            <th>ملاحظات</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($records as $r): ?>
            <tr>
                <td><?= $r['name'] ?></td>
                <td><?= $r['date'] ?></td>
                <td><?= $r['check_in'] ?></td>
                <td><?= $r['check_out'] ?></td>
                <td><?= htmlspecialchars($r['notes']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once '../includes/footer.php'; ?>