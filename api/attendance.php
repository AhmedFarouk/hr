<?php
// محتوى تجريبي للملف: attendance.php
// هذا الملف ضمن: /mnt/data/hr_system_final/api
?>
<?php
// api/attendance.php
// API لإرجاع بيانات الحضور بناءً على الموظف أو التاريخ

require_once '../config/db.php';
require_once '../includes/auth.php';

if (!has_permission('attendance', 'view')) {
    http_response_code(403);
    echo json_encode(["error" => "Unauthorized"]);
    exit;
}

header('Content-Type: application/json');

$employee_id = $_GET['employee_id'] ?? null;
$date = $_GET['date'] ?? null;

$sql = "SELECT * FROM attendance WHERE 1";
$params = [];

if ($employee_id) {
    $sql .= " AND employee_id = ?";
    $params[] = $employee_id;
}

if ($date) {
    $sql .= " AND date = ?";
    $params[] = $date;
}

$stmt = $conn->prepare($sql);
$stmt->execute($params);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($data);
