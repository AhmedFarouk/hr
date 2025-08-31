<?php
// محتوى تجريبي للملف: index.php
// هذا الملف ضمن: /mnt/data/hr_system_final/index.php

?>
<?php
// ملف: /hr_system/index.php
// الوظيفة: نقطة الدخول للنظام – تسجيل الدخول وتوجيه المشرفين حسب الصلاحيات
session_start();

// إذا كان المستخدم مسجل الدخول كمشرف، يتم توجيهه للوحة التحكم
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: admin/index.php");
    exit;
}

require_once 'config/constants.php';
?>

<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <title>نظام إدارة الموارد البشرية</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 bg-white p-4 shadow rounded">
                <h3 class="text-center mb-4">تسجيل دخول المشرف</h3>

                <?php if (isset($_SESSION['login_error'])): ?>
                    <div class="alert alert-danger text-center">
                        <?= $_SESSION['login_error'];
                        unset($_SESSION['login_error']); ?>
                    </div>
                <?php endif; ?>

                <form action="admin/login.php" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">اسم المستخدم</label>
                        <input type="text" class="form-control" name="username" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">كلمة المرور</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">دخول</button>
                </form>
            </div>
        </div>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>