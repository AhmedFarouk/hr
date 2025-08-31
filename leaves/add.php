<?php
// محتوى تجريبي للملف: add.php
// هذا الملف ضمن: /mnt/data/hr_system_final/leaves
?>
<?php
require_once '../config/db.php';
include '../includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $employee_id = $_POST['employee_id'];
    $leave_type = $_POST['leave_type'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $reason = $_POST['reason'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("INSERT INTO leaves (employee_id, leave_type, start_date, end_date, reason, status) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $employee_id, $leave_type, $start_date, $end_date, $reason, $status);
    $stmt->execute();
    header("Location: index.php");
    exit;
}

// جلب الموظفين للاختيار
$employees = $conn->query("SELECT id, name FROM employees");
?>

<h2>إضافة إجازة</h2>
<form method="post">
    <label>الموظف:</label>
    <select name="employee_id" required>
        <?php while ($e = $employees->fetch_assoc()): ?>
            <option value="<?= $e['id'] ?>"><?= $e['name'] ?></option>
        <?php endwhile; ?>
    </select>
    <label>نوع الإجازة:</label>
    <input type="text" name="leave_type" required>
    <label>من:</label>
    <input type="date" name="start_date" required>
    <label>إلى:</label>
    <input type="date" name="end_date" required>
    <label>السبب:</label>
    <textarea name="reason"></textarea>
    <label>الحالة:</label>
    <select name="status">
        <option value="pending">قيد الانتظار</option>
        <option value="approved">مقبولة</option>
        <option value="rejected">مرفوضة</option>
    </select>
    <button type="submit" class="btn btn-success">حفظ</button>
</form>