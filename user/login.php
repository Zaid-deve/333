<?php

include "../php/config.php";
include "../includes/head.php";

?>

<link rel="stylesheet" href="../styles/form.css">
</head>

<body>

    <div class="container-fluid vh-100 d-flex">
        <div class="m-auto rounded-4 p-4 form-container">
            <form onsubmit="return validateForm()">
                <h1 class="text-center fw-bolder">Login</h1>
                <hr>
                <div class="mb-3">
                    <label for="__email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="__email" placeholder="example@gmail.com">
                    <div class="form-text text-danger"></div>
                </div>
                <div class="mb-3">
                    <label for="__pass" class="form-label">Password</label>
                    <input type="password" class="form-control" id="__pass" placeholder="Enter Your Password">
                    <div class="form-text text-danger"></div>
                </div>
                <button type="submit" id="submit-btn" class="btn btn-dark d-block w-100 fw-bold py-2" disabled>Submit</button>
            </form>
        </div>
    </div>

    <!-- SCRIPTS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-qFOQ9YFAeGj1gDOuUD61g3D+tLDv3u1ECYWqT82WQoaWrOhAY+5mRMTTVsQdWutbA5FORCnkEPEgU0OF8IzGvA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <script src="../js/login.js"></script>
 
</body>

</html>