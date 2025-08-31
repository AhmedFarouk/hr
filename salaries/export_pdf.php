<?php
// محتوى تجريبي للملف: export_pdf.php
// هذا الملف ضمن: /mnt/data/hr_system_final/salaries
?>
<?php
require_once '../config/db.php';
require('../assets/lib/fpdf/fpdf.php');

$month = $_GET['month'] ?? date('Y-m');
$result = $conn->query("
    SELECT s.*, e.name AS employee_name
    FROM salaries s
    JOIN employees e ON s.employee_id = e.id
    WHERE DATE_FORMAT(s.salary_month, '%Y-%m') = '$month'
");

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, "تقرير الرواتب - $month", 0, 1, 'C');

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 10, "الموظف", 1);
$pdf->Cell(30, 10, "الأساسي", 1);
$pdf->Cell(30, 10, "المكافآت", 1);
$pdf->Cell(30, 10, "الخصومات", 1);
$pdf->Cell(40, 10, "الصافي", 1);
$pdf->Cell(20, 10, "الشهر", 1);
$pdf->Ln();

while ($row = $result->fetch_assoc()) {
    $pdf->Cell(40, 10, $row['employee_name'], 1);
    $pdf->Cell(30, 10, $row['base_salary'], 1);
    $pdf->Cell(30, 10, $row['rewards'], 1);
    $pdf->Cell(30, 10, $row['penalties'], 1);
    $pdf->Cell(40, 10, $row['net_salary'], 1);
    $pdf->Cell(20, 10, substr($row['salary_month'], 0, 7), 1);
    $pdf->Ln();
}

$pdf->Output("I", "salaries_$month.pdf");
