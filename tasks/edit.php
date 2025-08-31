<?php
// محتوى تجريبي للملف: edit.php
// هذا الملف ضمن: /mnt/data/hr_system_final/tasks
?>
<?php
require_once '../config/db.php';
include '../includes/auth.php';
include '../includes/header.php';

$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM tasks WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$task = $stmt->get_result()->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employee_id = $_POST['employee_id'];
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $due_date = $_POST['due_date'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE tasks SET employee_id=?, title=?, description=?, due_date=?, status=? WHERE id=?");
    $stmt->bind_param("issssi", $employee_id, $title, $desc, $due_date, $status, $id);
    $stmt->execute();
    header("Location: index.php");
    exit;
}

$employees = $conn->query("SELECT id, name FROM employees");
?>

<h2>تعديل المهمة</h2>
<form method="post">
    <div class="mb-3">
        <label>الموظف</label>
        <select name="employee_id" required class="form-control">
            <?php while ($emp = $employees->fetch_assoc()): ?>
                <option value="<?= $emp['id'] ?>" <?= $emp['id'] == $task['employee_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($emp['name']) ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="mb-3">
        <label>عنوان المهمة</label>
        <input type="text" name="title" value="<?= htmlspecialchars($task['title']) ?>" required class="form-control">
    </div>
    <div class="mb-3">
        <label>الوصف</label>
        <textarea name="description" class="form-control"><?= htmlspecialchars($task['description']) ?></textarea>
    </div>
    <div class="mb-3">
        <label>تاريخ الاستحقاق</label>
        <input type="date" name="due_date" value="<?= $task['due_date'] ?>" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>الحالة</label>
        <select name="status" class="form-control">
            <option value="قيد التنفيذ" <?= $task['status'] == 'قيد التنفيذ' ? 'selected' : '' ?>>قيد التنفيذ</option>
            <option value="منجزة" <?= $task['status'] == 'منجزة' ? 'selected' : '' ?>>منجزة</option>
            <option value="مؤجلة" <?= $task['status'] == 'مؤجلة' ? 'selected' : '' ?>>مؤجلة</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">تحديث</button>
</form>

<?php include '../includes/footer.php'; ?>