<?php
/* TITLE BAR SCRIPT */
$_SESSION['title'] = "Vessel Information Log";
if (!empty($action)) {
    if ($action == "update") {
        $_SESSION['title'] .= " - " . ucfirst($action) . " " . "Data";
    }
    if ($action == "viewprofile") {
        $_SESSION['title'] = "Profile";
    }
    if ($action == "add_vessel") {
        $_SESSION['title'] .= " - New Vessel";
    }
    if ($action == "view_vessel") {
        $_SESSION['title'] .= " - View Vessels ";
    }
    if ($action == "update_vessel") {
        $_SESSION['title'] .= " - Update Vessel Details ";
    }
    if ($action == "add_transaction") {
        $_SESSION['title'] = "New Vessel Transaction";
    }
    if ($action == "view_users") {
        $_SESSION['title'] .= " - View Users";
    }
    if ($action == "add_user") {
        $_SESSION['title'] .= " - New User";
    }
    if ($action == "update_user") {
        $_SESSION['title'] .= " - Update User";
    }
    if ($action == "reset_password" || $action == "new_password") {
        $_SESSION['title'] .= " - Reset User Password";
    }
    if ($action == "reset_signature" || $action == "new_signature") {
        $_SESSION['title'] .= " - Reset User Signature";
    }
    if ($action == "report") {
        $_SESSION['title'] .= " - Generate Report";
    }
}
if (!empty($typeofport)) {
    if ($typeofport == "privateports") {
        $port_type = "Private Ports";
    } else if ($typeofport == "baseport") {
        $port_type = "baseport";
    }
    $_SESSION['title'] .= " - " . ucfirst($port_type);
}
if (!empty($_GET['status'])) {
    $status = $_GET['status'];
}
/*if(http_response_code(404)){
    $_SESSION['title'] .= " - Error 404 : Page Not Found";
}*/
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php
                        if (!empty($_SESSION['title'])) {
                            $title = $_SESSION['title'];
                            echo $title;
                        }
                        ?>
                    </h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
        <hr>
    </section>
    <section class="content">
        <div class="container-fluid">