<?php

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location:login.php");
    die();
}
$uid = $_SESSION['user_id'];

include "../php/config.php";
include "../includes/head.php";

$p = $_GET['r'] ?? null;
$driverFile = file_exists("{$root}pdfs/driverdetails_$uid.pdf");
$vehicleFile = file_exists("{$root}pdfs/vehicledetails_$uid.pdf");
$documentFile = file_exists("{$root}pdfs/driverdocument_$uid.pdf");

?>

<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css'>
<link rel="stylesheet" href="../styles/form.css">
</head>

<body>

    <!-- main -->
    <main class="main">
        <div class="container-fluid vh-100 d-flex form-outer p-0">
            <div class="form-container m-auto p-4">
                <h1 class="fw-light py-2"><i class="ri-car-line"></i> Apply As Driver At 333com Limited</h1>
                <hr>
                <?php if ($driverFile && $vehicleFile && $documentFile) { ?>
                    <div class="alert alert-success text-center">
                        <h1><i class="ri-check-line"></i></h1>
                        <strong>Success!</strong> Your form has been submitted successfully. <br>
                        <p>Wait for the authorities to accept your form, you will be notified</p>
                    </div>
                <?php } else { ?>



                    <div class="row forms-grid">
                        <div class="col-md-6">
                            <h3 class="my-4"><u>Vehicle's Details: </u></h3>
                            <?php

                            if ($p && $p == 'fail') {
                                echo "<div class='alert alert-danger'>There Is An Error Updating Your Driver Details</div>";
                            }


                            if (!$vehicleFile) { ?>
                                <form class="form form-0 d-flex flex-column gap-3" action="addVehicleDetails.php" method="post">
                                    <div class="form-group">
                                        <label for="makeOfVehicle">Make of Vehicle</label>
                                        <input type="text" class="form-control" id="makeOfVehicle" name="makeOfVehicle" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="model">Model</label>
                                        <input type="text" class="form-control" id="model" name="model" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="registrationNo">Registration No</label>
                                        <input type="text" class="form-control" id="registrationNo" name="registrationNo" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="colour">Colour</label>
                                        <input type="text" class="form-control" id="colour" name="colour" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="typeOfVehicle">Type of Vehicle</label>
                                        <input type="text" class="form-control" id="typeOfVehicle" name="typeOfVehicle" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="noOfPassenger">No of Passenger</label>
                                        <input type="text" class="form-control" id="noOfPassenger" name="noOfPassenger" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="registerKeeper">Register Keeper</label>
                                        <input type="text" class="form-control" id="registerKeeper" name="registerKeeper" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="registerKeeperAddress">Register Keeper's Address</label>
                                        <input type="text" class="form-control" id="registerKeeperAddress" name="registerKeeperAddress" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Copy of Insurance received?</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="insuranceReceived" id="insuranceReceivedYes" value="yes" required>
                                            <label class="form-check-label" for="insuranceReceivedYes">
                                                Yes
                                            </label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-dark fw-bold d-block mx-auto py-2 px-5 rounded">Submit</button>
                                </form>
                            <?php } else {
                                echo "<div class='alert alert-success'>Your Vehicle Details Is Added</div>";
                            }
                            ?>
                        </div>
                        <div class="col-md-6">
                            <h3 class="my-4"><u>Driver Details: </u></h3>
                            <?php

                            if ($p && $p == 'fail' && !$driverFile) {
                                echo "<div class='alert alert-danger'>There Is An Error Updating Your Driver Details</div>";
                            }

                            if (!$driverFile) { ?>
                                <form class="form form-0 d-flex flex-column gap-3" action="addDriverDetails.php" method="post">
                                    <div class="form-group">
                                        <label for="driverNo">Driver No</label>
                                        <input type="text" class="form-control" id="driverNo" name="driverNo" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="surname">Surname / Family Name</label>
                                        <input type="text" class="form-control" id="surname" name="surname" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" id="address" name="address" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="dateOfBirth">Date of Birth</label>
                                        <input type="date" class="form-control" id="dateOfBirth" name="dateOfBirth" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="ni">NI</label>
                                        <input type="text" class="form-control" id="ni" name="ni" required>
                                    </div>
                                    <button type="submit" class="btn btn-dark fw-bold d-block mx-auto py-2 px-5 rounded">Submit</button>
                                </form>
                            <?php } else {
                                echo "<div class='alert alert-success'>Your Driver Details Are Updated</div>";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="text-center">
                        <hr>
                        <h3>Upload Documents</h3>
                        <p class="text-muted">upload required document to apply for the driver</p>
                        <button type="button" class="btn btn-dark fw-bold d-block mx-auto py-2 px-5 rounded-5 btn-toggle-doc-container">+ Upload Documents</button>
                    </div>
                <?php } ?>
            </div>
        </div>
    </main>

    <div class="fixed-top w-100 h-100 bg-white d-none doc-container">
        <div class="container-fluid d-flex pb-4 vh-100">
            <div class="form-container m-auto rounded-3 p-3">
                <h3>Upload Following Documents: </h3>
                <hr>
                <form id="documentUploadForm" action="uploadDocuments.php" method="post" enctype="multipart/form-data" class="form form-0 d-flex flex-column gap-3 mt-4">
                    <div class="form-group">
                        <label for="driverLicenceFront">Driver Licence Front</label>
                        <input type="file" class="form-control" id="driverLicenceFront" name="driverLicenceFront" required>
                    </div>
                    <div class="form-group">
                        <label for="driverLicenceBack">Driver Licence Back</label>
                        <input type="file" class="form-control" id="driverLicenceBack" name="driverLicenceBack" required>
                    </div>
                    <div class="form-group">
                        <label for="driverPCO">Driver PCO</label>
                        <input type="file" class="form-control" id="driverPCO" name="driverPCO" required>
                    </div>
                    <div class="form-group">
                        <label for="driverBadge">Driver Badge</label>
                        <input type="file" class="form-control" id="driverBadge" name="driverBadge" required>
                    </div>
                    <div class="form-group">
                        <label for="vehicleLogbookFront">Vehicle Logbook Front Page</label>
                        <input type="file" class="form-control" id="vehicleLogbookFront" name="vehicleLogbookFront" required>
                    </div>
                    <div class="form-group">
                        <label for="vehicleLogbookSecond">Vehicle Logbook Second Page</label>
                        <input type="file" class="form-control" id="vehicleLogbookSecond" name="vehicleLogbookSecond" required>
                    </div>
                    <div class="form-group">
                        <label for="vehiclePHV">Vehicle PHV</label>
                        <input type="file" class="form-control" id="vehiclePHV" name="vehiclePHV" required>
                    </div>
                    <div class="form-group">
                        <label for="vehicleMOT">Vehicle MOT</label>
                        <input type="file" class="form-control" id="vehicleMOT" name="vehicleMOT" required>
                    </div>
                    <div class="form-group">
                        <label for="vehicleInsurance">Vehicle Insurance</label>
                        <input type="file" class="form-control" id="vehicleInsurance" name="vehicleInsurance" required>
                    </div>
                    <div class="form-group">
                        <label for="enhancedDBS">Enhanced DBS</label>
                        <input type="file" class="form-control" id="enhancedDBS" name="enhancedDBS" required>
                    </div>
                    <button type="submit" class="btn btn-dark fw-bold d-block mx-auto py-2 px-5 rounded">Upload Documents</button>
                </form>
            </div>
        </div>
    </div>


    <!-- scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../js/apply.js"></script>

</body>

</html>