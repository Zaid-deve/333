<?php

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $image = $_FILES['profile'];
    $uploadDir = '../profiles/';
    $updateQuery = "UPDATE users SET ";
    $updateFields = [];

    if (!empty($name)) {
        $updateFields[] = "uname = '" . mysqli_real_escape_string($conn, base64_encode($name)) . "'";
    }

    if (!empty($image['name'])) {
        $uploadFile = $uploadDir . basename($image['name']);
        $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
        $validImageTypes = ['gif', 'jpeg', 'jpg', 'png', 'webp'];

        if (in_array($imageFileType, $validImageTypes) && move_uploaded_file($image['tmp_name'], $uploadFile)) {
            $updateFields[] = "uimg = '" . mysqli_real_escape_string($conn, $uploadFile) . "'";
        } else {
            $error = "Invalid image file or failed to set profile image.";
        }
    }

    if (!empty($updateFields)) {
        $updateQuery .= implode(', ', $updateFields) . " WHERE uid = $uid";
        if (mysqli_query($conn, $updateQuery)) {
            $_SESSION['update'] = true;
            header("Location: " . $_SERVER["PHP_SELF"]);
        } else {
            $error = "Failed to update profile. Please try again.";
        }
    } else {
        $error = "No data to update.";
    }
}