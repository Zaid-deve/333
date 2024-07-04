<?php

use Fpdf\Fpdf;

include "../php/config.php";
require '../fpdf/vendor/autoload.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location: login.php");
    die();
}
$uid = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $requiredFiles = [
        'driverLicenceFront', 'driverLicenceBack', 'driverPCO', 'driverBadge',
        'vehicleLogbookFront', 'vehicleLogbookSecond', 'vehiclePHV',
        'vehicleMOT', 'vehicleInsurance', 'enhancedDBS'
    ];
    $files = [];
    $errors = [];

    // Check and validate files
    foreach ($requiredFiles as $file) {
        if (isset($_FILES[$file]) && $_FILES[$file]['error'] == 0) {
            $fileType = mime_content_type($_FILES[$file]['tmp_name']);
            if (in_array($fileType, $allowedTypes)) {
                $files[$file] = ['tmp_name' => $_FILES[$file]['tmp_name'], 'name' => $_FILES[$file]['name']];
            } else {
                $errors[] = "$file is not a valid image.";
            }
        } else {
            $errors[] = "$file is required.";
        }
    }

    // If there are errors, display them
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
        exit;
    } else {
        echo "<h1>Errors: </h1><br>";
        echo implode('<br>', $errors);
    }

    // If all files are valid, create a PDF
    if (count($files) === count($requiredFiles)) {
        $fpdf = new Fpdf();
        foreach ($files as $file) {
            list($width, $height) = getimagesize($file['tmp_name']);
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);

            // Resize the image to fit within the page dimensions
            $pageWidth = $fpdf->GetPageWidth();
            $pageHeight = $fpdf->GetPageHeight();
            $maxWidth = $pageWidth - 20;  // Leave some margin
            $maxHeight = $pageHeight - 20;

            if ($width > $maxWidth || $height > $maxHeight) {
                $widthRatio = $maxWidth / $width;
                $heightRatio = $maxHeight / $height;
                $scale = min($widthRatio, $heightRatio);
                $width = $width * $scale;
                $height = $height * $scale;
            }

            $x = ($pageWidth - $width) / 2;
            $y = ($pageHeight - $height) / 2;

            $fpdf->AddPage();
            $fpdf->Image($file['tmp_name'], $x, $y, $width, $height, $ext);
        }

        $handle = fopen("{$root}pdfs/driverdocument_$uid.pdf", 'w+');
        fclose($handle);
        $fpdf->Output("F", "{$root}pdfs/driverdocument_$uid.pdf");
        header("Location:apply.php");
    }
}
