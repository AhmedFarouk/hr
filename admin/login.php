<?php
// محتوى تجريبي للملف: login.php
// هذا الملف ضمن: /mnt/data/hr_system_final/admin
?>
<?php
// admin/login.php
// معالجة تسجيل الدخول للمشرف

session_start();
require_once '../config/db.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if (!$username || !$password) {
    header("Location: ../index.php?error=الرجاء إدخال اسم المستخدم وكلمة المرور");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM admins WHERE username = ?");
$stmt->execute([$username]);
$admin = $stmt->fetch(PDO::FETCH_ASSOC);

if ($admin && password_verify($password, $admin['password'])) {
    $_SESSION['admin_id'] = $admin['id'];
    $_SESSION['admin_name'] = $admin['name'];
    header("Location: index.php");
} else {
    header("Location: ../index.php?error=بيانات الدخول غير صحيحة");
}
exit;
