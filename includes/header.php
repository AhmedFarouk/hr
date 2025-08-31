<?php
// محتوى تجريبي للملف: header.php
// هذا الملف ضمن: /mnt/data/hr_system_final/includes
?>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <title>نظام إدارة الموارد البشرية</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/dashboard/">HR System</a>
        <ul class="navbar-nav ml-auto">
            <?php if (isset($_SESSION['admin'])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/logout.php">تسجيل الخروج</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
    <div class="container mt-4">