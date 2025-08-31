<?php
// محتوى تجريبي للملف: edit.php
// هذا الملف ضمن: /mnt/data/hr_system_final/rewards
?>
<?php
require_once '../config/db.php';
include '../includes/auth.php';
include '../includes/header.php';

$id = $_GET['id'];
$reward = $conn->query("SELECT * FROM rewards WHERE id = $id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employee_id = $_POST['employee_id'];
    $amount = $_POST['amount'];
    $description = $_POST['description'];
    $reward_date = $_POST['reward_date'];

    $stmt = $conn->prepare("UPDATE rewards SET employee_id=?, amount=?, description=?, reward_date=? WHERE id=?");
    $stmt->bind_param("idssi", $employee_id, $amount, $description, $reward_date, $id);
    $stmt->execute();
    header("Location: index.php");
    exit;
}

$employees = $conn->query("SELECT id, name FROM employees");
?>

<h2>تعديل مكافأة</h2>
<form method="post">
    <label>الموظف:</label>
    <select name="employee_id" required class="form-control">
        <?php while ($emp = $employees->fetch_assoc()): ?>
            <option value="<?= $emp['id'] ?>" <?= $emp['id'] == $reward['employee_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($emp['name']) ?>
            </option>
        <?php endwhile; ?>
    </select>

    <label>المبلغ:</label>
    <input type="number" step="0.01" name="amount" value="<?= $reward['amount'] ?>" required class="form-control">

    <label>الوصف:</label>
    <input type="text" name="description" value="<?= htmlspecialchars($reward['description']) ?>" required class="form-control">

    <label>تاريخ المكافأة:</label>
    <input type="date" name="reward_date" value="<?= $reward['reward_date'] ?>" required class="form-control">

    <button type="submit" class="btn btn-primary mt-3">تحديث</button>
</form>

<?php include '../includes/footer.php'; ?>