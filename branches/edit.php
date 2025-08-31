<?php
// محتوى تجريبي للملف: edit.php
// هذا الملف ضمن: /mnt/data/hr_system_final/branches
?>
<?php
// branches/edit.php
require_once '../includes/header.php';
require_once '../config/db.php';
require_once '../includes/auth.php';

if (!has_permission('branches', 'edit')) {
    die('غير مصرح بالدخول');
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM branches WHERE id = ?");
$stmt->execute([$id]);
$branch = $stmt->fetch();

if (!$branch) {
    die("الفرع غير موجود.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    $stmt = $conn->prepare("UPDATE branches SET name = ?, address = ?, phone = ? WHERE id = ?");
    $stmt->execute([$name, $address, $phone, $id]);

    header("Location: index.php");
    exit;
}
?>

<h2>تعديل الفرع</h2>
<form method="post">
    <label>اسم الفرع:</label>
    <input type="text" name="name" value="<?= htmlspecialchars($branch['name']) ?>" required>
    <label>العنوان:</label>
    <input type="text" name="address" value="<?= htmlspecialchars($branch['address']) ?>" required>
    <label>الهاتف:</label>
    <input type="text" name="phone" value="<?= htmlspecialchars($branch['phone']) ?>" required>
    <button type="submit">حفظ التعديل</button>
</form>

<?php require_once '../includes/footer.php'; ?>