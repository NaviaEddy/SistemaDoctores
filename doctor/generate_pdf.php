<?php
require('../libs/fpdf186/fpdf.php');

$patient_id = $_GET['id'];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://localhost/Online-Doctor-Appointment-System/doctor/obtenerHistorial.php?id=" . $patient_id);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);

if (!$data) {
    die("No se pudo obtener la información del historial médico.");
}

$pdf = new FPDF('P', 'mm', 'Letter'); 
$pdf->AddPage();
$pdf->SetMargins(15, 10, 15);
$pdf->Image('../public/img/edoc-transparency.png', 0, 0, 215.9, 279.4);

$pdf->SetFont('Arial', 'B', 14);
$pdf->SetTextColor(255, 255, 255); // Texto blanco
$pdf->SetFillColor(0, 0, 0); // Fondo negro
$pdf->Cell(0, 12, 'E-Doc. | THE ENGINEERING FINAL YEAR PROJECT.', 0, 1, 'C', true);

// Salto de línea
$pdf->Ln(10);

// Configuración del título del documento
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetTextColor(0, 0, 0); // Texto negro
$pdf->Cell(0, 10, 'Medical History', 0, 1, 'C');

// Salto de línea
$pdf->Ln(10);

// Contenido del historial médico
$pdf->SetFont('Arial', '', 12);
$pdf->SetTextColor(0, 0, 0); // Texto negro
$pdf->Cell(0, 10, 'Patient ID: P-' . $data['pid'], 0, 1);
$pdf->Cell(0, 10, 'Name: ' . $data['pname'], 0, 1);
$pdf->Cell(0, 10, 'Email: ' . $data['pemail'], 0, 1);
$pdf->Cell(0, 10, 'Telephone: ' . $data['ptel'], 0, 1);
$pdf->Cell(0, 10, 'Address: ' . $data['paddress'], 0, 1);
$pdf->Cell(0, 10, 'Date of Birth: ' . $data['pdob'], 0, 1);
$pdf->Cell(0, 10, 'Allergies: ' . ($data['allergies'] ? $data['allergies'] : 'N/A'), 0, 1);
$pdf->Cell(0, 10, 'Previous Conditions: ' . ($data['previous_conditions'] ? $data['previous_conditions'] : 'N/A'), 0, 1);
$pdf->Cell(0, 10, 'Current Medications: ' . ($data['current_medications'] ? $data['current_medications'] : 'N/A'), 0, 1);
$pdf->Cell(0, 10, 'Family History: ' . ($data['family_history'] ? $data['family_history'] : 'N/A'), 0, 1);
$pdf->Cell(0, 10, 'Vaccinations: ' . ($data['vaccinations'] ? $data['vaccinations'] : 'N/A'), 0, 1);
$pdf->Cell(0, 10, 'Last Visit Date: ' . ($data['last_visit_date'] ? $data['last_visit_date'] : 'N/A'), 0, 1);
$pdf->Output('D', 'medical_history_' . $data['pname'] . '.pdf');

exit();
?>
