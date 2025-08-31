<?php
// محتوى تجريبي للملف: add.php
// هذا الملف ضمن: /mnt/data/hr_system_final/tasks
?>
<?php
require_once '../config/db.php';
include '../includes/auth.php';
include '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employee_id = $_POST['employee_id'];
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $due_date = $_POST['due_date'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("INSERT INTO tasks (employee_id, title, description, due_date, status) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $employee_id, $title, $desc, $due_date, $status);
    $stmt->execute();
    header("Location: index.php");
    exit;
}

$employees = $conn->query("SELECT id, name FROM employees");
?>

<h2>إضافة مهمة</h2>
<form method="post">
    <div class="mb-3">
        <label>الموظف</label>
        <select name="employee_id" required class="form-control">
            <?php while ($emp = $employees->fetch_assoc()): ?>
                <option value="<?= $emp['id'] ?>"><?= htmlspecialchars($emp['name']) ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="mb-3">
        <label>عنوان المهمة</label>
        <input type="text" name="title" required class="form-control">
    </div>
    <div class="mb-3">
        <label>الوصف</label>
        <textarea name="description" class="form-control"></textarea>
    </div>
    <div class="mb-3">
        <label>تاريخ الاستحقاق</label>
        <input type="date" name="due_date" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>الحالة</label>
        <select name="status" class="form-control">
            <option value="قيد التنفيذ">قيد التنفيذ</option>
            <option value="منجزة">منجزة</option>
            <option value="مؤجلة">مؤجلة</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success">حفظ</button>
</form>

<?php include '../includes/footer.php'; ?>