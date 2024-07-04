<?php

include "../php/config.php";
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}

require "../php/conn.php";
$uid = $_SESSION['user_id'];
include "update-account.php";


try {
    $qry = mysqli_query($conn, "SELECT uemail,ulogdate,uimg,uname FROM users WHERE uid = $uid");
    if ($qry && mysqli_num_rows($qry)) {
        $data = mysqli_fetch_assoc($qry);
        $email = base64_decode($data['uemail']);
        $date = date("d M,Y", strtotime($data['ulogdate']));
        $uimg = $data['uimg'];
        if (!$uimg or !file_exists($uimg)) {
            $uimg = '../images/download.png';
        }
        $name = base64_decode($data['uname']);
    } else {
        throw new Exception("", 0);
    }
} catch (Exception $e) {
    die("Something Went Wrong, try login again or register with the email again [Error: " . $e->getCode() . "], <a href='login.php'>click on me to login again</a>");
}

$pagename = "My Account";
include "../includes/head.php";

?>
<link rel="stylesheet" href="../styles/form.css">
</head>

<body>


    <div class="container-fluid d-flex vh-100 bg-dark">
        <div class="bg-white m-auto rounded-3 p-3 form-container">
            <h3>My Account</h3>
            <hr>
            <div>
                <?php

                if (!empty($error)) {
                    echo "<div class='alert alert-danger'>
                              $error
                          </div>";
                } else {
                    if (isset($_SESSION['update'])) {
                        unset($_SESSION['update']);
                        echo "<div class='alert alert-success'>
                                profile updated succesfully
                              </div>";
                    }
                }

                ?>
                <div class="d-flex gap-2">
                    <a href="../logout.php" class="btn btn-secondary w-50">Logout</a>
                    <a href="apply.php" class="btn btn-primary w-50">Apply As Driver</a>
                </div>
                <form action="<?php echo "account.php" ?>" method="POST" enctype="multipart/form-data" class="mt-4">
                    <div class="text-center">
                        <label for="profile">
                            <img src="<?php echo $uimg; ?>" alt="Profile" class="img-cover rounded-circle bg-light d-block m-auto" height="110px" width="110px" id="profile-img">
                            <div class="btn text-primary">add my profile photo</div>
                        </label>
                        <input type="file" id="profile" accept="image/*" hidden name="profile">
                        <div class="text-danger" id="file-error"></div>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Your name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" placeholder="Enter Your Name">
                        <div class="text-danger"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <input type="text" class="form-control" readonly value="<?php echo htmlspecialchars($email); ?>">
                    </div>
                    <p class="mt-3 text-muted fw-light">Registration Date: <?php echo $date; ?></p>
                    <button type="submit" id="submit-btn" class="btn btn-primary d-block w-100 fw-bold d-none">Continue</button>
            </div>
            </form>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../js/account.js"></script>

</body>

</html>