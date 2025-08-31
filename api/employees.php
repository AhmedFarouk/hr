<?php
// محتوى تجريبي للملف: employees.php
// هذا الملف ضمن: /mnt/data/hr_system_final/api
?>
<?php
// api/employees.php
// API لإرجاع بيانات الموظفين بصيغة JSON

require_once '../config/db.php';
require_once '../includes/auth.php';

if (!has_permission('employees', 'view')) {
    http_response_code(403);
    echo json_encode(["error" => "Unauthorized"]);
    exit;
}

header('Content-Type: application/json');

$query = $conn->query("SELECT id, name, phone, job_title, branch_id FROM employees");
$employees = $query->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($employees);
