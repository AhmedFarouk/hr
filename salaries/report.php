<?php
// محتوى تجريبي للملف: report.php
// هذا الملف ضمن: /mnt/data/hr_system_final/salaries/ report.php
?>
<?php
require_once '../config/db.php';
include '../includes/auth.php';
include '../includes/header.php';

$month = $_GET['month'] ?? date('Y-m');
$branch_id = $_GET['branch_id'] ?? '';
$employee_id = $_GET['employee_id'] ?? '';

// بناء شرط WHERE
$conditions = "WHERE DATE_FORMAT(s.salary_month, '%Y-%m') = '$month'";
if (!empty($branch_id)) {
    $conditions .= " AND e.branch_id = " . intval($branch_id);
}
if (!empty($employee_id)) {
    $conditions .= " AND s.employee_id = " . intval($employee_id);
}

// جلب البيانات
$query = "
    SELECT s.*, e.name AS employee_name, b.name AS branch_name
    FROM salaries s
    JOIN employees e ON s.employee_id = e.id
    JOIN branches b ON e.branch_id = b.id
    $conditions
    ORDER BY e.name
";
$result = $conn->query($query);

// جلب الفروع والموظفين للفلترة
$branches = $conn->query("SELECT * FROM branches");
$employees = $conn->query("SELECT id, name FROM employees");
?>

<h2>تقرير الرواتب لشهر <?= htmlspecialchars($month) ?></h2>

<form method="get" class="row g-3 mb-4">
    <div class="col-md-3">
        <label>الشهر</label>
        <input type="month" name="month" value="<?= htmlspecialchars($month) ?>" class="form-control">
    </div>
    <div class="col-md-3">
        <label>الفرع</label>
        <select name="branch_id" class="form-control">
            <option value="">الكل</option>
            <?php while ($b = $branches->fetch_assoc()): ?>
                <option value="<?= $b['id'] ?>" <?= $branch_id == $b['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($b['name']) ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="col-md-3">
        <label>الموظف</label>
        <select name="employee_id" class="form-control">
            <option value="">الكل</option>
            <?php while ($e = $employees->fetch_assoc()): ?>
                <option value="<?= $e['id'] ?>" <?= $employee_id == $e['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($e['name']) ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="col-md-3 d-flex align-items-end">
        <button type="submit" class="btn btn-primary">عرض التقرير</button>
    </div>
</form>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>الموظف</th>
            <th>الفرع</th>
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
                <td><?= htmlspecialchars($row['branch_name']) ?></td>
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