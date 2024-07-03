<?php

session_start();
if (isset($_SESSION['user_id'])) {
    header('Location:account.php');
    die();
}

include "../php/config.php";
include "../includes/head.php";

$email = $password = $confirmPassword = "";
$emailError = $passwordError = $confirmPasswordError = $error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "../php/conn.php";
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $confirmPassword = trim($_POST["confirmPassword"]);

    // Validate email
    if (empty($email)) {
        $emailError = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "Invalid email format.";
    }

    // Validate password
    if (empty($password)) {
        $passwordError = "Password is required.";
    } elseif (strlen($password) < 6) {
        $passwordError = "Password must be at least 6 characters.";
    }

    // Validate confirm password
    if (empty($confirmPassword)) {
        $confirmPasswordError = "Please confirm your password.";
    } elseif ($password !== $confirmPassword) {
        $confirmPasswordError = "Passwords do not match.";
    }

    // If no errors, proceed with inserting into database
    if (empty($emailError) && empty($passwordError) && empty($confirmPasswordError)) {
        $encodedEmail = base64_encode($email);
        $encodedPassword = base64_encode($password);

        try {
            $qry = mysqli_query($conn, "INSERT INTO users (uemail, upass) VALUES ('{$encodedEmail}','$encodedPassword')");
            if ($qry && $conn->affected_rows) {
                $_SESSION['user_id'] = $conn->insert_id;
                echo "<script>location.replace('account.php')</script>";
                die();
            } else {
                $error = "Error: " . $stmt->error;
            }
        } catch (Exception $e) {
            if ($e->getCode() === 1062) {
                $error = "Email already exists.";
            } else {
                $error = "Something Went Wrong [Error: " . $e->getCode() . "]";
            }
        }


        $conn->close();
    }
}
?>

<link rel="stylesheet" href="../styles/form.css">
</head>

<body>
    <div class="container-fluid vh-100 d-flex">
        <div class="m-auto rounded-4 p-4 form-container">
            <form id="signupForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <h1 class="text-center fw-bolder">Registration</h1>
                <hr>
                <?php if (!empty($error)) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="example@gmail.com" value="<?php echo htmlspecialchars($email); ?>">
                    <div class="form-text text-danger" id="emailError"><?php echo $emailError; ?></div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Your Password">
                    <div class="form-text text-danger" id="passwordError"><?php echo $passwordError; ?></div>
                </div>
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password">
                    <div class="form-text text-danger" id="confirmPasswordError"><?php echo $confirmPasswordError; ?></div>
                </div>
                <button type="submit" id="submit-btn" class="btn btn-dark d-block w-100 fw-bold">Submit</button>
                <div class="text-center pt-3">
                    <a href="login.php">Login instead</a>
                </div>
            </form>
        </div>
    </div>

    <!-- SCRIPTS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-qFOQ9YFAeGj1gDOuUD61g3D+tLDv3u1ECYWqT82WQoaWrOhAY+5mRMTTVsQdWutbA5FORCnkEPEgU0OF8IzGvA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <script src="../js/signup.js"></script>

</body>

</html>