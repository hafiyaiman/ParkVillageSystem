<?php
require('../functions.php');
?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>:: My-Task:: Dashboard </title>
    <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->
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
                            <a class="nav-link text-primary collapsed" href="help.html" title="Get Help">
                                <i class="icofont-info-square fs-5"></i>
                            </a>
                            <div class="avatar-list avatar-list-stacked px-3">
                                <img class="avatar rounded-circle" src="assets/images/xs/avatar2.jpg" alt="">
                                <img class="avatar rounded-circle" src="assets/images/xs/avatar1.jpg" alt="">
                                <img class="avatar rounded-circle" src="assets/images/xs/avatar3.jpg" alt="">
                                <img class="avatar rounded-circle" src="assets/images/xs/avatar4.jpg" alt="">
                                <img class="avatar rounded-circle" src="assets/images/xs/avatar7.jpg" alt="">
                                <img class="avatar rounded-circle" src="assets/images/xs/avatar8.jpg" alt="">
                                <span class="avatar rounded-circle text-center pointer" data-bs-toggle="modal" data-bs-target="#addUser"><i class="icofont-ui-add"></i></span>
                            </div>
                        </div>
                        <div class="dropdown notifications zindex-popover">
                            <a class="nav-link dropdown-toggle pulse" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="icofont-alarm fs-5"></i>
                                <span class="pulse-ring"></span>
                            </a>
                            <div id="NotificationsDiv" class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-sm-end p-0 m-0">
                                <div class="card border-0 w380">
                                    <div class="card-header border-0 p-3">
                                        <h5 class="mb-0 font-weight-light d-flex justify-content-between">
                                            <span>Notifications</span>
                                            <span class="badge text-white">11</span>
                                        </h5>
                                    </div>
                                    <div class="tab-content card-body">
                                        <div class="tab-pane fade show active">
                                            <ul class="list-unstyled list mb-0">
                                                <li class="py-2 mb-1 border-bottom">
                                                    <a href="javascript:void(0);" class="d-flex">
                                                        <img class="avatar rounded-circle" src="assets/images/xs/avatar1.jpg" alt="">
                                                        <div class="flex-fill ms-2">
                                                            <p class="d-flex justify-content-between mb-0 "><span class="font-weight-bold">Dylan Hunter</span> <small>2MIN</small></p>
                                                            <span class="">Added  2021-02-19 my-Task ui/ux Design <span class="badge bg-success">Review</span></span>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="py-2 mb-1 border-bottom">
                                                    <a href="javascript:void(0);" class="d-flex">
                                                        <div class="avatar rounded-circle no-thumbnail">DF</div>
                                                        <div class="flex-fill ms-2">
                                                            <p class="d-flex justify-content-between mb-0 "><span class="font-weight-bold">Diane Fisher</span> <small>13MIN</small></p>
                                                            <span class="">Task added Get Started with Fast Cad project</span>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="py-2 mb-1 border-bottom">
                                                    <a href="javascript:void(0);" class="d-flex">
                                                        <img class="avatar rounded-circle" src="assets/images/xs/avatar3.jpg" alt="">
                                                        <div class="flex-fill ms-2">
                                                            <p class="d-flex justify-content-between mb-0 "><span class="font-weight-bold">Andrea Gill</span> <small>1HR</small></p>
                                                            <span class="">Quality Assurance Task Completed</span>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="py-2 mb-1 border-bottom">
                                                    <a href="javascript:void(0);" class="d-flex">
                                                        <img class="avatar rounded-circle" src="assets/images/xs/avatar5.jpg" alt="">
                                                        <div class="flex-fill ms-2">
                                                            <p class="d-flex justify-content-between mb-0 "><span class="font-weight-bold">Diane Fisher</span> <small>13MIN</small></p>
                                                            <span class="">Add New Project for App Developemnt</span>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="py-2 mb-1 border-bottom">
                                                    <a href="javascript:void(0);" class="d-flex">
                                                        <img class="avatar rounded-circle" src="assets/images/xs/avatar6.jpg" alt="">
                                                        <div class="flex-fill ms-2">
                                                            <p class="d-flex justify-content-between mb-0 "><span class="font-weight-bold">Andrea Gill</span> <small>1HR</small></p>
                                                            <span class="">Add Timesheet For Rhinestone project</span>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="py-2">
                                                    <a href="javascript:void(0);" class="d-flex">
                                                        <img class="avatar rounded-circle" src="assets/images/xs/avatar7.jpg" alt="">
                                                        <div class="flex-fill ms-2">
                                                            <p class="d-flex justify-content-between mb-0 "><span class="font-weight-bold">Zoe Wright</span> <small class="">1DAY</small></p>
                                                            <span class="">Add Calander Event</span>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <a class="card-footer text-center border-top-0" href="#"> View all notifications</a>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown user-profile ml-2 ml-sm-3 d-flex align-items-center zindex-popover">
                            <div class="u-info me-2">
                                <p class="mb-0 text-end line-height-sm "><span class="font-weight-bold">Dylan Hunter</span></p>
                                <small>Admin Profile</small>
                            </div>
                            <a class="nav-link dropdown-toggle pulse p-0" href="#" role="button" data-bs-toggle="dropdown" data-bs-display="static">
                                <img class="avatar lg rounded-circle img-thumbnail" src="assets/images/profile_av.png" alt="profile">
                            </a>
                            <div class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-end p-0 m-0">
                                <div class="card border-0 w280">
                                    <div class="card-body pb-0">
                                        <div class="d-flex py-1">
                                            <img class="avatar rounded-circle" src="assets/images/profile_av.png" alt="profile">
                                            <div class="flex-fill ms-3">
                                                <p class="mb-0"><span class="font-weight-bold">Dylan Hunter</span></p>
                                                <small class="">Dylan.hunter@gmail.com</small>
                                            </div>
                                        </div>
                                        
                                        <div><hr class="dropdown-divider border-dark"></div>
                                    </div>
                                    <div class="list-group m-2 ">
                                        <a href="task.html" class="list-group-item list-group-item-action border-0 "><i class="icofont-tasks fs-5 me-3"></i>My Task</a>
                                        <a href="members.html" class="list-group-item list-group-item-action border-0 "><i class="icofont-ui-user-group fs-6 me-3"></i>members</a>
                                        <a href="ui-elements/auth-signin.html" class="list-group-item list-group-item-action border-0 "><i class="icofont-logout fs-6 me-3"></i>Signout</a>
                                        <div><hr class="dropdown-divider border-dark"></div>
                                        <a href="ui-elements/auth-signup.html" class="list-group-item list-group-item-action border-0 "><i class="icofont-contact-add fs-5 me-3"></i>Add personal account</a>
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
                            <button type="button" class="input-group-text" id="addon-wrapping"><i class="fa fa-search"></i></button>
                            <input type="search" class="form-control" placeholder="Search" aria-label="search" aria-describedby="addon-wrapping">
                            <button type="button" class="input-group-text add-member-top" id="addon-wrappingone" data-bs-toggle="modal" data-bs-target="#addUser"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
    
                </div>
            </nav>
        </div>

        <!-- Body: Body -->
        <div class="body d-flex py-3">
            <div class="container-xxl">
                <div class="row g-3 mb-3 row-deck">
                    <div class="col-md-12 col-lg-4 col-xl-4 col-xxl-4">
                        <div class="card ">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar lg  rounded-1 no-thumbnail bg-lightyellow color-defult"><i class="bi bi-journal-check fs-4"></i></div>
                                    <div class="flex-fill ms-4">
                                        <div class="">Total Task</div>
                                        <h5 class="mb-0 ">122</h5>
                                    </div>
                                    <a href="task.html" title="view-members" class="btn btn-link text-decoration-none  rounded-1"><i class="icofont-hand-drawn-right fs-2 "></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-4 col-xl-4 col-xxl-4">
                        <div class="card ">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar lg  rounded-1 no-thumbnail bg-lightblue color-defult"><i class="bi bi-list-check fs-4"></i></div>
                                    <div class="flex-fill ms-4">
                                        <div class="">Completed Task</div>
                                        <h5 class="mb-0 ">376</h5>
                                    </div>
                                    <a href="task.html" title="space-used" class="btn btn-link text-decoration-none  rounded-1"><i class="icofont-hand-drawn-right fs-2 "></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-4 col-xl-4 col-xxl-4">
                        <div class="card ">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar lg  rounded-1 no-thumbnail bg-lightgreen color-defult"><i class="bi bi-clipboard-data fs-4"></i></div>
                                    <div class="flex-fill ms-4">
                                        <div class="">Progress Task</div>
                                        <h5 class="mb-0 ">74</h5>
                                    </div>
                                    <a href="task.html" title="renewal-date" class="btn btn-link text-decoration-none  rounded-1"><i class="icofont-hand-drawn-right fs-2 "></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- Row End -->
                <div class="row g-3 mb-3 row-deck">
                    <div class="col-md-12 col-lg-8 col-xl-7 col-xxl-7">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-12 col-md-5 col-lg-6 order-md-2 ">
                                        <div class="text-center p-4">
                                            <img src="assets/images/task-view.svg" alt="..." class="img-fluid">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-7 col-lg-6 order-md-1 px-4">
                                        <h3 class="fw-bold ">Dylan Hunter</h3>
                                        <p class="line-height-custom">Welcome back Dylan Hunter.Integer molestie, arcu non porta sollicitudin, arcu felis aliquam urna, placerat maximus lorem urna commodo sem. Pellentesque venenatis leo quam, sed mattis sapien lobortis ut.placerat maximus lorem urna commodo sem</p>
                                        <a class="btn bg-secondary text-light btn-lg lift" href="http://pixelwibes.com/" target="_blank">Free Inquire</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-4 col-xl-5 col-xxl-5">
                        <div class="alert alert-primary p-3 mb-0 w-100">
                            <h6 class="fw-bold mb-1">Create Project Credentials</h6>
                            <p class="small mb-4">Create a Project credentials now and never miss</p>
                            <div class="my-3 ">
                                <input type="text" class="form-control form-control-lg" placeholder="Enter Username">
                            </div>
                            <div class="my-3">
                                <input type="password" class="form-control form-control-lg" placeholder="Enter Password">
                            </div>
                            <div class="my-3">
                                <input type="password" class="form-control form-control-lg" placeholder="Confirm Password">
                            </div>
                            <button class="btn btn-primary mt-2">Create Credentials</button>
                        </div>
                    </div>
                </div><!-- Row End -->
                <div class="row g-3 mb-3 row-deck">
                    <div class="col-md-12 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                               <h6 class="mb-3 fw-bold ">Income Analytics</h6>
                                <div class="d-flex justify-content-end text-center">
                                    <div class="p-2">
                                        <h6 class="mb-0 fw-bold">$5,318</h6>
                                        <small class="text-muted">Income</small>
                                    </div>
                                    <div class="p-2 ms-4">
                                        <h6 class="mb-0 fw-bold">$2,840</h6>
                                        <small class="text-muted">Expense</small>
                                    </div>
                                </div>
                                <div class="mt-3" id="incomeanalytics"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-8">
                        <div class="card">
                            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                <div class="info-header">
                                    <h6 class="mb-0 fw-bold ">Project Timeline</h6>
                                </div>
                                <button class="btn btn-sm btn-link  dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                <ul class="dropdown-menu border-0 shadow dropdown-menu-end">
                                    <li><a class="dropdown-item py-2 rounded" href="#">Last 7 days</a></li>
                                    <li><a class="dropdown-item py-2 rounded" href="#">Last 30 days</a></li>
                                    <li><a class="dropdown-item py-2 rounded" href="#">Last 60 days</a></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div id="apex-timeline"></div>
                            </div>
                        </div>
                    </div>
                </div><!-- Row End -->
                <div class="row g-3 mb-3 row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-2 row-cols-xl-4 row-cols-xxl-4">
                    <div class="col">
                        <div class="card bg-primary">
                            <div class="card-body text-white d-flex align-items-center">
                                <i class="icofont-data fs-3"></i>
                                <div class="d-flex flex-column ms-3">
                                    <h6 class="mb-0">Total Projects</h6>
                                    <span class="text-white">550</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card bg-primary">
                            <div class="card-body text-white d-flex align-items-center">
                                <i class="icofont-chart-flow fs-3"></i>
                                <div class="d-flex flex-column ms-3">
                                    <h6 class="mb-0">Coming Projects</h6>
                                    <span class="text-white">210</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card bg-primary">
                            <div class="card-body text-white d-flex align-items-center">
                                <i class="icofont-chart-flow-2 fs-3"></i>
                                <div class="d-flex flex-column ms-3">
                                    <h6 class="mb-0">Progress Projects</h6>
                                    <span class="text-white">8456 Files</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card bg-primary">
                            <div class="card-body text-white d-flex align-items-center">
                                <i class="icofont-tasks fs-3"></i>
                                <div class="d-flex flex-column ms-3">
                                    <h6 class="mb-0">Finished Projects</h6>
                                    <span class="text-white">88 Files</span>
                                </div>
                            </div>
                        </div>
                    </div>             
                </div>
                <div class="row g-3 mb-3 row-deck">
                    <div class="col-md-12">
                        <div class="card mb-3">
                                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                    <div class="info-header">
                                        <h6 class="mb-0 fw-bold ">Project Information</h6>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Date Start</th>
                                                <th>Deadline</th>
                                                <th>Leader</th>
                                                <th>Completion</th>
                                                <th>Stage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><a href="projects.html">Social Geek Made</a></td>
                                                <td>10-01-2021</td>
                                                <td>4 Month</td>
                                                <td><img src="assets/images/xs/avatar1.jpg" alt="Avatar" class="avatar sm  rounded-circle me-2"><a href="#">Keith</a></td>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="92" aria-valuemin="0" aria-valuemax="100"  style="width: 78%;">78%</div>
                                                    </div>
                                                </td>
                                                <td><span class="badge bg-warning">MEDIUM</span></td>
                                            </tr>
                                            <tr>
                                                <td><a href="projects.html">Practice to Perfect</a></td>
                                                <td>12-02-2021</td>
                                                <td>1 Month</td>
                                                <td><img src="assets/images/xs/avatar2.jpg" alt="Avatar" class="avatar sm rounded-circle me-2"><a href="#">Colin</a></td>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar  bg-primary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;">80%</div>
                                                    </div>
                                                </td>
                                                <td><span class="badge bg-success">LOW</span></td>
                                            </tr>
                                            <tr>
                                                <td><a href="projects.html">Rhinestone</a></td>
                                                <td>18-02-2021</td>
                                                <td>2 Month</td>
                                                <td><img src="assets/images/xs/avatar3.jpg" alt="Avatar" class="avatar sm rounded-circle me-2"><a href="#">Adam</a></td>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar  bg-primary" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%;">90%</div>
                                                    </div>
                                                </td>
                                                <td><span class="badge bg-danger">HIGH</span></td>
                                            </tr>
                                            <tr>
                                                <td><a href="projects.html">Box of Crayons</a></td>
                                                <td>23-02-2021</td>
                                                <td>1 Month</td>
                                                <td><img src="assets/images/xs/avatar4.jpg" alt="Avatar" class="avatar sm rounded-circle me-2"><a href="#">Peter</a></td>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar  bg-primary" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 85%;">85%</div>
                                                    </div>
                                                </td>
                                                <td><span class="badge bg-warning">MEDIUM</span></td>
                                            </tr>
                                            <tr>
                                                <td><a href="projects.html">Gob Geeklords</a></td>
                                                <td>16-03-2021</td>
                                                <td>10 Month</td>
                                                <td><img src="assets/images/xs/avatar5.jpg" alt="Avatar" class="avatar sm rounded-circle me-2"><a href="#">Evan</a></td>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar  bg-primary" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="width: 65%;">65%</div>
                                                    </div>
                                                </td>
                                                <td><span class="badge bg-success">LOW</span></td>
                                            </tr>
                                            <tr>
                                                <td><a href="projects.html">Java Dalia</a></td>
                                                <td>17-03-2021</td>
                                                <td>8 Month</td>
                                                <td><img src="assets/images/xs/avatar6.jpg" alt="Avatar" class="avatar sm rounded-circle me-2"><a href="#">Connor</a></td>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar  bg-primary" role="progressbar" aria-valuenow="48" aria-valuemin="0" aria-valuemax="100" style="width: 48%;">48%</div>
                                                    </div>
                                                </td>
                                                <td><span class="badge bg-secondary">MEDIUM</span></td>
                                            </tr>
                                            <tr>
                                                <td><a href="projects.html">Fast Cad</a></td>
                                                <td>14-04-2021</td>
                                                <td>2 Month</td>
                                                <td><img src="assets/images/xs/avatar7.jpg" alt="Avatar" class="avatar sm rounded-circle me-2"><a href="#">Benjamin</a></td>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar  bg-primary" role="progressbar" aria-valuenow="76" aria-valuemin="0" aria-valuemax="100" style="width: 76%;">76%</div>
                                                    </div>
                                                </td>
                                                <td><span class="badge bg-secondary">MEDIUM</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                    </div>
                </div><!-- Row End -->
            </div>             
        </div>

        <!-- Modal Members-->
        <div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="addUserLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title  fw-bold" id="addUserLabel">Employee Invitation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="inviteby_email">
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Email address" id="exampleInputEmail1" aria-describedby="exampleInputEmail1">
                            <button class="btn btn-dark" type="button" id="button-addon2">Sent</button>
                        </div>
                    </div>
                    <div class="members_list">
                        <h6 class="fw-bold ">Employee </h6>
                        <ul class="list-unstyled list-group list-group-custom list-group-flush mb-0">
                            <li class="list-group-item py-3 text-center text-md-start">
                                <div class="d-flex align-items-center flex-column flex-sm-column flex-md-column flex-lg-row">
                                    <div class="no-thumbnail mb-2 mb-md-0">
                                        <img class="avatar lg rounded-circle" src="assets/images/xs/avatar2.jpg" alt="">
                                    </div>
                                    <div class="flex-fill ms-3 text-truncate">
                                        <h6 class="mb-0  fw-bold">Rachel Carr(you)</h6>
                                        <span class="text-muted">rachel.carr@gmail.com</span>
                                    </div>
                                    <div class="members-action">
                                        <span class="members-role ">Admin</span>
                                        <div class="btn-group">
                                            <button type="button" class="btn bg-transparent dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="icofont-ui-settings  fs-6"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                              <li><a class="dropdown-item" href="#"><i class="icofont-ui-password fs-6 me-2"></i>ResetPassword</a></li>
                                              <li><a class="dropdown-item" href="#"><i class="icofont-chart-line fs-6 me-2"></i>ActivityReport</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item py-3 text-center text-md-start">
                                <div class="d-flex align-items-center flex-column flex-sm-column flex-md-column flex-lg-row">
                                    <div class="no-thumbnail mb-2 mb-md-0">
                                        <img class="avatar lg rounded-circle" src="assets/images/xs/avatar3.jpg" alt="">
                                    </div>
                                    <div class="flex-fill ms-3 text-truncate">
                                        <h6 class="mb-0  fw-bold">Lucas Baker<a href="#" class="link-secondary ms-2">(Resend invitation)</a></h6>
                                        <span class="text-muted">lucas.baker@gmail.com</span>
                                    </div>
                                    <div class="members-action">
                                        <div class="btn-group">
                                            <button type="button" class="btn bg-transparent dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                Members
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                              <li>
                                                  <a class="dropdown-item" href="#">
                                                    <i class="icofont-check-circled"></i>
                                                      
                                                    <span>All operations permission</span>
                                                   </a>
                                                   
                                                </li>
                                                <li>
                                                     <a class="dropdown-item" href="#">
                                                        <i class="fs-6 p-2 me-1"></i>
                                                           <span>Only Invite & manage team</span>
                                                       </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="btn-group">
                                            <button type="button" class="btn bg-transparent dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="icofont-ui-settings  fs-6"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                              <li><a class="dropdown-item" href="#"><i class="icofont-delete-alt fs-6 me-2"></i>Delete Member</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item py-3 text-center text-md-start">
                                <div class="d-flex align-items-center flex-column flex-sm-column flex-md-column flex-lg-row">
                                    <div class="no-thumbnail mb-2 mb-md-0">
                                        <img class="avatar lg rounded-circle" src="assets/images/xs/avatar8.jpg" alt="">
                                    </div>
                                    <div class="flex-fill ms-3 text-truncate">
                                        <h6 class="mb-0  fw-bold">Una Coleman</h6>
                                        <span class="text-muted">una.coleman@gmail.com</span>
                                    </div>
                                    <div class="members-action">
                                        <div class="btn-group">
                                            <button type="button" class="btn bg-transparent dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                Members
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                              <li>
                                                  <a class="dropdown-item" href="#">
                                                    <i class="icofont-check-circled"></i>
                                                      
                                                    <span>All operations permission</span>
                                                   </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="#">
                                                        <i class="fs-6 p-2 me-1"></i>
                                                           <span>Only Invite & manage team</span>
                                                       </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="btn-group">
                                            <div class="btn-group">
                                                <button type="button" class="btn bg-transparent dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="icofont-ui-settings  fs-6"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                  <li><a class="dropdown-item" href="#"><i class="icofont-ui-password fs-6 me-2"></i>ResetPassword</a></li>
                                                  <li><a class="dropdown-item" href="#"><i class="icofont-chart-line fs-6 me-2"></i>ActivityReport</a></li>
                                                  <li><a class="dropdown-item" href="#"><i class="icofont-delete-alt fs-6 me-2"></i>Suspend member</a></li>
                                                  <li><a class="dropdown-item" href="#"><i class="icofont-not-allowed fs-6 me-2"></i>Delete Member</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

<!-- Jquery Core Js -->
<script src="assets/bundles/libscripts.bundle.js"></script>

<!-- Plugin Js-->
<script src="assets/bundles/apexcharts.bundle.js"></script>
<script src="assets/bundles/dataTables.bundle.js"></script>

<!-- Jquery Page Js -->
<script src="../js/template.js"></script>
<script src="../js/page/index.js"></script>

</body>
</html> 