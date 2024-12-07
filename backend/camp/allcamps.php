<?php
session_start();
include '../connections/connection.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Tuos media</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <!-- Datatable -->
    <link href="./themes/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="./themes/css/style.css" rel="stylesheet">

</head>

<body>
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a class="brand-logo">

                TUOS MEDIA
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">

                        </div>

                        <ul class="navbar-nav header-right">


                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end here
        ***********************************-->

        <!--**********************************
            Sidebar start here
        ***********************************-->
        <div class="quixnav">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    <li><a class="has-arrow" href="../Admin/dashboard.php" aria-expanded="false"><i class="icon icon-home"></i><span class="nav-text">DASHBOARD</span></a>

                    </li>


                    <li class="nav-label first">Main Menu</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="icon icon-app-store"></i><span class="nav-text">ROLES</span></a>
                        <ul aria-expanded="false">
                            <li><a href="../role/allRoles.php">View_All</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="icon icon-app-store"></i><span class="nav-text">CUSTOMERS</span></a>
                        <ul aria-expanded="false">
                            <li><a href="../donors/allDoners.php">View_All</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="icon icon-app-store"></i><span class="nav-text">SERVICES</span></a>
                        <ul aria-expanded="false">
                            <li><a href="../camp/allcamps.php">View_All</a></li>
                        </ul>
                    </li>
                </ul>
            </div>


        </div>
        <!--**********************************
            Sidebar end here
        ***********************************-->

        <!--**********************************
            Content body start here
        ***********************************-->
        <div class="content-body">
            <a href="./addcamp.php" class="btn btn" style="width: 100px;
             margin-left:900px;
              background-color:#001F3F
             "> New_Services</a>


            <div class="card-body shadow">
                <div class="table-responsive">
                    <table id="example" class="display" style="min-width: 845px;color:#001F3F">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>SERVICE_NAME</th>
                                <th>LOCATION</th>
                                <th>DESCRIPTION</th>
                                <th>OUR_SERVICE</th>
                                <th>CONTACT_NO</th>
                                <th>IMAGE</th>
                                <th>ACTION</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $cnt = 1; // Initialize the counter
                            $select_camp = "SELECT * FROM camp";
                            $result = mysqli_query($connect, $select_camp) or die(mysqli_error($connect));
                            $number = mysqli_num_rows($result);
                            if ($number > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                    <tr>
                                        <td><?php echo $cnt++; ?></td>
                                        <td><?php echo $row['camp_name']; ?></td>
                                        <td><?php echo $row['location']; ?></td>
                                        <td><?php echo substr($row['description'], 0, 30); ?>...</td>
                                        <td><?php echo substr($row['needs'], 0, 30); ?>...</td>
                                        <td><?php echo $row['donate_number']; ?></td>
                                        <td><img src="uploads/<?php echo $row['image']; ?>" alt="Camp Image" style="max-width: 100px;"></td>

                                        <td>

                                            <span>
                                                <a href="./updatecamp.php?camp_id=<?php echo $row['camp_id'] ?>">
                                                    <button class="btn btn-primary" style="width: 50px;background-color:#001F3F">
                                                        <i class="fa fa-eye"></i>
                                                        <!-- Eye icon for view -->
                                                    </button>
                                                </a>
                                            </span>

                                            <span>
                                                <button class="btn btn-danger" style="width: 50px;" onclick="confirmDelete(<?php echo $row['camp_id'] ?>)">
                                                    <i class="fa fa-trash"></i>
                                                    <!-- Trash icon for delete -->
                                                </button>
                                            </span>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='5'>0 results</td></tr>";
                            }
                            ?>
                        </tbody>

                    </table>
                    <hr>
                </div>
            </div>


        </div>
        <!--**********************************
            Content body end
        ***********************************-->


    </div>



    <!-- Required vendors -->
    <script src="./themes/vendor/global/global.min.js"></script>
    <script src="./themes/js/quixnav-init.js"></script>
    <script src="./themes/js/custom.min.js"></script>



    <!-- Datatable -->
    <script src="./themes/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="./themes/js/plugins-init/datatables.init.js"></script>

</body>

<script>
    function confirmDelete(campId) {
        // Display confirmation dialog
        if (confirm("Are you sure you want to delete?")) {
            // If user confirms, redirect to delete script
            window.location.href = "./deletecamp.php?camp_id=" + campId;
        }
    }
</script>

</html>