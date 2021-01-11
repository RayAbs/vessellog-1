<?php
/* USER CONTENT SOURCE CODE */
foreach ($data as $row) {
    $firstname = $row->fname;
    $middlename = $row->mname;
    $lastname = $row->lname;
    $company_id = $row->company_id;
    $signature = $row->signature;
    $username = $row->username;
}
if (!empty($_GET['active'])) {
    $active = $_GET['active'];
}
?>
<div class="row">
    <div class="col-md-3">
        <!-- Profile Image -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                         src="<?php echo base_url(); ?>assets/images/userpics/<?php echo $this->session->userdata('pp'); ?>"
                         alt="User profile picture">
                </div>
                <h3 class="profile-username text-center"><?php echo $this->session->userdata('nameofuser'); ?></h3>
                <p class="text-muted text-center"><?php
                    if ($this->session->userdata('usertype') == "hoo") {
                        echo "Harbor Operations Officer";
                    } else if ($this->session->userdata('usertype') == "administrator") {
                        echo "Administrator";
                    }
                    ?>
                </p>
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>
                            <?php
                            if ($this->session->userdata('usertype') == "hoo" || $this->session->userdata('usertype') == "administrator") {
                                echo "Philippine Ports Authority - Port Management Office of Misamis Oriental Cagayan de Oro";
                            }
                            ?>
                        </b>
                    </li>
                </ul>
                <!-- Signature Value !-->
                <ul class="list-group">
                    <li class="list-group-item mb-5">
                    <center><img src="<?php echo base_url(); ?>assets/images/signatures/ppa/<?php echo $signature; ?>" alt="Signature" width="250" height="100"></center>
                    </li>
                </ul>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link <?php
                        if ($active == "info") {
                            echo "active";
                        }
                        ?>" href="<?php echo base_url(); ?>profile/?action=viewprofile&active=info">General Information</a></li>
                    <li class="nav-item"><a class="nav-link <?php
                        if ($active == "password") {
                            echo "active";
                        }
                        ?>" href="<?php echo base_url(); ?>profile/?action=viewprofile&active=password">Change Password</a></li>
                    <li class="nav-item"><a class="nav-link <?php
                        if ($active == "pp") {
                            echo "active";
                        }
                        ?>" href="<?php echo base_url(); ?>profile/?action=viewprofile&active=pp">Upload Profile Picture</a></li>
                    <li class="nav-item"><a class="nav-link <?php
                        if ($active == "signature") {
                            echo "active";
                        }
                        ?>" href="<?php echo base_url(); ?>profile/?action=viewprofile&active=signature">Upload Signature</a></li>
                </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <?php if (!empty($this->session->flashdata("error"))) { ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error !</strong> <?php echo $this->session->flashdata("error") ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php } else if (!empty($this->session->flashdata("success"))) { ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Congrats !</strong> <?php echo $this->session->flashdata("success") ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php } ?>
                    <!-- General Information -->
                    <div class="tab-pane <?php
                    if ($active == "info") {
                        echo "active";
                    }
                    ?>" id="info">
                        <form class="form-horizontal" action="<?php echo base_url(); ?>profile/update_user" method="post" autocomplete="off">
                            
                            <!-- Username Value !-->
                            <div class="form-group row">
                                <label for="username" class="col-sm-2 col-form-label">Username : </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?php echo $username; ?>" required>
                                </div>
                            </div>
                            <!-- First Name Value !-->
                            <div class="form-group row">
                                <label for="firstname" class="col-sm-2 col-form-label">First Name : </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" value="<?php echo $firstname; ?>" required>
                                </div>
                            </div>
                            <!-- Middle Name Value !-->
                            <div class="form-group row">
                                <label for="middlename" class="col-sm-2 col-form-label">Middle Name : </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="middlename" name="middlename" placeholder="Middle Name" value="<?php echo $middlename; ?>" required>
                                </div>
                            </div>
                            <!-- Last Name Value !-->
                            <div class="form-group row">
                                <label for="lastname" class="col-sm-2 col-form-label">Last Name : </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" value="<?php echo $lastname; ?>" required>
                                </div>
                            </div>
                             <!-- Company ID Value !-->
                            <div class="form-group row">
                                <label for="companyid" class="col-sm-2 col-form-label"><?php
                                    if ($_SESSION['usertype'] == "hoo" || $_SESSION['usertype'] == "administrator") {
                                        echo "Agency";
                                    } else if ($_SESSION['usertype'] == "client") {
                                        echo "Company";
                                    }
                                    ?> ID Number : </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="company_id" name="company_id" placeholder="Company/Agency ID No." value="<?php echo $company_id; ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Change Password -->
                    <div class="tab-pane <?php
                    if ($active == "password") {
                        echo "active";
                    }
                    ?>" id="password">
                        <form class="form-horizontal" action="<?php echo base_url(); ?>profile/update_password" method="post" autocomplete="off">
                            <div class="form-group row">
                                <label for="password" class="col-sm-2 col-form-label">New Password : </label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="confirmpassword" class="col-sm-2 col-form-label">Confirm Password : </label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Upload Profile Picture -->
                    <div class="tab-pane <?php
                    if ($active == "pp") {
                        echo "active";
                    }
                    ?>" id="pp">
                        <form class="form-horizontal" action="<?php echo base_url(); ?>profile/update_profilepic" method="post" enctype="multipart/form-data" autocomplete="off">
                            <div class="form-group">
                                <label for="uploadprofilepic">Upload Profile Picture : </label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="profilepic" name="profilepic" required accept="image/*">
                                        <label class="custom-file-label" for="profilepic">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-success">Upload</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Upload Signature !-->
                    <div class="tab-pane <?php
                    if ($active == "signature") {
                        echo "active";
                    }
                    ?>" id="sign">

                        <form class="form-horizontal" action="<?php echo base_url(); ?>profile/update_signature" method="post" enctype="multipart/form-data" autocomplete="off">
                            <div class="form-group">
                                <label for="uploadsignature">Upload Signature : </label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="signature" name="signature" required accept="image/*">
                                        <label class="custom-file-label" for="signature">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-success">Upload</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>  
            </div>
        </div>
    </div>