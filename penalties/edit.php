<?php
// محتوى تجريبي للملف: edit.php
// هذا الملف ضمن: /mnt/data/hr_system_final/penalties
?>
<?php
require_once '../config/db.php';
include '../includes/auth.php';
include '../includes/header.php';

$id = $_GET['id'];
$penalty = $conn->query("SELECT * FROM penalties WHERE id = $id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employee_id = $_POST['employee_id'];
    $amount = $_POST['amount'];
    $reason = $_POST['reason'];
    $penalty_date = $_POST['penalty_date'];

    $stmt = $conn->prepare("UPDATE penalties SET employee_id=?, amount=?, reason=?, penalty_date=? WHERE id=?");
    $stmt->bind_param("idssi", $employee_id, $amount, $reason, $penalty_date, $id);
    $stmt->execute();
    header("Location: index.php");
    exit;
}

$employees = $conn->query("SELECT id, name FROM employees");
?>

<h2>تعديل خصم</h2>
<form method="post">
    <label>الموظف:</label>
    <select name="employee_id" required class="form-control">
        <?php while ($emp = $employees->fetch_assoc()): ?>
            <option value="<?= $emp['id'] ?>" <?= $emp['id'] == $penalty['employee_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($emp['name']) ?>
            </option>
        <?php endwhile; ?>
    </select>

    <label>المبلغ:</label>
    <input type="number" step="0.01" name="amount" value="<?= $penalty['amount'] ?>" required class="form-control">

    <label>السبب:</label>
    <input type="text" name="reason" value="<?= htmlspecialchars($penalty['reason']) ?>" required class="form-control">

    <label>التاريخ:</label>
    <input type="date" name="penalty_date" value="<?= $penalty['penalty_date'] ?>" required class="form-control">

    <button type="submit" class="btn btn-primary mt-3">تحديث</button>
</form>

<?php include '../includes/footer.php'; ?>