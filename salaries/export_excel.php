<?php
// محتوى تجريبي للملف: export_excel.php
// هذا الملف ضمن: /mnt/data/hr_system_final/salaries
?>
<?php
require_once '../config/db.php';

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=salaries.xls");

$month = $_GET['month'] ?? date('Y-m');

$result = $conn->query("
    SELECT s.*, e.name AS employee_name
    FROM salaries s
    JOIN employees e ON s.employee_id = e.id
    WHERE DATE_FORMAT(s.salary_month, '%Y-%m') = '$month'
");

echo "الموظف\tالراتب الأساسي\tالمكافآت\tالخصومات\tالراتب الصافي\tالشهر\n";

while ($row = $result->fetch_assoc()) {
    echo "{$row['employee_name']}\t{$row['base_salary']}\t{$row['rewards']}\t{$row['penalties']}\t{$row['net_salary']}\t{$row['salary_month']}\n";
}
