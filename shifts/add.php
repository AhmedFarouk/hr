<?php
// محتوى تجريبي للملف: add.php
// هذا الملف ضمن: /mnt/data/hr_system_final/shifts
?>
<?php
require_once '../config/db.php';
include '../includes/auth.php';
include '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $branch_id = $_POST['branch_id'];
    $start = $_POST['start_time'];
    $end = $_POST['end_time'];
    $notes = $_POST['notes'];

    $stmt = $conn->prepare("INSERT INTO shifts (name, branch_id, start_time, end_time, notes) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sisss", $name, $branch_id, $start, $end, $notes);
    $stmt->execute();
    header("Location: index.php");
    exit;
}

$branches = $conn->query("SELECT * FROM branches");
?>

<h2>إضافة وردية</h2>
<form method="post">
    <div class="mb-3">
        <label>اسم الورديه</label>
        <input type="text" name="name" required class="form-control">
    </div>
    <div class="mb-3">
        <label>الفرع</label>
        <select name="branch_id" class="form-control" required>
            <?php while ($b = $branches->fetch_assoc()): ?>
                <option value="<?= $b['id'] ?>"><?= htmlspecialchars($b['name']) ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="mb-3">
        <label>وقت البداية</label>
        <input type="time" name="start_time" required class="form-control">
    </div>
    <div class="mb-3">
        <label>وقت النهاية</label>
        <input type="time" name="end_time" required class="form-control">
    </div>
    <div class="mb-3">
        <label>ملاحظات</label>
        <textarea name="notes" class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-success">حفظ</button>
</form>

<?php include '../includes/footer.php'; ?>