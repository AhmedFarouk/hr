<?php
// محتوى تجريبي للملف: edit.php
// هذا الملف ضمن: /mnt/data/hr_system_final/shifts
?>
<?php
require_once '../config/db.php';
include '../includes/auth.php';
include '../includes/header.php';

$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM shifts WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$shift = $stmt->get_result()->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $branch_id = $_POST['branch_id'];
    $start = $_POST['start_time'];
    $end = $_POST['end_time'];
    $notes = $_POST['notes'];

    $stmt = $conn->prepare("UPDATE shifts SET name=?, branch_id=?, start_time=?, end_time=?, notes=? WHERE id=?");
    $stmt->bind_param("sisssi", $name, $branch_id, $start, $end, $notes, $id);
    $stmt->execute();
    header("Location: index.php");
    exit;
}

$branches = $conn->query("SELECT * FROM branches");
?>

<h2>تعديل الوردية</h2>
<form method="post">
    <div class="mb-3">
        <label>اسم الورديه</label>
        <input type="text" name="name" value="<?= htmlspecialchars($shift['name']) ?>" required class="form-control">
    </div>
    <div class="mb-3">
        <label>الفرع</label>
        <select name="branch_id" class="form-control">
            <?php while ($b = $branches->fetch_assoc()): ?>
                <option value="<?= $b['id'] ?>" <?= $b['id'] == $shift['branch_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($b['name']) ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="mb-3">
        <label>وقت البداية</label>
        <input type="time" name="start_time" value="<?= $shift['start_time'] ?>" required class="form-control">
    </div>
    <div class="mb-3">
        <label>وقت النهاية</label>
        <input type="time" name="end_time" value="<?= $shift['end_time'] ?>" required class="form-control">
    </div>
    <div class="mb-3">
        <label>ملاحظات</label>
        <textarea name="notes" class="form-control"><?= htmlspecialchars($shift['notes']) ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">تحديث</button>
</form>

<?php include '../includes/footer.php'; ?>