<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?r=apply");
    die();
}


$uid = $_SESSION['user_id'];

try {

    require_once "../php/config.php";
    require_once "../tcpdf/vendor/autoload.php";

    // Validate form data
    $required_fields = [
        'makeOfVehicle', 'model', 'registrationNo', 'colour',
        'typeOfVehicle', 'noOfPassenger', 'registerKeeper',
        'registerKeeperAddress', 'insuranceReceived'
    ];

    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            die("Error: All fields are required.");
        }
    }

    // Retrieve form data
    $makeOfVehicle = $_POST['makeOfVehicle'];
    $model = $_POST['model'];
    $registrationNo = $_POST['registrationNo'];
    $colour = $_POST['colour'];
    $typeOfVehicle = $_POST['typeOfVehicle'];
    $noOfPassenger = $_POST['noOfPassenger'];
    $registerKeeper = $_POST['registerKeeper'];
    $registerKeeperAddress = $_POST['registerKeeperAddress'];
    $insuranceReceived = $_POST['insuranceReceived'];

    // Create new PDF document
    $pdf = new TCPDF();
    $pdf->AddPage();

    // Set title
    $pdf->SetFont('helvetica', 'B', 20);
    $pdf->Cell(0, 10, 'Vehicle Details', 0, 1, 'C');

    // Add form data to PDF
    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(0, 10, "Make of Vehicle: $makeOfVehicle", 0, 1);
    $pdf->Cell(0, 10, "Model: $model", 0, 1);
    $pdf->Cell(0, 10, "Registration No: $registrationNo", 0, 1);
    $pdf->Cell(0, 10, "Colour: $colour", 0, 1);
    $pdf->Cell(0, 10, "Type of Vehicle: $typeOfVehicle", 0, 1);
    $pdf->Cell(0, 10, "No of Passenger: $noOfPassenger", 0, 1);
    $pdf->Cell(0, 10, "Register Keeper: $registerKeeper", 0, 1);
    $pdf->Cell(0, 10, "Register Keeper's Address: $registerKeeperAddress", 0, 1);
    $pdf->Cell(0, 10, "Copy of Insurance received: $insuranceReceived", 0, 1);

    // Save the PDF to server
    $pdf_output = "{$root}pdfs/vehicledetails_{$uid}.pdf";
    $handle = fopen($pdf_output, 'w+');
    fclose($handle);
    $pdf->Output($pdf_output, 'F');
    header("Location: apply.php?r=success");
} catch (Exception $e) {
    header("Location:apply.php?r=fail");
}
