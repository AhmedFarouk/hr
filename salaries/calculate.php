<?php
// محتوى تجريبي للملف: calculate.php
// هذا الملف ضمن: /mnt/data/hr_system_final/salaries
?>
<?php
require_once '../config/db.php';
include '../includes/auth.php';

$month = $_GET['month'] ?? date('Y-m');

$employees = $conn->query("SELECT id, base_salary FROM employees");

foreach ($employees as $emp) {
    $id = $emp['id'];
    $base = $emp['base_salary'];

    // المكافآت
    $rewards = $conn->query("SELECT SUM(amount) as total FROM rewards 
                WHERE employee_id=$id AND DATE_FORMAT(reward_date, '%Y-%m') = '$month'")
        ->fetch_assoc()['total'] ?? 0;

    // الخصومات
    $penalties = $conn->query("SELECT SUM(amount) as total FROM penalties 
                WHERE employee_id=$id AND DATE_FORMAT(penalty_date, '%Y-%m') = '$month'")
        ->fetch_assoc()['total'] ?? 0;

    $net = $base + $rewards - $penalties;

    $stmt = $conn->prepare("REPLACE INTO salaries (employee_id, base_salary, rewards, penalties, net_salary, salary_month)
                            VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("idddds", $id, $base, $rewards, $penalties, $net, $month);
    $stmt->execute();
}

header("Location: index.php?month=$month");
exit;
