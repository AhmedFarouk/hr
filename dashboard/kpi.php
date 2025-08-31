<?php
// محتوى تجريبي للملف: kpi.php
// هذا الملف ضمن: /mnt/data/hr_system_final/dashboard
?>
<?php
// dashboard/kpi.php
// عرض مؤشرات الأداء الرئيسية وتحليلات رسومية

require_once '../config/db.php';
require_once '../includes/auth.php';
include '../includes/header.php';

// بيانات رسومية مبسطة لأداء الفروع
$data = $conn->query("
    SELECT b.name AS branch_name, COUNT(e.id) AS employee_count
    FROM branches b
    LEFT JOIN employees e ON b.id = e.branch_id
    GROUP BY b.id
")->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <h2>مؤشرات الأداء الرئيسية (KPIs)</h2>
    <canvas id="branchChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('branchChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_column($data, 'branch_name')) ?>,
            datasets: [{
                label: 'عدد الموظفين',
                data: <?= json_encode(array_column($data, 'employee_count')) ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.6)'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<?php include '../includes/footer.php'; ?>