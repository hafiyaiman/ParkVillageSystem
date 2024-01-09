<?php
require('../functions.php');
require('../config.php');
?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>D'Park Village</title>
    <?php
    // Call the function to generate the favicon link
    generateFaviconLink();
    ?>
    <!-- plugin css file  -->
    <link rel="stylesheet" href="assets/plugin/datatables/responsive.dataTables.min.css">
    <link rel="stylesheet" href="assets/plugin/datatables/dataTables.bootstrap5.min.css">
    <!-- project css file  -->
    <link rel="stylesheet" href="assets/css/my-task.style.min.css">
</head>
<body>

<div id="mytask-layout" class="theme-indigo">

    <!-- sidebar -->
    <?php
    // Call the function to generate the sidebar
    generateSidebar();
    ?>

    <!-- main body area -->
    <div class="main px-lg-4 px-md-4"> 

        <!-- Body: Header -->
        <div class="header">
            <nav class="navbar py-4">
                <div class="container-xxl">
    
                    <!-- header rightbar icon -->
                    <div class="h-right d-flex align-items-center mr-5 mr-lg-0 order-1">
                    <div class="d-flex">
                            <div class="avatar-list avatar-list-stacked px-3">
                            </div>
                        </div>
                        <div class="dropdown notifications zindex-popover">
                            <div id="NotificationsDiv" class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-sm-end p-0 m-0">
                                <div class="card border-0 w380">
                                    <div class="card-header border-0 p-3"> 
                                    </div>
                                    <div class="tab-content card-body">
                                        <div class="tab-pane fade show active">
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>

                        <div class="dropdown user-profile ml-2 ml-sm-3 d-flex align-items-center zindex-popover">
                            <div class="u-info me-2">
                                <p class="mb-0 text-end line-height-sm "><span class="font-weight-bold">Ifwat</span></p>
                                <small>Admin</small>
                            </div>
                            <!-- Profile Image -->
                            <a class="nav-link dropdown-toggle pulse p-0" href="#" role="button" data-bs-toggle="dropdown" data-bs-display="static">
                                <img class="avatar lg rounded-circle img-thumbnail" src="assets/images/profile_av.png" alt="profile">
                            </a>
                            <div class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-end p-0 m-0">
                                <div class="card border-0 w280">
                                    <div class="card-body pb-0">
                                        <div class="d-flex py-1">
                                            <img class="avatar rounded-circle" src="assets/images/profile_av.png" alt="profile">
                                            <div class="flex-fill ms-3">
                                                <p class="mb-0"><span class="font-weight-bold">Zul Ifwat</span></p>
                                                <small class="">zul.ifwat@gmail.com</small>
                                            </div>
                                        </div>
                                        
                                        <div><hr class="dropdown-divider border-dark"></div>
                                    </div>
                                    <div class="list-group m-2 ">
                                        <a href="../logout.php" class="list-group-item list-group-item-action border-0 "><i class="icofont-logout fs-6 me-3"></i>Signout</a>
                                        <div><hr class="dropdown-divider border-dark"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <!-- menu toggler -->
                    <button class="navbar-toggler p-0 border-0 menu-toggle order-3" type="button" data-bs-toggle="collapse" data-bs-target="#mainHeader">
                        <span class="fa fa-bars"></span>
                    </button>
    
                    <!-- main menu Search-->
                    <div class="order-0 col-lg-4 col-md-4 col-sm-12 col-12 mb-3 mb-md-0 ">
                        <div class="input-group flex-nowrap input-group-lg">
                            
                        </div>
                    </div>
                </div>
            </nav>
        </div>

        <!-- Body: Body -->       
        <div class="body d-flex py-lg-3 py-md-2">
            <div class="container-xxl">
                <div class="row align-items-center">
                    <div class="border-0 mb-4">
                        <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                            <h3 class="fw-bold mb-0">Customer Details</h3>
                            <div class="col-auto d-flex w-sm-100">
                                
                            </div>
                        </div>
                    </div>
                </div> <!-- Row end  -->

                <!-- Table booking -->
                <div class="row clearfix g-3">
                  <div class="col-sm-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Customer ID</th>
                                            <th>Customer Name</th>
                                            <th>Phone No</th>
                                            <th>Address</th>
                                            <th>Booking ID</th>
                                            <th>Duration</th>
                                            <th>Amount</th>
                                            <th>Deposit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    // Fetch data from the database
                                        $sql = "SELECT * FROM booking b
                                        JOIN customer c ON b.Cust_ID = c.Cust_ID
                                        JOIN vehicle v ON v.Cust_ID = c.Cust_ID
                                        JOIN payment p ON b.Payment_ID = p.Payment_ID;";

                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td><span >" . $row['Cust_ID'] . "</span></td>";
                                                echo "<td>" . $row['Name'] . "</td>";
                                                echo "<td>" . $row['Pnum'] . "</td>";
                                                echo "<td>" . $row['Address'] . "</td>";
                                                echo "<td><span >" . $row['Book_ID'] . "</span></td>";
                                                echo "<td>" . $row['duration'] . "</td>";
                                                echo "<td>" . $row['deposit_paid'] . "</td>";
                                                echo "<td><span class='fw-bold ms-1'>" . $row['Amount'] . "</span></td>";

                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='6'>No data found</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- Row End -->
            </div>
        </div>
    </div>
</div>

<script>
    // Function to handle the delete action
    function deleteBooking(bookID) {
        if (confirm("Are you sure you want to delete this booking?")) {
            $.ajax({
                type: "POST",
                url: "delete_booking.php",
                data: { bookID: bookID },
                success: function(response) {
                    // Reload the page after successful deletion
                    location.reload();
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    }
</script>


<!-- Bootstrap JS (assuming you are using Bootstrap) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<!-- Jquery Core Js -->
<script src="assets/bundles/libscripts.bundle.js"></script>

<!-- Plugin Js-->
<script src="assets/bundles/dataTables.bundle.js"></script>

<!-- Jquery Page Js -->
<script src="../js/template.js"></script>
<script>
    // project data table
    $(document).ready(function() {
        $('#myProjectTable')
        .addClass( 'nowrap' )
        .dataTable( {
            responsive: true,
            columnDefs: [
                { targets: [-1, -3], className: 'dt-body-right' }
            ]
        });
    });
</script>
</body>
</html>
