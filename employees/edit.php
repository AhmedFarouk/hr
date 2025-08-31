<?php
// محتوى تجريبي للملف: edit.php
// هذا الملف ضمن: /mnt/data/hr_system_final/employees
?>
<?php
require_once '../config/db.php';
require_once '../includes/auth.php';

$id = $_GET['id'] ?? 0;

$stmt = $conn->prepare("SELECT * FROM employees WHERE id = ?");
$stmt->execute([$id]);
$emp = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $position = $_POST['position'];
    $branch = $_POST['branch'];

    $stmt = $conn->prepare("UPDATE employees SET name = ?, phone = ?, position = ?, branch = ? WHERE id = ?");
    $stmt->execute([$name, $phone, $position, $branch, $id]);

    header("Location: index.php");
    exit;
}

include '../includes/header.php';
?>

<div class="container">
    <h2>تعديل بيانات الموظف</h2>
    <form method="POST">
        <div class="form-group">
            <label>الاسم</label>
            <input type="text" name="name" class="form-control" value="<?= $emp['name'] ?>" required>
        </div>
        <div class="form-group">
            <label>رقم الهاتف</label>
            <input type="text" name="phone" class="form-control" value="<?= $emp['phone'] ?>">
        </div>
        <div class="form-group">
            <label>الوظيفة</label>
            <input type="text" name="position" class="form-control" value="<?= $emp['position'] ?>">
        </div>
        <div class="form-group">
            <label>الفرع</label>
            <input type="text" name="branch" class="form-control" value="<?= $emp['branch'] ?>">
        </div>
        <br>
        <button type="submit" class="btn btn-primary">تحديث</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>