<?php
// محتوى تجريبي للملف: add.php
// هذا الملف ضمن: /mnt/data/hr_system_final/employees
?>
<?php
require_once '../config/db.php';
require_once '../includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $position = $_POST['position'];
    $branch = $_POST['branch'];

    $stmt = $conn->prepare("INSERT INTO employees (name, phone, position, branch, created_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->execute([$name, $phone, $position, $branch]);

    header("Location: index.php");
    exit;
}

include '../includes/header.php';
?>

<div class="container">
    <h2>إضافة موظف جديد</h2>
    <form method="POST">
        <div class="form-group">
            <label>الاسم</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>رقم الهاتف</label>
            <input type="text" name="phone" class="form-control">
        </div>
        <div class="form-group">
            <label>الوظيفة</label>
            <input type="text" name="position" class="form-control">
        </div>
        <div class="form-group">
            <label>الفرع</label>
            <input type="text" name="branch" class="form-control">
        </div>
        <br>
        <button type="submit" class="btn btn-success">حفظ</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>