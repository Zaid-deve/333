<?php

include "../php/config.php";

require_once "../php/conn.php";
$pagename = 'Admin Dashboard';
include "../includes/head.php";
?>

<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css'>
<link rel="stylesheet" href="<?php echo $baseurl ?>/styles/dashboard.css">
</head>

<body>

    <header class="fixed-top w-100 bg-dark py-3">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid align-items-center">
                <h1 class="text-light"><i class="ri-admin-line"></i> Dashboard</h1>
                <a href="../logout.php" class="btn btn-danger rounded-5 fw-bold px-3 py-2">Logout</a>
            </div>
        </nav>
    </header>

    <main class="vh-100">
        <div class="container-fluid h-100 py-3">
            <div class="row h-100 py-3">
                <div class="col-lg-4 col-md-5 left-pannel <?php if(!isset($_GET['m'])) echo 'show' ?>">
                    <ul class="list-group">
                        <ul class="list-group pannel-options">
                            <li class="list-group-item border-0 active">
                                <a href="?m=users" class="py-2 d-flex align-items-center"><i class="ri-group-line"></i>&nbsp; users <span class="ms-auto">></span></a>
                            </li>
                            <li class="list-group-item border-0">
                                <a href="?m=applications" class="py-2 d-flex align-items-center"><i class="ri-car-line"></i>&nbsp; Driver Applications <span class="ms-auto">></span></a>
                            </li>
                        </ul>
                    </ul>
                </div>

                <div class="col p-md-3">
                    <?php if (isset($_GET['m'])) {
                        $mod = $_GET['m'];

                        echo "<script>
                           if('$mod'=='applications'){
                           document.querySelector('.pannel-options').firstElementChild.classList.remove('active')
                           document.querySelector('.pannel-options').lastElementChild.classList.add('active')
                           } else {
                           document.querySelector('.pannel-options').firstElementChild.classList.add('active')
                           }
                        </script>";
                        if ($mod === 'applications') {
                            require_once "applications.php";
                        } else {
                            require_once "users.php";
                        }
                    } else {
                        echo "<div class='text-center py-5'>
                               nothing to show at a moment
                              </div>";
                    }?>
                </div>
            </div>
        </div>
    </main>

</body>

</html>