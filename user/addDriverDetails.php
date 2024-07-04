<?php

use Fpdf\Fpdf;

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?r=apply");
    die();
}


$uid = $_SESSION['user_id'];
try {

    require_once "../php/config.php";
    require_once "../fpdf/vendor/autoload.php";

    // Validate form data
    $required_fields = [
        'driverNo', 'surname', 'name', 'address', 'dateOfBirth', 'ni'
    ];

    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            die("Error: All fields are required");
        }
    }

    // Retrieve form data
    $driverNo = $_POST['driverNo'];
    $surname = $_POST['surname'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $ni = $_POST['ni'];

    // Create new PDF document
    $pdf = new Fpdf();
    $pdf->AddPage();

    // Set title
    $pdf->SetFont('helvetica', 'B', 20);
    $pdf->Cell(0, 10, 'Driver Details', 0, 1, 'C');

    // Add form data to PDF
    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(0, 10, "Driver No: $driverNo", 0, 1);
    $pdf->Cell(0, 10, "Surname / Family Name: $surname", 0, 1);
    $pdf->Cell(0, 10, "Name: $name", 0, 1);
    $pdf->Cell(0, 10, "Address: $address", 0, 1);
    $pdf->Cell(0, 10, "Date of Birth: $dateOfBirth", 0, 1);
    $pdf->Cell(0, 10, "NI: $ni", 0, 1);

    // Save the PDF to server
    $pdf_output = "{$root}pdfs/driverdetails_{$uid}.pdf";
    $handle = fopen($pdf_output, 'w+');
    fclose($handle);
    $pdf->Output($pdf_output, 'F');
    header("Location: apply.php?r=success");
} catch (Exception $e) {
    header("Location: apply.php?r=fail&error={$e->getCode()}");
}
