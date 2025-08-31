<?php
// محتوى تجريبي للملف: settings.php
// هذا الملف ضمن: /mnt/data/hr_system_final/notifications
?>
<?php
require_once '../config/db.php';
include '../includes/auth.php';
include '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enable_email = isset($_POST['enable_email']) ? 1 : 0;
    $enable_sms = isset($_POST['enable_sms']) ? 1 : 0;
    $stmt = $conn->prepare("UPDATE notification_settings SET enable_email=?, enable_sms=? WHERE id=1");
    $stmt->bind_param("ii", $enable_email, $enable_sms);
    $stmt->execute();
    $msg = "تم تحديث الإعدادات بنجاح";
}

// جلب الإعدادات الحالية
$settings = $conn->query("SELECT * FROM notification_settings WHERE id=1")->fetch_assoc();
?>

<h2>إعدادات التنبيهات</h2>
<?php if (isset($msg)) echo "<div class='alert alert-success'>$msg</div>"; ?>
<form method="post">
    <label>
        <input type="checkbox" name="enable_email" <?= $settings['enable_email'] ? 'checked' : '' ?>>
        تفعيل التنبيه عبر البريد الإلكتروني
    </label><br>
    <label>
        <input type="checkbox" name="enable_sms" <?= $settings['enable_sms'] ? 'checked' : '' ?>>
        تفعيل التنبيه عبر الرسائل النصية
    </label><br>
    <button type="submit" class="btn btn-primary">حفظ الإعدادات</button>
</form>

<?php include '../includes/footer.php'; ?>