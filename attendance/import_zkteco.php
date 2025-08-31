<?php
// محتوى تجريبي للملف: import_zkteco.php
// هذا الملف ضمن: /mnt/data/hr_system_final/attendance
?>
<?php
// attendance/import_zkteco.php
// استيراد الحضور من جهاز ZKTeco (ملف Excel أو CSV)

require_once '../includes/header.php';
require_once '../config/db.php';
require_once '../includes/auth.php';

if (!has_permission('attendance', 'import')) {
    die('Unauthorized access');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file']['tmp_name'];
    $handle = fopen($file, 'r');

    while (($row = fgetcsv($handle)) !== false) {
        list($employee_code, $date, $check_in, $check_out) = $row;

        $stmt = $conn->prepare("
            INSERT INTO attendance (employee_id, date, check_in, check_out)
            SELECT id, ?, ?, ? FROM employees WHERE code = ?
        ");
        $stmt->execute([$date, $check_in, $check_out, $employee_code]);
    }

    fclose($handle);
    echo "<p>تم استيراد البيانات بنجاح.</p>";
}
?>

<form method="post" enctype="multipart/form-data">
    <label>ملف الحضور:</label>
    <input type="file" name="file" required>
    <button type="submit">استيراد</button>
</form>

<?php require_once '../includes/footer.php'; ?>