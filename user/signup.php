<?php

include "../php/config.php";
include "../includes/head.php";

?>

<link rel="stylesheet" href="../styles/form.css">
</head>

<body>

    <div class="container-fluid vh-100 d-flex">
        <div class="m-auto rounded-4 p-4 form-container">
            <form id="signupForm" action="process_signup.php" method="POST">
                <h1 class="text-center fw-bolder">Registration</h1>
                <hr>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="example@gmail.com">
                    <div class="form-text text-danger" id="emailError"></div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Your Password">
                    <div class="form-text text-danger" id="passwordError"></div>
                </div>
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password">
                    <div class="form-text text-danger" id="confirmPasswordError"></div>
                </div>
                <button type="submit" id="submit-btn" class="btn btn-dark d-block w-100 fw-bold" disabled>Submit</button>
            </form>
        </div>
    </div>

    <!-- SCRIPTS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-qFOQ9YFAeGj1gDOuUD61g3D+tLDv3u1ECYWqT82WQoaWrOhAY+5mRMTTVsQdWutbA5FORCnkEPEgU0OF8IzGvA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <script src="../js/signup.js"></script>
 
</body>
</html>
