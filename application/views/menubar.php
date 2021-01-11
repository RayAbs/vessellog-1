<!-- MENUBAR VIEW !-->
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- SEARCH FORM -->
            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-danger navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> 4 new messages
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-file mr-2"></i> 3 new reports
                        <span class="float-right text-muted text-sm">2 days</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-user"></i>
                </a>    
                <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                    <a href="<?php echo base_url(); ?>profile?action=viewprofile&active=info" class="dropdown-item"><span>View Profile</span></a>
                    <a href="<?php echo base_url(); ?>profile?action=viewprofile&active=password" class="dropdown-item"><span>Change Password</span></a>
                    <div class="dropdown-divider"></div>
                    <a href="<?php echo base_url(); ?>login/logout" class="dropdown-item"><span>Logout</span></a>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="<?php echo base_url(); ?>home" class="brand-link">
            <img src="<?php echo base_url(); ?>assets/images/logos/ppalogo.png"
                 alt="AdminLTE Logo"
                 class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">Vessel Log System</span>
        </a>
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="<?php echo base_url(); ?>assets/images/userpics/<?php echo $this->session->userdata('pp'); ?>" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="<?php echo base_url(); ?>profile?action=viewprofile&active=info" class="d-block"><?php echo $this->session->userdata('nameofuser'); ?></a>
                </div>
            </div>
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <?php if (!empty($_SESSION['usertype'] == "administrator") || !empty($_SESSION['usertype'] == "hoo")) { ?>
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>home/view_transaction/?typeofport=baseport&action=view_transaction" class="nav-link">
                                <i class="nav-icon fas fa-ship"></i>
                                <p>
                                    Vessel Log
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-pencil-alt"></i>
                                <p>
                                    Vessel Details
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo base_url(); ?>home/add_vessel/?action=add_vessel" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>New Vessel</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url(); ?>home/view_vessels/?action=view_vessel" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View Vessels</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-chart-bar"></i>
                                <p>
                                    Reportorial
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo base_url(); ?>home/view_report/?typeofport=baseport&action=report&report_class=standard" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Vessel Log</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url(); ?>home/view_report/?typeofport=baseport&action=report&report_class=internal" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Internal Report</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <?php
                    }
                    if (!empty($_SESSION['usertype'] == "administrator")) {
                        ?>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-user"></i>
                                <p>
                                    Users
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo base_url(); ?>profile/add_user/?action=add_user" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>New User</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url(); ?>profile/view_users/?action=view_users" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View Users</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url(); ?>profile/view_users/?action=reset_password" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Reset Password</p>
                                    </a>
                                </li>
                                 <li class="nav-item">
                                    <a href="<?php echo base_url(); ?>profile/view_users/?action=reset_signature" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Reset Signature</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Delete User</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php } ?>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
