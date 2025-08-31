<?php
// محتوى تجريبي للملف: add.php
// هذا الملف ضمن: /mnt/data/hr_system_final/penalties
?>
<?php
require_once '../config/db.php';
include '../includes/auth.php';
include '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employee_id = $_POST['employee_id'];
    $amount = $_POST['amount'];
    $reason = $_POST['reason'];
    $penalty_date = $_POST['penalty_date'];

    $stmt = $conn->prepare("INSERT INTO penalties (employee_id, amount, reason, penalty_date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("idss", $employee_id, $amount, $reason, $penalty_date);
    $stmt->execute();
    header("Location: index.php");
    exit;
}

$employees = $conn->query("SELECT id, name FROM employees");
?>

<h2>إضافة خصم جديد</h2>
<form method="post">
    <label>الموظف:</label>
    <select name="employee_id" required class="form-control">
        <?php while ($emp = $employees->fetch_assoc()): ?>
            <option value="<?= $emp['id'] ?>"><?= htmlspecialchars($emp['name']) ?></option>
        <?php endwhile; ?>
    </select>

    <label>المبلغ:</label>
    <input type="number" step="0.01" name="amount" required class="form-control">

    <label>السبب:</label>
    <input type="text" name="reason" required class="form-control">

    <label>التاريخ:</label>
    <input type="date" name="penalty_date" required class="form-control">

    <button type="submit" class="btn btn-primary mt-3">حفظ</button>
</form>

<?php include '../includes/footer.php'; ?>