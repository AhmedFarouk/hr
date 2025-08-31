<?php
// محتوى تجريبي للملف: index.php
// هذا الملف ضمن: /mnt/data/hr_system_final/documents
?>
<?php
// documents/index.php
require_once '../config/db.php';
require_once '../includes/auth.php';
include '../includes/header.php';

$employee_id = $_GET['employee_id'] ?? 0;

$stmt = $conn->prepare("SELECT * FROM documents WHERE employee_id = ?");
$stmt->execute([$employee_id]);
$documents = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <h2>مستندات الموظف</h2>
    <a href="upload.php?employee_id=<?= $employee_id ?>" class="btn btn-primary mb-3">رفع مستند جديد</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>الاسم</th>
                <th>التاريخ</th>
                <th>الملف</th>
                <th>الإجراء</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($documents as $doc): ?>
                <tr>
                    <td><?= htmlspecialchars($doc['title']) ?></td>
                    <td><?= $doc['created_at'] ?></td>
                    <td><a href="../assets/uploads/<?= $doc['file_path'] ?>" target="_blank">عرض</a></td>
                    <td>
                        <a href="delete.php?id=<?= $doc['id'] ?>&employee_id=<?= $employee_id ?>" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer.php'; ?>