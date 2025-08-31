<?php
// محتوى تجريبي للملف: add.php
// هذا الملف ضمن: /mnt/data/hr_system_final/branches
?>
<?php
// branches/add.php
require_once '../includes/header.php';
require_once '../config/db.php';
require_once '../includes/auth.php';

if (!has_permission('branches', 'add')) {
    die('غير مصرح بالدخول');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    $stmt = $conn->prepare("INSERT INTO branches (name, address, phone) VALUES (?, ?, ?)");
    $stmt->execute([$name, $address, $phone]);

    header("Location: index.php");
    exit;
}
?>

<h2>إضافة فرع جديد</h2>
<form method="post">
    <label>اسم الفرع:</label>
    <input type="text" name="name" required>
    <label>العنوان:</label>
    <input type="text" name="address" required>
    <label>الهاتف:</label>
    <input type="text" name="phone" required>
    <button type="submit">إضافة</button>
</form>

<?php require_once '../includes/footer.php'; ?>