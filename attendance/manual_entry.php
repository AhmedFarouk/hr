<?php
// محتوى تجريبي للملف: manual_entry.php
// هذا الملف ضمن: /mnt/data/hr_system_final/attendance
?>
<?php
// attendance/manual_entry.php
// إدخال سجل حضور يدويًا من قبل المشرف

require_once '../includes/header.php';
require_once '../config/db.php';
require_once '../includes/auth.php';

if (!has_permission('attendance', 'add')) {
    die('Unauthorized access');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employee_id = $_POST['employee_id'];
    $date = $_POST['date'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];
    $notes = $_POST['notes'];

    $stmt = $conn->prepare("INSERT INTO attendance (employee_id, date, check_in, check_out, notes) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$employee_id, $date, $check_in, $check_out, $notes]);

    echo "<p>تم تسجيل الحضور.</p>";
}
?>

<form method="post">
    <label>الموظف:</label>
    <select name="employee_id">
        <?php
        $emps = $conn->query("SELECT id, name FROM employees")->fetchAll();
        foreach ($emps as $emp) {
            echo "<option value='{$emp['id']}'>{$emp['name']}</option>";
        }
        ?>
    </select>
    <label>التاريخ:</label>
    <input type="date" name="date" required>
    <label>الدخول:</label>
    <input type="time" name="check_in">
    <label>الخروج:</label>
    <input type="time" name="check_out">
    <label>ملاحظات:</label>
    <textarea name="notes"></textarea>
    <button type="submit">حفظ</button>
</form>

<?php require_once '../includes/footer.php'; ?>