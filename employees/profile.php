<?php
// محتوى تجريبي للملف: profile.php
// هذا الملف ضمن: /mnt/data/hr_system_final/employees
?>
<?php
require_once '../config/db.php';
require_once '../includes/auth.php';

$id = $_GET['id'] ?? 0;
$stmt = $conn->prepare("SELECT * FROM employees WHERE id = ?");
$stmt->execute([$id]);
$emp = $stmt->fetch();

include '../includes/header.php';
?>

<div class="container">
    <h2>ملف الموظف</h2>
    <p><strong>الاسم:</strong> <?= $emp['name'] ?></p>
    <p><strong>رقم الهاتف:</strong> <?= $emp['phone'] ?></p>
    <p><strong>الوظيفة:</strong> <?= $emp['position'] ?></p>
    <p><strong>الفرع:</strong> <?= $emp['branch'] ?></p>
    <p><strong>تاريخ الإضافة:</strong> <?= $emp['created_at'] ?></p>
</div>

<?php include '../includes/footer.php'; ?>