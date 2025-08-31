<?php
// محتوى تجريبي للملف: edit.php
// هذا الملف ضمن: /mnt/data/hr_system_final/leaves
?>
<?php
require_once '../config/db.php';
include '../includes/auth.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM leaves WHERE id = $id");
$leave = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $leave_type = $_POST['leave_type'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $reason = $_POST['reason'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE leaves SET leave_type=?, start_date=?, end_date=?, reason=?, status=? WHERE id=?");
    $stmt->bind_param("sssssi", $leave_type, $start_date, $end_date, $reason, $status, $id);
    $stmt->execute();
    header("Location: index.php");
    exit;
}
?>

<h2>تعديل الإجازة</h2>
<form method="post">
    <label>نوع الإجازة:</label>
    <input type="text" name="leave_type" value="<?= $leave['leave_type'] ?>" required>
    <label>من:</label>
    <input type="date" name="start_date" value="<?= $leave['start_date'] ?>" required>
    <label>إلى:</label>
    <input type="date" name="end_date" value="<?= $leave['end_date'] ?>" required>
    <label>السبب:</label>
    <textarea name="reason"><?= $leave['reason'] ?></textarea>
    <label>الحالة:</label>
    <select name="status">
        <option value="pending" <?= $leave['status'] == 'pending' ? 'selected' : '' ?>>قيد الانتظار</option>
        <option value="approved" <?= $leave['status'] == 'approved' ? 'selected' : '' ?>>مقبولة</option>
        <option value="rejected" <?= $leave['status'] == 'rejected' ? 'selected' : '' ?>>مرفوضة</option>
    </select>
    <button type="submit" class="btn btn-primary">تحديث</button>
</form>