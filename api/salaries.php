<?php
// محتوى تجريبي للملف: salaries.php
// هذا الملف ضمن: /mnt/data/hr_system_final/api
?>
<?php
// api/salaries.php
// API لإرجاع بيانات المرتبات للفترة أو الموظف

require_once '../config/db.php';
require_once '../includes/auth.php';

if (!has_permission('salaries', 'view')) {
    http_response_code(403);
    echo json_encode(["error" => "Unauthorized"]);
    exit;
}

header('Content-Type: application/json');

$month = $_GET['month'] ?? date('Y-m');
$employee_id = $_GET['employee_id'] ?? null;

$sql = "SELECT * FROM salaries WHERE month = ?";
$params = [$month];

if ($employee_id) {
    $sql .= " AND employee_id = ?";
    $params[] = $employee_id;
}

$stmt = $conn->prepare($sql);
$stmt->execute($params);
$salaries = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($salaries);
?>