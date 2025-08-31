<?php
// محتوى تجريبي للملف: index.php
// هذا الملف ضمن: /mnt/data/hr_system_final/dashboard
?>
<?php
// dashboard/index.php
// لوحة المدير العام - عرض نظرة عامة على النظام

require_once '../config/db.php';
require_once '../includes/auth.php';
include '../includes/header.php';

// جلب بعض الإحصائيات الأساسية من قاعدة البيانات
$totalEmployees = $conn->query("SELECT COUNT(*) FROM employees")->fetchColumn();
$totalBranches = $conn->query("SELECT COUNT(*) FROM branches")->fetchColumn();
$totalSalaries = $conn->query("SELECT SUM(net_salary) FROM salaries")->fetchColumn();
$pendingTasks = $conn->query("SELECT COUNT(*) FROM tasks WHERE status = 'pending'")->fetchColumn();
?>

<div class="container">
    <h1>لوحة المدير العام</h1>
    <div class="row">
        <div class="col-md-3">
            <div class="card bg-primary text-white mb-3">
                <div class="card-body">
                    <h5 class="card-title">إجمالي الموظفين</h5>
                    <p class="card-text"><?= $totalEmployees ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-success text-white mb-3">
                <div class="card-body">
                    <h5 class="card-title">عدد الفروع</h5>
                    <p class="card-text"><?= $totalBranches ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-warning text-white mb-3">
                <div class="card-body">
                    <h5 class="card-title">إجمالي الرواتب المدفوعة</h5>
                    <p class="card-text"><?= number_format($totalSalaries, 2) ?> جنيه</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-danger text-white mb-3">
                <div class="card-body">
                    <h5 class="card-title">مهام قيد الانتظار</h5>
                    <p class="card-text"><?= $pendingTasks ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>