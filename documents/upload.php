<?php
// محتوى تجريبي للملف: upload.php
// هذا الملف ضمن: /mnt/data/hr_system_final/documents
?>
<?php
// documents/upload.php
require_once '../config/db.php';
require_once '../includes/auth.php';

$employee_id = $_GET['employee_id'] ?? 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $file = $_FILES['file'];

    if ($file['error'] === 0) {
        $filename = time() . '_' . basename($file['name']);
        $target = '../assets/uploads/' . $filename;

        if (move_uploaded_file($file['tmp_name'], $target)) {
            $stmt = $conn->prepare("INSERT INTO documents (employee_id, title, file_path, created_at) VALUES (?, ?, ?, NOW())");
            $stmt->execute([$employee_id, $title, $filename]);
            header("Location: index.php?employee_id=$employee_id");
            exit;
        }
    }
}
include '../includes/header.php';
?>

<div class="container">
    <h2>رفع مستند جديد</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>عنوان المستند</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label>اختر الملف</label>
            <input type="file" name="file" class="form-control" required>
        </div>
        <br>
        <button type="submit" class="btn btn-success">رفع</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>