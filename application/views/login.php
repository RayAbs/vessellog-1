<?php require_once 'header.php' ?>

<div class="login-page">
    <div class="login-box">
        <div class="card">
            <div class="card-body login-card-body">
                <center><img class="mb-4" src="<?php echo base_url(); ?>assets/images/logos/ppanewlogo.png" alt="" width="200" height="200"></center>    <!-- /.login-logo -->
                <center><h1 class="h3 font-weight-normal text-dark">Vessel Log System</h1></center><hr>
                <form action="<?php echo base_url(); ?>login/validation" method="post">
                    <div class="input-group mb-3">
                        <input type="text" name="username" class="form-control" placeholder="Username" required>

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3" id="show_hide_password">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fa fa-eye" title="Show/Hide Password"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <?php echo '<label class="text-danger">' . $this->session->flashdata("error") . '</label>'; ?>
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <div class="dropdown-divider"></div>
                    <p class="text-center text-muted">&copy; <?php echo "PPA PMO MO/C OPM " . date("Y"); ?></p>

                </form>
            </div>
            <!-- /.login-card-body -->

        </div>
        <a class="text-left" href="<?php echo base_url(); ?>assets/documents/PPA Privacy Statement.pdf" target="_blank" >&nbsp;<?php echo "PPA Privacy Statement "; ?></a>
    </div>
</div>
<!-- /.login-box -->
<!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- PRE-DEFINED SCRIPT -->
<script src="<?php echo base_url(); ?>assets/dist/js/login.js"></script>
