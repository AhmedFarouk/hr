<?php
// محتوى تجريبي للملف: add.php
// هذا الملف ضمن: /mnt/data/hr_system_final/rewards
?>
<?php
require_once '../config/db.php';
include '../includes/auth.php';
include '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employee_id = $_POST['employee_id'];
    $amount = $_POST['amount'];
    $description = $_POST['description'];
    $reward_date = $_POST['reward_date'];

    $stmt = $conn->prepare("INSERT INTO rewards (employee_id, amount, description, reward_date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("idss", $employee_id, $amount, $description, $reward_date);
    $stmt->execute();
    header("Location: index.php");
    exit;
}

$employees = $conn->query("SELECT id, name FROM employees");
?>

<h2>إضافة مكافأة</h2>
<form method="post">
    <label>الموظف:</label>
    <select name="employee_id" required class="form-control">
        <?php while ($emp = $employees->fetch_assoc()): ?>
            <option value="<?= $emp['id'] ?>"><?= htmlspecialchars($emp['name']) ?></option>
        <?php endwhile; ?>
    </select>

    <label>المبلغ:</label>
    <input type="number" step="0.01" name="amount" required class="form-control">

    <label>الوصف:</label>
    <input type="text" name="description" required class="form-control">

    <label>تاريخ المكافأة:</label>
    <input type="date" name="reward_date" required class="form-control">

    <button type="submit" class="btn btn-primary mt-3">حفظ</button>
</form>

<?php include '../includes/footer.php'; ?>