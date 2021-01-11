<a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Back to Top"><i class="fas fa-arrow-up"></i></a> 
<?php
/* CONTENT SOURCE CODE */
if (!empty($action)) {
    if (empty($action) || $action == "view_transaction" || $action == "report" || $action == "view_vessel") {
        $_SESSION['url'] = $_SERVER['REQUEST_URI'];
        $url = parse_url($_SESSION['url']);
        $trim_path = implode("/", array_slice(explode("/", $url['path']), 2));
        $trim_url = $trim_path . "?" . $url['query'];
        $_SESSION['trim_url'] = $trim_url;
    }
    if ($action == "add_transaction" || $action == "update_transaction" || $action == "update_vessel" || $action == "add_vessel" || $action == "add_user" || $action == "update_user" || $action == "new_password") {
        ?>
        <form id="<?php
        if ($action == "update_transaction") {
            echo "updatetransac";
        } else {
            echo "general_form";
        }
        ?>" action="<?php
              echo base_url();
              if ($action == "add_user" || $action == "update_user" || $action == "new_password") {
                  echo "profile/";
              } else {
                  echo "home/";
              }
              if ($action == "add_transaction") {
                  echo "add_transaction";
              } else if ($action == "update_transaction") {
                  echo "update_transaction";
              } else if ($action == "add_vessel") {
                  echo "add_vessel";
              } else if ($action == "update_vessel") {
                  echo "update_vessel";
              } else if ($action == "add_user") {
                  echo "add_user";
              } else if ($action == "update_user") {
                  echo "update_user";
              } else if ($action == "new_password") {
                  echo "reset_password";
              }
              ?>" method="post">
              <?php } ?>
        <div class="row">
            <?php
            if (!empty($status)) {
                if ($status == "success") {
                    ?>
                    <div class="col-md-12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong> Successfully <?php
                                if ($action == "update_vessel" || $action == "update_transaction") {
                                    echo "Updated";
                                } else if ($action == "add_vessel") {
                                    echo "Added";
                                } else if ($action == "add_user") {
                                    echo "Added User";
                                } else if ($action == "update_user" || $action == "new_password" || $action == "new_signature") {
                                    echo "Updated User";
                                }
                                ?> Data !
                                <?php
                                if ($action == "update_transaction") {
                                    if (!empty($_GET['id'])) {
                                        $id = $_GET['id'];
                                    }
                                    ?>
                                    <a href="<?php echo base_url(); ?>home/specific_transaction/?id=<?php echo $id; ?>&action=view_transaction&typeofport=<?php echo $typeofport; ?>">View Updated Data</a>
                                    <?php
                                }
                                ?>
                            </strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <?php
                } else if ($status == "error") {
                    ?>
                    <div class="col-md-12">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong> Error! <?php
                                if ($action == "add_vessel") {
                                    echo "Data Already Exists !";
                                } else if ($action == "add_vessel" || $action == "new_signature") {
                                    echo "Please recheck data !";
                                } else if ($action == "add_user") {
                                    echo "User already exists !";
                                }
                                ?> </strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <?php
                }
            }
            if ($action == "add_vessel") {
                ?>

                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">General Information</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- VESSEL CODE !-->
                            <div class="form-group">
                                <label for="vesselcode">Vessel Code : </label>
                                <input type="text" id="vesselcode" class="form-control" name="vesselcode" placeholder="Vessel Code" autofocus="true" required>
                            </div>
                            <!-- VOYAGE NUMBER !-->
                            <div class="form-group">
                                <label for="voyageno">Voyage Number : </label>
                                <input type="text" id="voyageno" class="form-control" name="voyageno" placeholder="Voyage Number" required>
                            </div>
                            <!-- VESSEL NAME !-->
                            <div class="form-group">
                                <label for="vesselname">Vessel Name : </label>
                                <input type="text" id="vesselname" class="form-control" name="vesselname" list="vesseloptions" placeholder="Vessel Name" required>  
                                <datalist id="vesseloptions">  
                                    <?php
                                    if (!empty($data)) {
                                        foreach ($data as $row) {
                                            ?>
                                            <option value="<?php echo $row->vesselname; ?>"><?php echo $row->vesselname; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </datalist> 
                            </div>
                            <!-- SHIP CALL NUMBER  !-->
                            <div class="form-group">
                                <label for="scn">Ship Call Number / SCN : </label>
                                <input type="text" id="scn" class="form-control" name="scn" placeholder="Ship Call Number (SCN)" required>
                            </div>
                        </div>  
                    </div>
                </div>
                <!-- PARTICULARS !-->
                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Particulars</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- GRT !-->
                            <div class="form-group">
                                <label for="grt">GT : </label>
                                <input type="text" id="grt" class="form-control" name="grt" placeholder="GT" required>
                            </div>
                            <!-- NRT !-->
                            <div class="form-group">
                                <label for="nrt">NRT : </label>
                                <input type="text" id="nrt" class="form-control" name="nrt" placeholder="NRT" required>
                            </div>
                            <!-- DWT !-->
                            <div class="form-group">
                                <label for="dwt">DWT : </label>
                                <input type="text" id="dwt" class="form-control" name="dwt" placeholder="DWT" required>
                            </div>
                            <!-- BEAM !-->
                            <div class="form-group">
                                <label for="beam">Beam : </label>
                                <input type="text" id="beam" class="form-control" name="beam" placeholder="Beam" required>
                            </div>
                            <!-- LOA !-->
                            <div class="form-group">
                                <label for="loa">LOA : </label>
                                <input type="text" id="loa" class="form-control" name="loa" placeholder="LOA" required>
                            </div>
                            <!-- DRAFT !-->
                            <div class="form-group">
                                <label for="draft">Draft : </label>
                                <input type="text" id="draft" class="form-control" name="draft" placeholder="Draft" required>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <?php
            } else if ($action == "update_vessel") {
                foreach ($data as $row) {
                    ?>
                    <!-- GENERAL INFORMATION !-->
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">General Information</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- VESSEL CODE !-->
                                <div class="form-group">
                                    <label for="updatevesselcode">Vessel Code : </label>
                                    <input type="text" id="updatevesselcode" class="form-control" name="vesselcode" value="<?php echo $row->vesselcode; ?>" required>
                                </div>
                                <!-- VOYAGE NUMBER !-->
                                <div class="form-group">
                                    <label for="voyageno">Voyage Number : </label>
                                    <input type="text" id="updatevoyageno" class="form-control" name="voyageno" value="<?php echo $row->voyageno; ?>" required>
                                </div>
                                <!-- VESSEL NAME !-->
                                <div class="form-group">
                                    <label for="vesselname">Vessel Name : </label>
                                    <input type="text" id="updatevesselname" class="form-control" name="vesselname" value="<?php echo $row->vesselname; ?>" required>
                                </div>
                                <!-- SHIP CALL NUMBER  !-->
                                <div class="form-group">
                                    <label for="scn">Ship Call Number / SCN : </label>
                                    <input type="text" id="updatescn" class="form-control" name="scn" value="<?php echo $row->scn; ?>" required>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                    <!-- PARTICULARS !-->
                    <div class="col-md-6">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Particulars</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- GRT !-->
                                <div class="form-group">
                                    <label for="grt">GT : </label>
                                    <input type="number" id="updategrt" class="form-control" name="grt" value="<?php echo $row->grt; ?>" required>
                                </div>
                                <!-- NRT !-->
                                <div class="form-group">
                                    <label for="nrt">NRT : </label>
                                    <input type="number" id="updatenrt" class="form-control" name="nrt" value="<?php echo $row->nrt; ?>" required>
                                </div>
                                <!-- DWT !-->
                                <div class="form-group">
                                    <label for="dwt">DWT : </label>
                                    <input type="number" id="updatedwt" class="form-control" name="dwt" value="<?php echo $row->dwt; ?>" required>
                                </div>
                                <!-- BEAM !-->
                                <div class="form-group">
                                    <label for="beam">Beam : </label>
                                    <input type="text" id="updatebeam" class="form-control" name="beam" value="<?php echo $row->beam; ?>" required>
                                </div>
                                <!-- LOA !-->
                                <div class="form-group">
                                    <label for="loa">LOA : </label>
                                    <input type="text" id="updateloa" class="form-control" name="loa" value="<?php echo $row->loa; ?>" required>
                                </div>
                                <!-- DRAFT !-->
                                <div class="form-group">
                                    <label for="updatedraft">Draft : </label>
                                    <input type="text" id="updatedraft" class="form-control" name="draft" value="<?php echo $row->draft; ?>" required>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <?php
                }
            } else
            if ($action == "add_transaction") {
                /* GENERATING THE TRANSACTION ID */
                if (!empty($data)) {
                    foreach ($data as $row) {
                        $counter = $row->id + 1;
                        $newnum = str_pad($counter, 3, '0', STR_PAD_LEFT);
                        $transaction_id = $newnum . "-" . date("m") . date("d") . date("Y");
                    }
                } else {
                    $counter = 1;
                    $newnum = str_pad($counter, 3, '0', STR_PAD_LEFT);
                    $transaction_id = $newnum . "-" . date("m") . date("d") . date("Y");
                }
                ?>

                <!-- GENERAL INFORMATION - VESSEL !-->
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">General Information - Vessel</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- TRANSACTION ID !-->
                            <div class="form-group">
                                <label for="transactionid">Transaction ID : </label>
                                <input type="text" id="transaction_id" class="form-control" name="transaction_id" value="<?php echo $transaction_id; ?>" readonly required>
                            </div>
                            <!-- TRANSACTION DATE !-->
                            <div class="form-group">
                                <label for="transaction_date">Transaction Date : </label>
                                <input type="date" id="transaction_date" class="form-control" name="transaction_date" required>
                            </div>
                            <!-- SHIP CALL NUMBER  !-->
                            <div class="form-group">
                                <label for="scn">Ship Call Number : </label>
                                <input type="number" id="scn" class="form-control" name="scn" required>
                            </div>
                            <!-- VOYAGE NUMBER !-->
                            <div class="form-group">
                                <label for="voyageno">Voyage Number : </label>
                                <input type="number" id="voyageno" class="form-control" name="voyageno" required>
                            </div>
                            <!-- VESSEL NAME !-->
                            <div class="form-group">
                                <label for="vesselname">Vessel Name : </label>
                                <input type="text" id="vesselname" class="form-control" name="vesselname" required>
                            </div>
                            <!-- BERTH ASSIGNMENT !-->
                            <div class="form-group">
                                <label for="berthassignment">Berth Assignment : </label>
                                <input type="number" id="berth_assignment" class="form-control" name="berth_assignment" required>
                            </div>

                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- PARTICULARS !-->
                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Particulars</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- GRT !-->
                            <div class="form-group">
                                <label for="grt">GRT : </label>
                                <input type="number" id="grt" class="form-control" name="grt" placeholder="GRT" required>
                            </div>
                            <!-- NRT !-->
                            <div class="form-group">
                                <label for="nrt">NRT : </label>
                                <input type="number" id="nrt" class="form-control" name="nrt" placeholder="NRT" required>
                            </div>
                            <!-- DWT !-->
                            <div class="form-group">
                                <label for="dwt">DWT : </label>
                                <input type="number" id="dwt" class="form-control" name="dwt" placeholder="DWT" required>
                            </div>
                            <!-- BEAM !-->
                            <div class="form-group">
                                <label for="beam">Beam : </label>
                                <input type="text" id="beam" class="form-control" name="beam" placeholder="Beam" required>
                            </div>
                            <!-- LOA !-->
                            <div class="form-group">
                                <label for="loa">LOA : </label>
                                <input type="number" id="loa" class="form-control" name="loa" placeholder="LOA" required>
                            </div>
                            <!-- DRAFT !-->
                            <div class="form-group">
                                <label for="draft">DRAFT : </label>
                                <input type="number" id="draft" class="form-control" name="draft" placeholder="DRAFT" required>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- ANCHORAGE !-->
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Anchorage</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- ANCHORAGE - ETA !-->
                            <div class="form-group">
                                <label for="anchor_eta">ETA - Estimated Date & Time of Arrival : </label>
                                <input type="datetime-local" id="anchor_eta" class="form-control" name="anchor_eta">
                            </div>
                            <!-- ANCHORAGE -  : ATA !-->
                            <div class="form-group">
                                <label for="anchor_ata">ATA - Actual Date & Time of Arrival : </label>
                                <input type="datetime-local" id="anchor_ata" class="form-control" name="anchor_ata">
                            </div>
                            <!-- ANCHORAGE - ETD !-->
                            <div class="form-group">
                                <label for="anchor_etd">ETD - Estimated Date & Time of Departure : </label>
                                <input type="datetime-local" id="anchor_etd" class="form-control" name="anchor_etd">
                            </div>
                            <!-- ANCHORAGE - ATD !-->
                            <div class="form-group">
                                <label for="anchor_atd">ATD - Actual Date & Time of Departure : </label>
                                <input type="datetime-local" id="anchor_atd" class="form-control" name="anchor_atd">
                            </div>
                        </div>                        
                    </div>
                </div>
                <!-- BERTH !-->
                <div class="col-md-6">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Berth</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- BERTH - ETA !-->
                            <div class="form-group">
                                <label for="berth_eta">ETA - Estimated Date & Time of Arrival : </label>
                                <input type="datetime-local" id="berth_eta" class="form-control" name="berth_eta" required>
                            </div>
                            <!-- BERTH - ATA !-->
                            <div class="form-group">
                                <label for="berth_ata">ATA - Actual Date & Time of Arrival : </label>
                                <input type="datetime-local" id="berth_ata" class="form-control" name="berth_ata">
                            </div>
                            <!-- BERTH - ETD !-->
                            <div class="form-group">
                                <label for="berth_etd">ETD - Estimated Date & Time of Departure : </label>
                                <input type="datetime-local" id="berth_etd" class="form-control" name="berth_etd">
                            </div>
                            <!-- BERTH - ATD !-->
                            <div class="form-group">
                                <label for="berth_atd">ATD - Actual Date & Time of Departure : </label>
                                <input type="datetime-local" id="berth_atd" class="form-control" name="berth_atd">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- PORT OF CALL !-->
                <div class="col-md-6">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Port of Call</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- LAST PORT !-->
                            <div class="form-group">
                                <label for="lastport">Last Port : </label>
                                <input type="text" id="lastport" class="form-control" name="lastport" required>
                            </div>
                            <!-- NEXT PORT !-->
                            <div class="form-group">
                                <label for="nextport">Next Port : </label>
                                <input type="text" id="nextport" class="form-control" name="nextport" required>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- PASSENGERS !-->
                <div class="col-md-6">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Passengers</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- PASSENGERS : IN  !-->
                            <div class="form-group">
                                <label for="passengerin">In : </label>
                                <input type="text" id="passengerin" class="form-control" name="passengerin" required>
                            </div>
                            <!-- PASSENGERS : OUT !-->
                            <div class="form-group">
                                <label for="passengerout">Out : </label>
                                <input type="text" id="passengerout" class="form-control" name="passengerout" required>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  PAYMENT !-->
                <div class="col-md-6">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Payment</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- ORIGINAL RECEIPT NUMBER !-->
                            <div class="form-group">
                                <label for="ornum">Original Receipt (OR) Number : </label>
                                <input type="text" id="ornum" class="form-control" name="ornum" required>
                            </div>
                            <!-- PAYMENT !-->
                            <div class="form-group">
                                <label for="payment">Amount Paid : </label>
                                <input type="text" id="payment" class="form-control" name="payment" required>
                            </div>
                            <!-- APPROVED / ATTACH HARBOR OPERATIONS OFFICER SIGNATURE !-->
                            <div class="form-group">
                                <label for="approvedoption">Approval : </label>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" id="approvedoption" class="form-check-input" name="approvedoption" value="Yes" required>Approved
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" id="approvedoption" class="form-check-input" name="approvedoption" value="No" required>Disapproved
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
                <!--  ADDITIONAL STAY !-->
                <div class="col-md-6">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Additional Stay</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- ADDITIONAL STAY : NUMBER OF DAYS !-->
                            <div class="form-group">
                                <label for="addnumstay">Additional Stay/Number of days : </label>
                                <input type="number" id="addnumstay" class="form-control" name="addnumstay">
                            </div>
                            <!-- ADDITIONAL STAY : ORIGINAL RECEIPT NUMBER!-->
                            <div class="form-group">
                                <label for="ornumaddstay">Original Receipt (OR) Number :  </label>
                                <input type="text" id="ornumaddstay" class="form-control" name="ornumaddstay" >
                            </div>
                            <!-- ADDITIONAL STAY : PAYMENT !-->
                            <div class="form-group">
                                <label for="paymentaddstay">Amount Paid :  </label>
                                <input type="text" id="paymentaddstay" class="form-control" name="paymentaddstay">
                            </div>
                            <!-- APPROVED / ATTACH HARBOR OPERATIONS OFFICER SIGNATURE !-->
                            <div class="form-group">
                                <label for="addapprovedoption">Approval : </label>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" id="addapprovedoption" class="form-check-input" name="addapprovedoption" value="Yes">Approved
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" id="addapprovedoption" class="form-check-input" name="addapprovedoption" value="No">Disapproved
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            /* DISPLAY ALL DATA FROM VESSEL TRANSACTION DATABASE */ else if ($action == "view_transaction") {
                ?>
                <div class="card">
                    <div class="card-body">
                        <div class="card card-primary card-tabs">
                            <div class="card-header p-0 pt-1">
                                <!-- MENUBAR FOR BASEPORT OR PRIVATE PORTS !-->
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link <?php
                                        if (!empty($active)) {
                                            if ($active == "baseport") {
                                                echo "active";
                                            }
                                        }
                                        ?>" href="<?php echo base_url() ?>home/view_transaction?typeofport=baseport&action=<?php echo $action; ?>">Baseport</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link <?php
                                        if (!empty($active)) {
                                            if ($active == "privateports") {
                                                echo "active";
                                            }
                                        }
                                        ?>" href="<?php echo base_url() ?>home/view_transaction?typeofport=privateports&action=<?php echo $action; ?>">Private Ports</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- SORT / FILTER DATA BASED ON THE TYPE OF MOVEMENT AND ARRIVAL/DEPARTURE DETAILS !-->
                        <form id="movement_search" class="form-inline" action="<?php echo base_url(); ?>home/display_date?typeofport=<?php echo $typeofport; ?>&action=<?php echo $action; ?>" method="post">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><b>Type of Movement :</b></span>
                                </div>
                                <select class="form-control" id="typeofmovement" name="typeofmovement" required>
                                    <option value="" selected disabled>Choose Type of Movement:</option>
                                    <option value="anchorage" <?php
                                    if (!empty($typeofmovement)) {
                                        if ($typeofmovement == "anchorage") {
                                            echo "selected";
                                        }
                                    }
                                    ?>>Anchorage</option>
                                    <option value="berth" <?php
                                    if (!empty($typeofmovement)) {
                                        if ($typeofmovement == "berth") {
                                            echo "selected";
                                        }
                                    }
                                    ?>>Berth
                                    </option>
                                </select>
                            </div>
                            <!-- ATA INPUT !-->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><b>ATA : </b></span>
                                </div>
                                <input type="date" class="form-control" id="ata" name="ata">&nbsp;
                            </div>
                            <div class="<?php
                            if (!empty($typeofmovement)) {
                                if ($typeofmovement == "berth") {
                                    echo "berth_div";
                                } else {
                                    echo "etd_div";
                                }
                            } else {
                                echo "etd_div";
                            }
                            ?>">
                                <!-- ETD INPUT !-->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><b>ETD : </b></span>
                                    </div>
                                    <input type="date" class="form-control" id="etd" name="etd">&nbsp;
                                </div>
                            </div>
                            <!-- ATD INPUT !-->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><b>ATD : </b></span>
                                </div>
                                <input type="date" class="form-control" id="atd" name="atd">&nbsp;
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <button type="submit" id="movbtn" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-sm-auto">
                                <form class="form-inline" action="<?php echo base_url(); ?>home/display_transacdate?typeofport=<?php echo $typeofport; ?>&action=<?php echo $action; ?>" method="post">
                                    <!-- TRANSACTION DATE INPUT !-->
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><b>Transaction Date :</b></span>
                                        </div>
                                        <input type="date" class="form-control" id="transaction_date" name="transaction_date" required>
                                        <div class="input-group-append">
                                            <button type="submit" id="transactbtn" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>&nbsp;

                                </form>
                            </div>
                            <div class="col-sm-auto">
                                <form class="form-inline" action="<?php echo base_url(); ?>home/display_transacdate?typeofport=<?php echo $typeofport; ?>&action=<?php echo $action; ?>" method="post">
                                    <!-- STATUS INPUT !-->
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><b>Status :</b></span>
                                        </div>
                                        <select class="form-control" id="status" name="status" autofocus="true" required>
                                            <option value="" selected disabled>Choose Status</option>
                                            <option value="pending" <?php
                                            if (!empty($status)) {
                                                if ($status == "pending") {
                                                    echo "selected";
                                                }
                                            }
                                            ?>>Pending</option>
                                            <option value="done" <?php
                                            if (!empty($status)) {
                                                if ($status == "done") {
                                                    echo "selected";
                                                }
                                            }
                                            ?>>Cleared</option>
                                        </select>
                                        <div class="input-group-append">
                                            <button type="submit" id="statusbtn" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>


                        <?php
                        if (!empty($typeofmovement) || !empty($transaction_date) || !empty($status)) {
                            $message = "Showing results of Vessels ";
                        }
                        if (!empty($typeofmovement)) {
                            $message .= "at " . ucfirst($typeofmovement);
                            if (!empty($ata)) {
                                $message .= " with Actual Date & Time of Arrival (ATA) - " . date("F d, Y", strtotime($ata));
                            } else if (!empty($etd)) {
                                $message .= " with Estimated & and Time of Departure (ETD) - " . date("F d, Y", strtotime($etd));
                            } else if (!empty($atd)) {
                                $message .= " with Actual Date & Time of Departure (ATD) - " . date("F d, Y", strtotime($atd));
                            }
                        } else if (!empty($transaction_date)) {
                            $message .= "with Transaction Date of " . date("F d, Y", strtotime($transaction_date));
                        } else if (!empty($status)) {
                            if ($status == "done") {
                                $status = "cleared";
                            }
                            $message .= "with " . "<i>" . strtoupper($status) . "</i>" . " Status";
                        }
                        if (!empty($typeofmovement) || !empty($transaction_date) || !empty($status)) {
                            echo "<h4><b>" . $message . "</b></h4><hr>";
                        }
                        ?>
                        <table id="vessel_table" class="table table-striped table-bordered table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <!-- ACTION HEADING !-->
                                    <th class="text-center align-middle" rowspan="4">
                                        ACTION
                                    </th>
                                    <!-- STATUS HEADING !-->
                                    <th class="text-center align-middle" rowspan="4">
                                        STATUS
                                    </th>
                                    <!-- NUMBER SEQUENCE HEADING !-->
                                    <th class="text-center align-middle" rowspan="4">
                                        #
                                    </th>
                                    <!-- TRANSACTION DATE HEADING !-->
                                    <th class="text-center align-middle" rowspan="4">
                                        TRANSAC <br>DATE
                                    </th>
                                    <!-- TRANSACTION ID NUMBER HEADING !-->
                                    <th class="text-center align-middle" rowspan="4">
                                        TRANSAC <br> #
                                    </th>
                                    <!-- SHIP CALL NUMBER HEADING!-->
                                    <th class="text-center align-middle" rowspan="4">
                                        SCN
                                    </th>
                                    <!-- VESSEL NAME HEADING!-->
                                    <th class="text-center align-middle" rowspan="4">
                                        VESSEL <br>NAME
                                    </th>
                                    <!-- VOYAGE NUMBER HEADING!-->
                                    <th class="text-center align-middle" rowspan="4">
                                        VOY <br> NO.
                                    </th>
                                    <!-- ANCHORAGE HEADING!-->
                                    <th class="text-center align-middle table-primary" colspan="4">
                                        ANCHORAGE
                                    </th>
                                    <!-- BERTH HEADING!-->
                                    <th class="text-center align-middle table-danger" colspan="6">
                                        BERTH
                                    </th>
                                    <!-- BERTH ASSIGNMENT HEADING!-->
                                    <th class="text-center align-middle" rowspan="4">
                                        BERTH ASSIGNMENT
                                    </th>
                                    <!-- PARTICULARS HEADING!-->
                                    <th class="text-center align-middle" colspan="6" rowspan="3">
                                        PARTICULARS
                                    </th>
                                    <!-- PORT OF CALL HEADING!-->
                                    <th class="text-center align-middle" colspan="2" rowspan="3">
                                        PORT OF CALL
                                    </th>
                                    <!-- PASSENGERS HEADING!-->
                                    <th class="text-center align-middle" colspan="2" rowspan="3">
                                        PASSENGERS
                                    </th>
                                    <!-- O.R. #/AMT PAID HEADING!-->
                                    <th class="text-center align-middle" colspan="2" rowspan="3">
                                        O.R. #/AMT PAID 
                                    </th>
                                    <!-- NAME AND SIGNATURE HEADING!-->
                                    <th class="text-center align-middle" colspan="2" rowspan="3">
                                        NAME & SIGNATURE
                                    </th>
                                    <!-- ADDITIONAL STAY/# DAYS HEADING!-->
                                    <th class="text-center align-middle" rowspan="4">
                                        Additional Stay/# of Days
                                    </th>
                                    <!-- O.R. #/AMT PAID (For Additional Stay) HEADING!-->
                                    <th class="text-center align-middle" colspan="2" rowspan="3">
                                        O.R. #/AMT PAID (For Additional Stay)
                                    </th>
                                    <!--  NAME AND SIGNATURE (For Additional Stay) HEADING!-->
                                    <th class="text-center align-middle" colspan="2" rowspan="3">
                                        NAME & SIGNATURE
                                    </th>
                                </tr>
                                <tr>
                                    <th class="text-center align-middle" colspan="2">Arrival</th>
                                    <th class="text-center align-middle" colspan="2">Departure</th>
                                    <th class="text-center align-middle" colspan="2">Arrival</th>
                                    <th class="text-center align-middle" colspan="4">Departure</th>
                                </tr>
                                <tr>
                                    <th class="text-center align-middle" colspan="2">ATA</th>
                                    <th class="text-center align-middle" colspan="2">ATD</th>
                                    <th class="text-center align-middle" colspan="2">ATA</th>
                                    <th class="text-center align-middle" colspan="2">ETD</th>
                                    <th class="text-center align-middle" colspan="2">ATD</th>
                                </tr>
                                <tr>
                                    <th class="text-center align-middle">Date</th>
                                    <th class="text-center align-middle">Time</th>
                                    <th class="text-center align-middle">Date</th>
                                    <th class="text-center align-middle">Time</th>
                                    <th class="text-center align-middle">Date</th>
                                    <th class="text-center align-middle">Time</th>
                                    <th class="text-center align-middle">Date</th>
                                    <th class="text-center align-middle">Time</th>
                                    <th class="text-center align-middle">Date</th>
                                    <th class="text-center align-middle">Time</th>
                                    <th class="text-center align-middle">GT</th>
                                    <th class="text-center align-middle">NRT</th>
                                    <th class="text-center align-middle">DWT</th>
                                    <th class="text-center align-middle">Beam</th>
                                    <th class="text-center align-middle">LOA</th>
                                    <th class="text-center align-middle">Draft</th>
                                    <th class="text-center align-middle">Last</th>
                                    <th class="text-center align-middle">Next</th>
                                    <th class="text-center align-middle">IN</th>
                                    <th class="text-center align-middle">OUT</th>
                                    <th class="text-center align-middle">O.R. #</th>
                                    <th class="text-center align-middle">Amount Paid</th>
                                    <th class="text-center align-middle">Shipping Agent</th>
                                    <th class="text-center align-middle">PPA Personnel</th>
                                    <th class="text-center align-middle">O.R. #</th>
                                    <th class="text-center align-middle">Amount Paid</th>
                                    <th class="text-center align-middle">Shipping Agent</th>
                                    <th class="text-center align-middle">PPA Personnel</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                if (!empty($data)) {
                                    foreach ($data as $row) {
                                        $i++;
                                        ?>
                                        <tr>
                                            <!-- ACTION BUTTON !-->
                                            <td class="text-center align-middle">
                                                <a href="<?php echo base_url(); ?>home/specific_transaction/?id=<?php echo $row->id ?>&action=update_transaction&typeofport=<?php echo $typeofport; ?>">
                                                    <button class="btn btn-info" type="button" title="Edit Vessel">
                                                        <i class="fas fa-fw fa-pen"></i>
                                                    </button>
                                                </a>
                                            </td>
                                            <!-- STATUS !-->
                                            <td class="align-middle text-center <?php
                                            if (empty($row->status) || $row->status == "pending") {
                                                echo "noactioncell";
                                            } else if ($row->status == "done") {
                                                echo "donecell";
                                            }
                                            ?>">
                                                    <?php
                                                    if ($row->status == "done") {
                                                        echo "<b>CLEARED</b>";
                                                    } else {
                                                        echo "<b>" . strtoupper($row->status) . "</b>";
                                                    }
                                                    ?>
                                            </td>
                                            <!--  ID !-->
                                            <td class="align-middle text-center"><?php echo $i; ?></td>
                                            <!--  TRASACTION DATE !-->
                                            <td class="align-middle text-center"><?php echo date("m/d/Y", strtotime($row->transaction_date)); ?></td>
                                            <!--  TRASACTION ID !-->
                                            <td class="align-middle text-center"><?php echo $row->transaction_id; ?></td>
                                            <!--  SHIP CALL NUMBER !-->
                                            <td class="align-middle"><?php echo $row->scn; ?></td>
                                            <!--  VESSEL NAME !-->
                                            <td class="align-middle"><?php echo $row->vesselname; ?></td>
                                            <!--  VOYAGE NUMBER !-->
                                            <td class="align-middle"><?php echo $row->voyageno; ?></td>
                                            <!-- ANCHORAGE - ATA/DATE  !-->
                                            <td class="align-middle <?php
                                            if (!empty($typeofmovement) && !empty($ata)) {
                                                if ($typeofmovement == "anchorage") {
                                                    if ($ata == date("Y-m-d", strtotime($row->anchor_ata))) {
                                                        echo "highlight";
                                                    }
                                                }
                                            }
                                            ?>"><?php
                                                    if (!empty($row->anchor_ata)) {
                                                        echo date("m/d/Y", strtotime($row->anchor_ata));
                                                    }
                                                    ?>
                                            </td>
                                            <!-- ANCHORAGE - ATA/TIME  !-->
                                            <td class="align-middle"><?php
                                                if (!empty($row->anchor_ata)) {
                                                    //  echo date("h:i A", strtotime($row->anchor_ata));
                                                    echo date("H:i", strtotime($row->anchor_ata));
                                                }
                                                ?>
                                            </td>
                                            <!-- ANCHORAGE - ATD/DATE  !-->
                                            <td class="align-middle <?php
                                            if (!empty($typeofmovement) && !empty($atd)) {
                                                if ($typeofmovement == "anchorage") {
                                                    if ($atd == date("Y-m-d", strtotime($row->anchor_atd))) {
                                                        echo "highlight";
                                                    }
                                                }
                                            }
                                            ?>"><?php
                                                    if (!empty($row->anchor_atd)) {
                                                        echo date("m/d/Y", strtotime($row->anchor_atd));
                                                    }
                                                    ?>
                                            </td>
                                            <!-- ANCHORAGE - ATD/TIME  !-->
                                            <td class="align-middle"><?php
                                                if (!empty($row->anchor_atd)) {
                                                    //  echo date("h:i A", strtotime($row->anchor_atd));
                                                    echo date("H:i", strtotime($row->anchor_atd));
                                                }
                                                ?>
                                            </td>
                                            <!-- BERTH - ATA/DATE  !-->
                                            <td class="align-middle <?php
                                            if (!empty($typeofmovement) && !empty($ata)) {
                                                if ($typeofmovement == "berth") {
                                                    if ($ata == date("Y-m-d", strtotime($row->berth_ata))) {
                                                        echo "highlight";
                                                    }
                                                }
                                            }
                                            ?>"><?php
                                                    if (!empty($row->berth_ata)) {
                                                        echo date("m/d/Y", strtotime($row->berth_ata));
                                                    }
                                                    ?>
                                            </td>
                                            <!-- BERTH - ATA/TIME  !-->
                                            <td class="align-middle"><?php
                                                if (!empty($row->berth_ata)) {
                                                    //  echo date("h:i A", strtotime($row->anchor_ata));
                                                    echo date("H:i", strtotime($row->berth_ata));
                                                }
                                                ?>
                                            </td>
                                            <!-- BERTH - ETD/DATE  !-->
                                            <td class="align-middle <?php
                                            if (!empty($typeofmovement) && !empty($etd)) {
                                                if ($typeofmovement == "berth") {
                                                    if ($etd == date("Y-m-d", strtotime($row->berth_etd))) {
                                                        echo "highlight";
                                                    }
                                                }
                                            }
                                            ?>"><?php
                                                    if (!empty($row->berth_etd)) {
                                                        echo date("m/d/Y", strtotime($row->berth_etd));
                                                    }
                                                    ?>
                                            </td>
                                            <!-- BERTH - ETD/TIME  !-->
                                            <td class="align-middle"><?php
                                                if (!empty($row->berth_etd)) {
                                                    //  echo date("h:i A", strtotime($row->anchor_ata));
                                                    echo date("H:i", strtotime($row->berth_etd));
                                                }
                                                ?>
                                            </td>
                                            <!-- BERTH - ATD/DATE  !-->
                                            <td class="align-middle <?php
                                            if (!empty($typeofmovement) && !empty($atd)) {
                                                if ($typeofmovement == "berth") {
                                                    if ($atd == date("Y-m-d", strtotime($row->berth_atd))) {
                                                        echo "highlight";
                                                    }
                                                }
                                            }
                                            ?>"><?php
                                                    if (!empty($row->berth_atd)) {
                                                        echo date("m/d/Y", strtotime($row->berth_atd));
                                                    }
                                                    ?>
                                            </td>
                                            <!-- BERTH - ATD/TIME  !-->
                                            <td class="align-middle"><?php
                                                if (!empty($row->berth_atd)) {
                                                    //  echo date("h:i A", strtotime($row->anchor_ata));
                                                    echo date("H:i", strtotime($row->berth_atd));
                                                }
                                                ?>
                                            </td>
                                            <!-- BERTH ASSIGNMENT !-->
                                            <td class="text-center align-middle <?php
                                            if (empty($row->berth_assignment)) {
                                                echo "noactioncell";
                                            }
                                            ?>"><?php
                                                    if (!empty($row->berth_assignment)) {
                                                        echo $row->berth_assignment;
                                                    }
                                                    ?>
                                            </td>
                                            <!-- PARTICULARS : GRT !-->
                                            <td class="text-center align-middle"><?php echo $row->grt; ?></td>
                                            <!-- PARTICULARS : NRT !-->
                                            <td class="text-center align-middle"><?php echo $row->nrt; ?></td>
                                            <!-- PARTICULARS : DWT !-->
                                            <td class="text-center align-middle"><?php echo $row->dwt; ?></td>
                                            <!-- PARTICULARS : BEAM !-->
                                            <td class="text-center align-middle"><?php echo $row->beam; ?></td>
                                            <!-- PARTICULARS : LOA !-->
                                            <td class="text-center align-middle"><?php echo $row->loa; ?></td>
                                            <!-- PARTICULARS : DRAFT !-->
                                            <td class="text-center align-middle"><?php echo $row->draft; ?></td>
                                            <!-- PORT OF CALL : LAST PORT !-->
                                            <td class="text-center align-middle"><?php echo strtoupper($row->lastport); ?></td>
                                            <!-- PORT OF CALL : NEXT PORT !-->
                                            <td class="text-center align-middle"><?php echo strtoupper($row->nextport); ?></td>
                                            <!-- PASSENGERS IN !-->
                                            <td class="text-center align-middle"><?php echo strtoupper($row->passengerin); ?></td>
                                            <!-- PASSENGERS OUT !-->
                                            <td class="text-center align-middle"><?php echo strtoupper($row->passengerout); ?></td>
                                            <!-- ORIGINAL RECEIPT NUMBER !-->
                                            <td class="text-left align-middle <?php
                                            if (empty($row->ornum) && empty($row->payment)) {
                                                echo "noactioncell";
                                            }
                                            ?>">
                                                    <?php
                                                    if (!empty($row->ornum)) {
                                                        echo "<b>OR #</b>" . " " . strtoupper($row->ornum);
                                                    }
                                                    ?>
                                            </td>
                                            <!-- PAYMENT !-->
                                            <td class="text-left align-middle <?php
                                            if (empty($row->ornum) && empty($row->payment)) {
                                                echo "noactioncell";
                                            }
                                            ?>"><?php
                                                    if (!empty($row->payment)) {
                                                        echo "<b>&#x20B1;</b>" . " " . number_format($row->payment, 2);
                                                    }
                                                    ?>
                                            </td>
                                            <!-- SIGNATURE : SHIPPING AGENT  !-->
                                            <td class="text-center align-middle">
                                                <?php if (!empty($row->client_signature)) { ?>
                                                    <img src="<?php echo base_url(); ?>assets/images/signatures/client/<?php echo $row->client_signature; ?>" alt="Signature" width="150" height="50">
                                                    <br>
                                                <?php }
                                                ?>
                                            </td>
                                            <!-- SIGNATURE : PPA PERSONNEL  !-->
                                            <td class="text-center align-middle <?php
                                            if (!empty($row->ornum) && !empty($row->payment) && !empty($row->client_signature) && empty($row->ppa_signature)) {
                                                echo "noactioncell";
                                            }
                                            ?>">
                                                    <?php if (!empty($row->ppa_signature)) { ?>
                                                    <img src="<?php echo base_url(); ?>assets/images/signatures/ppa/<?php echo $row->ppa_signature; ?>" alt="Signature" width="150" height="50">
                                                <?php } ?>
                                            </td>
                                            <!-- ADDITIONAL STAY : NUMBER OF DAYS  !-->
                                            <td class="text-center align-middle">
                                                <?php
                                                echo $row->addnumstay;
                                                ?>
                                            </td>
                                            <!-- ORIGINAL RECEIPT NUMBER FOR ADDITIONAL STAY !-->
                                            <td class="text-left align-middle <?php
                                            if (!empty($row->addnumstay) && empty($row->ornum_addstay) && empty($row->payment_addstay)) {
                                                echo "noactioncell";
                                            }
                                            ?>"><?php
                                                    if (!empty($row->ornum_addstay)) {
                                                        echo "<b>OR #</b>" . " " . $row->ornum_addstay;
                                                    }
                                                    ?>
                                            </td>
                                            <!-- ORIGINAL RECEIPT NUMBER FOR ADDITIONAL STAY !-->
                                            <td class="text-left align-middle <?php
                                            if (!empty($row->addnumstay) && empty($row->ornum_addstay) && empty($row->payment_addstay)) {
                                                echo "noactioncell";
                                            }
                                            ?>"><?php
                                                    if (!empty($row->payment_addstay)) {
                                                        echo "<b>&#x20B1;</b>" . " " . number_format($row->payment_addstay, 2);
                                                    }
                                                    ?>
                                            </td>
                                            <!-- SIGNATURE SHIPPING AGENT FOR ADDITIONAL STAY  !-->
                                            <td class="text-center align-middle">
                                                <?php if (!empty($row->client_addstaysign)) { ?>
                                                    <img src="<?php echo base_url(); ?>assets/images/signatures/client/<?php echo $row->client_addstaysign; ?>" alt="Signature" width="150" height="50">
                                                <?php } ?>
                                            </td>
                                            <!-- SIGNATURE PPA PERSONNEL FOR ADDITIONAL STAY  !-->
                                            <td class="text-center align-middle <?php
                                            if (!empty($row->ornum_addstay) && !empty($row->payment_addstay) && !empty($row->client_addstaysign) && empty($row->ppa_addstaysign)) {
                                                echo "noactioncell";
                                            }
                                            ?>">
                                                    <?php if (!empty($row->ppa_addstaysign)) { ?>
                                                    <img src="<?php echo base_url(); ?>assets/images/signatures/ppa/<?php echo $row->ppa_addstaysign; ?>" alt="Signature" width="150" height="50">
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
            } else if ($action == "update_transaction") {
                /* UPDATE DATA FROM DATABASE */
                foreach ($data as $row) {
                    ?>
                    <!-- GENERAL INFORMATION !-->
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">General Information</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- TRANSACTION ID !-->
                                <div class="form-group">
                                    <label for="transactionid">Transaction ID : </label>
                                    <input type="text" id="updatetransactionid" class="form-control" name="transaction_id" value="<?php echo $row->transaction_id; ?>" readonly required>
                                </div>
                                <div class="form-group">
                                    <label for="transactionid">Transaction Date : </label>
                                    <input type="date" id="updatetransactiondate" class="form-control" name="transaction_date" value="<?php echo date('Y-m-d', strtotime($row->transaction_date)); ?>" required>
                                    <input type="hidden" id="updatetransactiontime" name="transaction_time" value="<?php echo date('h:i:s', strtotime($row->transaction_date)); ?>">
                                </div>
                                <!-- SHIP CALL NUMBER  !-->
                                <div class="form-group">
                                    <label for="scn">Ship Call Number (SCN) : </label>
                                    <input type="text" id="updatescn" class="form-control" name="scn" value="<?php echo $row->scn; ?>" required>
                                </div>
                                <!-- VOYAGE NUMBER !-->
                                <div class="form-group">
                                    <label for="voyageno">Voyage Number : </label>
                                    <input type="text" id="updatevoyageno" class="form-control" name="voyageno" value="<?php echo $row->voyageno; ?>" required>
                                </div>
                                <!-- VESSEL NAME !-->
                                <div class="form-group">
                                    <label for="vesselname">Vessel Name : </label>
                                    <input type="text" id="updatevesselname" class="form-control" name="vesselname" value="<?php echo $row->vesselname; ?>" required>
                                </div>
                                <!-- BERTH ASSIGNMENT !-->
                                <div class="form-group">
                                    <label for="berthassignment">Berth Assignment : </label>
                                    <input type="text" id="updateberthassignment" class="form-control" name="berth_assignment" value="<?php echo $row->berth_assignment; ?>" required>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                    <!-- PARTICULARS !-->
                    <div class="col-md-6">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Particulars</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- GRT !-->
                                <div class="form-group">
                                    <label for="grt">GT : </label>
                                    <input type="text" id="updategrt" class="form-control" name="grt" value="<?php echo $row->grt; ?>" required>
                                </div>
                                <!-- NRT !-->
                                <div class="form-group">
                                    <label for="nrt">NRT : </label>
                                    <input type="text" id="updatenrt" class="form-control" name="nrt" value="<?php echo $row->nrt; ?>" required>
                                </div>
                                <!-- DWT !-->
                                <div class="form-group">
                                    <label for="dwt">DWT : </label>
                                    <input type="text" id="updatedwt" class="form-control" name="dwt" value="<?php echo $row->dwt; ?>" required>
                                </div>
                                <!-- BEAM !-->
                                <div class="form-group">
                                    <label for="beam">Beam : </label>
                                    <input type="text" id="updatebeam" class="form-control" name="beam" value="<?php echo $row->beam; ?>" required>
                                </div>
                                <!-- LOA !-->
                                <div class="form-group">
                                    <label for="loa">LOA : </label>
                                    <input type="text" id="updateloa" class="form-control" name="loa" value="<?php echo $row->loa; ?>" required>
                                </div>
                                <!-- DRAFT !-->
                                <div class="form-group">
                                    <label for="updatedraft">Draft : </label>
                                    <input type="text" id="updatedraft" class="form-control" name="draft" value="<?php echo $row->draft; ?>" required>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- ANCHORAGE !-->
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Anchorage</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- ANCHORAGE -  : ATA !-->
                                <div class="form-group">
                                    <label for="anchor_ata">ATA - Actual Date & Time of Arrival : </label>
                                    <input type="datetime-local" id="anchor_ata" class="form-control" name="anchor_ata" value="<?php
                                    if (!empty($row->anchor_ata)) {
                                        echo date('Y-m-d\TH:i', strtotime($row->anchor_ata));
                                    }
                                    ?>">
                                </div>
                                <!-- ANCHORAGE - ATD !-->
                                <div class="form-group">
                                    <label for="anchor_atd">ATD - Actual Date & Time of Departure : </label>
                                    <input type="datetime-local" id="anchor_atd" class="form-control" name="anchor_atd" value="<?php
                                    if (!empty($row->anchor_atd)) {
                                        echo date('Y-m-d\TH:i', strtotime($row->anchor_atd));
                                    }
                                    ?>">
                                </div>
                            </div>                        
                        </div>
                    </div>
                    <!-- BERTH !-->
                    <div class="col-md-6">
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Berth</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- BERTH - ATA !-->
                                <div class="form-group">
                                    <label for="berth_ata">ATA - Actual Date & Time of Arrival : </label>
                                    <input type="datetime-local" id="berth_ata" class="form-control" name="berth_ata" value="<?php
                                    if (!empty($row->berth_ata)) {
                                        echo date('Y-m-d\TH:i', strtotime($row->berth_ata));
                                    }
                                    ?>">
                                </div>
                                <!-- BERTH - ETD !-->
                                <div class="form-group">
                                    <label for="berth_etd">ETD - Estimated Date & Time of Departure : </label>
                                    <input type="datetime-local" id="berth_etd" class="form-control" name="berth_etd" value="<?php
                                    if (!empty($row->berth_etd)) {
                                        echo date('Y-m-d\TH:i', strtotime($row->berth_etd));
                                    }
                                    ?>">
                                </div>
                                <!-- BERTH - ATD !-->
                                <div class="form-group">
                                    <label for="berth_atd">ATD - Actual Date & Time of Departure : </label>
                                    <input type="datetime-local" id="berth_atd" class="form-control" name="berth_atd" value="<?php
                                    if (!empty($row->berth_atd)) {
                                        echo date('Y-m-d\TH:i', strtotime($row->berth_atd));
                                    }
                                    ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- PORT OF CALL !-->
                    <div class="col-md-6">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Port of Call</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- LAST PORT !-->
                                <div class="form-group">
                                    <label for="lastport">Last Port : </label>
                                    <input type="text" id="lastport" class="form-control" name="lastport" value="<?php echo $row->lastport; ?>" required>
                                </div>
                                <!-- NEXT PORT !-->
                                <div class="form-group">
                                    <label for="nextport">Next Port : </label>
                                    <input type="text" id="nextport" class="form-control" name="nextport" value="<?php echo $row->nextport; ?>" required>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- PASSENGERS !-->
                    <div class="col-md-6">
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Passengers</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- PASSENGERS : IN  !-->
                                <div class="form-group">
                                    <label for="passengerin">In : </label>
                                    <input type="text" id="passengerin" class="form-control" name="passengerin" value="<?php echo $row->passengerin; ?>" required>
                                </div>
                                <!-- PASSENGERS : OUT !-->
                                <div class="form-group">
                                    <label for="passengerout">Out : </label>
                                    <input type="text" id="passengerout" class="form-control" name="passengerout" value="<?php echo $row->passengerout; ?>" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--  PAYMENT !-->
                    <div class="col-md-6">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Payment</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- ORIGINAL RECEIPT NUMBER !-->
                                <div class="form-group">
                                    <label for="ornum">Original Receipt (OR) Number : </label>
                                    <input type="text" id="ornum" class="form-control" name="ornum" value="<?php echo $row->ornum; ?>" required>
                                </div>
                                <!-- PAYMENT !-->
                                <div class="form-group">
                                    <label for="payment">Amount Paid : </label>
                                    <input type="text" id="payment" class="form-control" name="payment" value="<?php echo $row->payment; ?>" required>
                                </div>
                                <!-- CLEARED / ATTACH HARBOR OPERATIONS OFFICER SIGNATURE !-->
                                <div class="form-group">
                                    <label for="approvedoption">Clearance : </label>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" id="approvedoption" class="form-check-input" name="approvedoption" value="Yes" required <?php
                                            if (!empty($row->ppa_signature)) {
                                                echo "checked";
                                            }
                                            ?>>Cleared
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>
                    <!--  ADDITIONAL STAY !-->
                    <div class="col-md-6">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Additional Stay</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- ADDITIONAL STAY : NUMBER OF DAYS !-->
                                <div class="form-group">
                                    <label for="addnumstay">Additional Stay/Number of days : </label>
                                    <input type="number" id="addnumstay" class="form-control" name="addnumstay" value="<?php echo $row->addnumstay; ?>" step=".01">
                                </div>
                                <!-- ADDITIONAL STAY : ORIGINAL RECEIPT NUMBER!-->
                                <div class="form-group">
                                    <label for="ornumaddstay">Original Receipt (OR) Number :  </label>
                                    <input type="text" id="ornumaddstay" class="form-control" name="ornumaddstay" value="<?php echo $row->ornum_addstay; ?>" 
                                    <?php
                                    if (!empty($row->addnumstay)) {
                                        echo "required";
                                    }
                                    ?>>
                                </div>
                                <!-- ADDITIONAL STAY : PAYMENT !-->
                                <div class="form-group">
                                    <label for="paymentaddstay">Amount Paid :  </label>
                                    <input type="text" id="paymentaddstay" class="form-control" name="paymentaddstay" value="<?php echo $row->payment_addstay; ?>"
                                    <?php
                                    if (!empty($row->addnumstay)) {
                                        echo "required";
                                    }
                                    ?>>
                                </div>
                                <!-- CLEARED / ATTACH HARBOR OPERATIONS OFFICER SIGNATURE !-->
                                <div class="form-group">
                                    <label for="add_approvedoption">Clearance : </label>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" id="add_approvedoption" class="form-check-input" name="addapprovedoption" value="Yes" 
                                            <?php
                                            if (!empty($row->ppa_addstaysign)) {
                                                echo "checked";
                                            }
                                            ?>    

                                                   >Cleared
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else if ($action == "report") {
                if (!empty($_GET['report_class'])) {
                    $class = $_GET['report_class'];
                }
                ?>
                <div class="card">
                    <div class="card-body">
                        <div class="card card-primary card-tabs">
                            <div class="card-header p-0 pt-1">
                                <!-- MENUBAR FOR BASEPORT OR PRIVATE PORTS !-->
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link <?php
                                        if (!empty($active)) {
                                            if ($active == "baseport") {
                                                echo "active";
                                            }
                                        }
                                        ?>" href="<?php echo base_url() ?>home/view_report?typeofport=baseport&action=<?php echo $action; ?>&report_class=<?php echo $class; ?>">Baseport</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link <?php
                                        if (!empty($active)) {
                                            if ($active == "privateports") {
                                                echo "active";
                                            }
                                        }
                                        ?>" href="<?php echo base_url() ?>home/view_report?typeofport=privateports&action=<?php echo $action; ?>&report_class=<?php echo $class; ?>">Private Ports</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- SORT / FILTER DATA BASED ON THE DAILY,WEEKLY,MONTHLY AND YEARLY REPORT  !-->
                        <form class="form-inline" action="<?php echo base_url(); ?>home/view_report?typeofport=<?php echo $typeofport; ?>&action=<?php echo $action; ?>&report_class=<?php echo $class; ?>" method="post">
                            <div class="input-group mb-3">
                                <?php
                                if (!empty($class)) {
                                    if ($class == "internal") {
                                        ?>
                                        <div class="input-group-prepend">
                                            <button class="btn btn-secondary  dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required>
                                                <?php
                                                if (!empty($_GET['report_type'])) {
                                                    $report_type = $_GET['report_type'];
                                                    echo ucfirst($report_type);
                                                } else if (!empty($report_type)) {
                                                    echo ucfirst($report_type);
                                                } else {
                                                    echo "Type of Report";
                                                }
                                                ?>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="<?php echo base_url(); ?>home/view_report?typeofport=<?php echo $typeofport; ?>&action=<?php echo $action; ?>&report_type=daily&report_class=<?php echo $class; ?>">Daily</a>
                                                <a class="dropdown-item" href="<?php echo base_url(); ?>home/view_report?typeofport=<?php echo $typeofport; ?>&action=<?php echo $action; ?>&report_type=weekly&report_class=<?php echo $class; ?>">Weekly</a>
                                                <a class="dropdown-item" href="<?php echo base_url(); ?>home/view_report?typeofport=<?php echo $typeofport; ?>&action=<?php echo $action; ?>&report_type=monthly&report_class=<?php echo $class; ?>">Monthly</a>
                                                <a class="dropdown-item" href="<?php echo base_url(); ?>home/view_report?typeofport=<?php echo $typeofport; ?>&action=<?php echo $action; ?>&report_type=yearly&report_class=<?php echo $class; ?>">Yearly</a>
                                            </div>
                                        </div>
                                        <?php
                                        if (!empty($report_type)) {
                                            if ($report_type == "daily") {
                                                ?>
                                                <input type="date" class="form-control" id="daily_report" name="daily_report" value="<?php
                                                if (!empty($daily_report)) {
                                                    echo $daily_report;
                                                }
                                                ?>" required>&nbsp;
                                                       <?php
                                                   } else if ($report_type == "weekly") {
                                                       ?>
                                                <input type="date" id="week_from" class="form-control"  name="weekly_from" value="<?php
                                                if (!empty($weekly_from)) {
                                                    echo $weekly_from;
                                                }
                                                ?>" required>
                                                <input type="date" id="week_to" class="form-control" name="weekly_to" value="<?php
                                                if (!empty($weekly_to)) {
                                                    echo $weekly_to;
                                                }
                                                ?>" required>
                                                       <?php
                                                   } else if ($report_type == "monthly") {
                                                       ?>
                                                <input type="month" class="form-control" id="monthly_report" name="monthly_report" value="<?php
                                                if (!empty($monthly_report)) {
                                                    echo $monthly_report;
                                                }
                                                ?>" required>
                                                       <?php
                                                   } else if ($report_type == "yearly") {
                                                       if (!empty($yearly_report)) {
                                                           ?>
                                                    <input type="hidden" id="selected_year" name="selected_year" value="<?php echo $yearly_report; ?>">
                                                    <?php
                                                }
                                                ?>
                                                <select class="form-control" id="yearly_report" name="yearly_report" autofocus="true" required>
                                                    <?php
                                                    if (empty($yearly_report)) {
                                                        ?>
                                                        <option value="" selected disabled>Choose Year</option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <input readonly type="text" class="form-control">
                                            <?php
                                        }
                                        ?>
                                        <div class="input-group-append">
                                            <?php
                                            if (!empty($report_type)) {
                                                ?>
                                                <input type="hidden" id="report_type" name="report_type" value="<?php echo $report_type; ?>">
                                                <button class="btn btn-outline-primary" type="submit">Submit</button>
                                            <?php } ?>
                                        </div>&nbsp;
                                        <?php
                                    }
                                    if (!empty($daily_report) || !empty($weekly_from) || !empty($weekly_to) || !empty($monthly_report) || !empty($yearly_report) || !empty($class)) {
                                        // if (!empty($daily_report) || !empty($weekly_from) || !empty($weekly_to) || !empty($monthly_report) || !empty($yearly_report) && !empty($data)) {
                                        ?>
                                        <button type="button" class="btn btn-outline-success
                                        <?php
                                        if ($class == "standard") {
                                            echo "standard-pdf";
                                        } else {
                                            echo "internal-pdf";
                                        }
                                        ?>" id="report_btn">Generate Report</button> 
                                                <?php
                                            }
                                        }
                                        ?>
                            </div>&nbsp;
                        </form>
                        <?php
                        if (!empty($daily_report) || !empty($weekly_from) || !empty($weekly_to) || !empty($monthly_report) || !empty($yearly_report)) {
                            $message = "Showing all Vessel Transactions ";
                            if (!empty($daily_report)) {
                                $message .= " on " . date("F d, Y", strtotime($daily_report));
                            } else if (!empty($weekly_from) || !empty($weekly_to)) {
                                $message .= " from " . date("F d, Y", strtotime($weekly_from)) . " to " . date("F d, Y", strtotime($weekly_to));
                            } else if (!empty($monthly_report)) {
                                $message .= " for the month " . date("F Y", strtotime($monthly_report));
                            } else if (!empty($yearly_report)) {
                                $message .= " for the year " . $yearly_report;
                            }
                            echo "<h4><b>" . $message . "</b></h4><hr>";
                        }
                        ?>
                        <table id="<?php
                        if ($class == "standard") {
                            echo "standard_report";
                        } else if ($class == "internal") {
                            echo "internal_report";
                        }
                        ?>" class="table table-striped table-bordered table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <?php if ($class == "internal") { ?>
                                        <!-- STATUS HEADING !-->
                                        <th class="text-center align-middle" rowspan="4">
                                            STATUS
                                        </th>
                                    <?php } ?>
                                    <!-- NUMBER SEQUENCE HEADING !-->
                                    <th class="text-center align-middle" rowspan="4">
                                        #
                                    </th>
                                    <?php if ($class == "internal") { ?>
                                        <!-- TRANSACTION DATE HEADING !-->
                                        <th class="text-center align-middle" rowspan="4">
                                            TRANSAC <br> DATE
                                        </th>
                                    <?php } ?>
                                    <?php if ($class == "internal") { ?>
                                        <!-- TRANSACTION ID NUMBER HEADING !-->
                                        <th class="text-center align-middle" rowspan="4">
                                            TRANSAC #
                                        </th>
                                    <?php } ?>
                                    <!-- SHIP CALL NUMBER HEADING!-->
                                    <th class="text-center align-middle" rowspan="4">
                                        SCN
                                    </th>
                                    <!-- VESSEL NAME HEADING!-->
                                    <th class="text-center align-middle" rowspan="4">
                                        VESSEL <br>NAME
                                    </th>
                                    <!-- VOYAGE NUMBER HEADING!-->
                                    <th class="text-center align-middle" rowspan="4">
                                        VOY <br> NO.
                                    </th>
                                    <!-- ANCHORAGE HEADING!-->
                                    <th class="text-center align-middle table-primary" colspan="4">
                                        ANCHORAGE
                                    </th>
                                    <!-- BERTH HEADING!-->
                                    <th class="text-center align-middle table-danger" colspan="6">
                                        BERTH
                                    </th>
                                    <!-- BERTH ASSIGNMENT HEADING!-->
                                    <th class="text-center align-middle" rowspan="4">
                                        BERTH ASSIGNMENT
                                    </th>
                                    <!-- PARTICULARS HEADING!-->
                                    <th class="text-center align-middle" colspan="6" rowspan="3">
                                        PARTICULARS
                                    </th>
                                    <!-- PORT OF CALL HEADING!-->
                                    <th class="text-center align-middle" colspan="2" rowspan="3">
                                        PORT OF CALL
                                    </th>
                                    <!-- PASSENGERS HEADING!-->
                                    <th class="text-center align-middle" colspan="2" rowspan="3">
                                        PASSENGERS
                                    </th>
                                    <!-- O.R. #/AMT PAID HEADING!-->
                                    <th class="text-center align-middle" colspan="2" rowspan="3">
                                        O.R. #/AMT PAID 
                                    </th>
                                    <!-- NAME AND SIGNATURE HEADING!-->
                                    <th class="text-center align-middle" colspan="2" rowspan="3">
                                        NAME & SIGNATURE
                                    </th>
                                    <!-- ADDITIONAL STAY/# DAYS HEADING!-->
                                    <th class="text-center align-middle" rowspan="4">
                                        Additional Stay/# of Days
                                    </th>
                                    <!-- O.R. #/AMT PAID (For Additional Stay) HEADING!-->
                                    <th class="text-center align-middle" colspan="2" rowspan="3">
                                        O.R. #/AMT PAID (For Additional Stay)
                                    </th>
                                    <!--  NAME AND SIGNATURE (For Additional Stay) HEADING!-->
                                    <th class="text-center align-middle" colspan="2" rowspan="3">
                                        NAME & SIGNATURE
                                    </th>
                                </tr>
                                <tr>
                                    <th class="text-center align-middle" colspan="2">Arrival</th>
                                    <th class="text-center align-middle" colspan="2">Departure</th>
                                    <th class="text-center align-middle" colspan="2">Arrival</th>
                                    <th class="text-center align-middle" colspan="4">Departure</th>
                                </tr>
                                <tr>
                                    <th class="text-center align-middle" colspan="2">ATA</th>
                                    <th class="text-center align-middle" colspan="2">ATD</th>
                                    <th class="text-center align-middle" colspan="2">ATA</th>
                                    <th class="text-center align-middle" colspan="2">ETD</th>
                                    <th class="text-center align-middle" colspan="2">ATD</th>
                                </tr>
                                <tr>
                                    <th class="text-center align-middle">Date</th>
                                    <th class="text-center align-middle">Time</th>
                                    <th class="text-center align-middle">Date</th>
                                    <th class="text-center align-middle">Time</th>
                                    <th class="text-center align-middle">Date</th>
                                    <th class="text-center align-middle">Time</th>
                                    <th class="text-center align-middle">Date</th>
                                    <th class="text-center align-middle">Time</th>
                                    <th class="text-center align-middle">Date</th>
                                    <th class="text-center align-middle">Time</th>
                                    <th class="text-center align-middle">GT</th>
                                    <th class="text-center align-middle">NRT</th>
                                    <th class="text-center align-middle">DWT</th>
                                    <th class="text-center align-middle">Beam</th>
                                    <th class="text-center align-middle">LOA</th>
                                    <th class="text-center align-middle">Draft</th>
                                    <th class="text-center align-middle">Last</th>
                                    <th class="text-center align-middle">Next</th>
                                    <th class="text-center align-middle">IN</th>
                                    <th class="text-center align-middle">OUT</th>
                                    <th class="text-center align-middle">O.R. #</th>
                                    <th class="text-center align-middle">Amount Paid</th>
                                    <th class="text-center align-middle">Shipping Agent</th>
                                    <th class="text-center align-middle">PPA Personnel</th>
                                    <th class="text-center align-middle">O.R. #</th>
                                    <th class="text-center align-middle">Amount Paid</th>
                                    <th class="text-center align-middle">Shipping Agent</th>
                                    <th class="text-center align-middle">PPA Personnel</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                if (!empty($data)) {
                                    foreach ($data as $row) {
                                        $i++;
                                        ?>
                                        <tr>
                                            <?php if ($class == "internal") { ?>
                                                <!-- STATUS !-->
                                                <td class="align-middle text-center <?php
                                                if (empty($row->status) || $row->status == "pending") {
                                                    echo "noactioncell";
                                                } else if ($row->status == "done") {
                                                    echo "donecell";
                                                }
                                                ?>">
                                                        <?php
                                                        if ($row->status == "done") {
                                                            echo "<b>CLEARED</b>";
                                                        } else {
                                                            echo "<b>" . strtoupper($row->status) . "</b>";
                                                        }
                                                        ?>
                                                </td>
                                            <?php } ?>
                                            <td class="align-middle text-center"><?php echo $i; ?></td>
                                            <?php if ($class == "internal") { ?>
                                                <!--  TRASACTION DATE !-->
                                                <td class="align-middle text-center"><?php echo date("m/d/Y", strtotime($row->transaction_date)); ?></td>
                                            <?php } ?>
                                            <?php if ($class == "internal") { ?>
                                                <!--  TRASACTION ID !-->
                                                <td class="align-middle text-center"><?php echo $row->transaction_id; ?></td>
                                            <?php } ?>
                                            <!--  SHIP CALL NUMBER !-->
                                            <td class="align-middle"><?php echo $row->scn; ?></td>
                                            <!--  VESSEL NAME !-->
                                            <td class="align-middle"><?php echo $row->vesselname; ?></td>
                                            <!--  VOYAGE NUMBER !-->
                                            <td class="align-middle"><?php echo $row->voyageno; ?></td>
                                            <!-- ANCHORAGE - ATA/DATE  !-->
                                            <td class="align-middle <?php
                                            if (!empty($typeofmovement) && !empty($ata)) {
                                                if ($typeofmovement == "anchorage") {
                                                    if ($ata == date("Y-m-d", strtotime($row->anchor_ata))) {
                                                        echo "highlight";
                                                    }
                                                }
                                            }
                                            ?>"><?php
                                                    if (!empty($row->anchor_ata)) {
                                                        echo date("m/d/Y", strtotime($row->anchor_ata));
                                                    }
                                                    ?>
                                            </td>
                                            <!-- ANCHORAGE - ATA/TIME  !-->
                                            <td class="align-middle"><?php
                                                if (!empty($row->anchor_ata)) {
                                                    //  echo date("h:i A", strtotime($row->anchor_ata));
                                                    echo date("H:i", strtotime($row->anchor_ata));
                                                }
                                                ?>
                                            </td>
                                            <!-- ANCHORAGE - ATD/DATE  !-->
                                            <td class="align-middle <?php
                                            if (!empty($typeofmovement) && !empty($atd)) {
                                                if ($typeofmovement == "anchorage") {
                                                    if ($atd == date("Y-m-d", strtotime($row->anchor_atd))) {
                                                        echo "highlight";
                                                    }
                                                }
                                            }
                                            ?>"><?php
                                                    if (!empty($row->anchor_atd)) {
                                                        echo date("m/d/Y", strtotime($row->anchor_atd));
                                                    }
                                                    ?>
                                            </td>
                                            <!-- ANCHORAGE - ATD/TIME  !-->
                                            <td class="align-middle"><?php
                                                if (!empty($row->anchor_atd)) {
                                                    //  echo date("h:i A", strtotime($row->anchor_atd));
                                                    echo date("H:i", strtotime($row->anchor_atd));
                                                }
                                                ?>
                                            </td>
                                            <!-- BERTH - ATA/DATE  !-->
                                            <td class="align-middle <?php
                                            if (!empty($typeofmovement) && !empty($ata)) {
                                                if ($typeofmovement == "berth") {
                                                    if ($ata == date("Y-m-d", strtotime($row->berth_ata))) {
                                                        echo "highlight";
                                                    }
                                                }
                                            }
                                            ?>"><?php
                                                    if (!empty($row->berth_ata)) {
                                                        echo date("m/d/Y", strtotime($row->berth_ata));
                                                    }
                                                    ?>
                                            </td>
                                            <!-- BERTH - ATA/TIME  !-->
                                            <td class="align-middle"><?php
                                                if (!empty($row->berth_ata)) {
                                                    //  echo date("h:i A", strtotime($row->anchor_ata));
                                                    echo date("H:i", strtotime($row->berth_ata));
                                                }
                                                ?>
                                            </td>
                                            <!-- BERTH - ETD/DATE  !-->
                                            <td class="align-middle <?php
                                            if (!empty($typeofmovement) && !empty($etd)) {
                                                if ($typeofmovement == "berth") {
                                                    if ($etd == date("Y-m-d", strtotime($row->berth_etd))) {
                                                        echo "highlight";
                                                    }
                                                }
                                            }
                                            ?>"><?php
                                                    if (!empty($row->berth_etd)) {
                                                        echo date("m/d/Y", strtotime($row->berth_etd));
                                                    }
                                                    ?>
                                            </td>
                                            <!-- BERTH - ETD/TIME  !-->
                                            <td class="align-middle"><?php
                                                if (!empty($row->berth_etd)) {
                                                    //  echo date("h:i A", strtotime($row->anchor_ata));
                                                    echo date("H:i", strtotime($row->berth_etd));
                                                }
                                                ?>
                                            </td>
                                            <!-- BERTH - ATD/DATE  !-->
                                            <td class="align-middle <?php
                                            if (!empty($typeofmovement) && !empty($atd)) {
                                                if ($typeofmovement == "berth") {
                                                    if ($atd == date("Y-m-d", strtotime($row->berth_atd))) {
                                                        echo "highlight";
                                                    }
                                                }
                                            }
                                            ?>"><?php
                                                    if (!empty($row->berth_atd)) {
                                                        echo date("m/d/Y", strtotime($row->berth_atd));
                                                    }
                                                    ?>
                                            </td>
                                            <!-- BERTH - ATD/TIME  !-->
                                            <td class="align-middle"><?php
                                                if (!empty($row->berth_atd)) {
                                                    //  echo date("h:i A", strtotime($row->anchor_ata));
                                                    echo date("H:i", strtotime($row->berth_atd));
                                                }
                                                ?>
                                            </td>
                                            <!-- BERTH ASSIGNMENT !-->
                                            <td class="text-center align-middle <?php
                                            if (empty($row->berth_assignment)) {
                                                echo "noactioncell";
                                            }
                                            ?>"><?php
                                                    if (!empty($row->berth_assignment)) {
                                                        echo $row->berth_assignment;
                                                    }
                                                    ?>
                                            </td>
                                            <!-- PARTICULARS : GRT !-->
                                            <td class="text-center align-middle"><?php echo $row->grt; ?></td>
                                            <!-- PARTICULARS : NRT !-->
                                            <td class="text-center align-middle"><?php echo $row->nrt; ?></td>
                                            <!-- PARTICULARS : DWT !-->
                                            <td class="text-center align-middle"><?php echo $row->dwt; ?></td>
                                            <!-- PARTICULARS : BEAM !-->
                                            <td class="text-center align-middle"><?php echo $row->beam; ?></td>
                                            <!-- PARTICULARS : LOA !-->
                                            <td class="text-center align-middle"><?php echo $row->loa; ?></td>
                                            <!-- PARTICULARS : DRAFT !-->
                                            <td class="text-center align-middle"><?php echo $row->draft; ?></td>
                                            <!-- PORT OF CALL : LAST PORT !-->
                                            <td class="text-center align-middle"><?php echo strtoupper($row->lastport); ?></td>
                                            <!-- PORT OF CALL : NEXT PORT !-->
                                            <td class="text-center align-middle"><?php echo strtoupper($row->nextport); ?></td>
                                            <!-- PASSENGERS IN !-->
                                            <td class="text-center align-middle"><?php echo strtoupper($row->passengerin); ?></td>
                                            <!-- PASSENGERS OUT !-->
                                            <td class="text-center align-middle"><?php echo strtoupper($row->passengerout); ?></td>
                                            <!-- ORIGINAL RECEIPT NUMBER !-->
                                            <td class="text-left align-middle <?php
                                            if (empty($row->ornum) && empty($row->payment)) {
                                                echo "noactioncell";
                                            }
                                            ?>">
                                                    <?php
                                                    if (!empty($row->ornum)) {
                                                        echo "<b>OR #</b>" . " " . strtoupper($row->ornum);
                                                    }
                                                    ?>
                                            </td>
                                            <!-- PAYMENT !-->
                                            <td class="text-left align-middle <?php
                                            if (empty($row->ornum) && empty($row->payment)) {
                                                echo "noactioncell";
                                            }
                                            ?>"><?php
                                                    if (!empty($row->payment)) {
                                                        echo "<b>&#x20B1;</b>" . " " . number_format($row->payment, 2);
                                                    }
                                                    ?>
                                            </td>
                                            <!-- SIGNATURE : SHIPPING AGENT  !-->
                                            <td class="text-center align-middle">
                                                <?php if (!empty($row->client_signature)) { ?>
                                                    <img src="<?php echo base_url(); ?>assets/images/signatures/client/<?php echo $row->client_signature; ?>" alt="Signature" width="150" height="50">
                                                    <br>
                                                <?php }
                                                ?>
                                            </td>
                                            <!-- SIGNATURE : PPA PERSONNEL  !-->
                                            <td class="text-center align-middle <?php
                                            if (!empty($row->ornum) && !empty($row->payment) && !empty($row->client_signature) && empty($row->ppa_signature)) {
                                                echo "noactioncell";
                                            }
                                            ?>">
                                                    <?php if (!empty($row->ppa_signature)) { ?>
                                                    <img src="<?php echo base_url(); ?>assets/images/signatures/ppa/<?php echo $row->ppa_signature; ?>" alt="Signature" width="150" height="50">
                                                <?php } ?>
                                            </td>
                                            <!-- ADDITIONAL STAY : NUMBER OF DAYS  !-->
                                            <td class="text-center align-middle">
                                                <?php
                                                echo $row->addnumstay;
                                                ?>
                                            </td>
                                            <!-- ORIGINAL RECEIPT NUMBER FOR ADDITIONAL STAY !-->
                                            <td class="text-left align-middle <?php
                                            if (!empty($row->addnumstay) && empty($row->ornum_addstay) && empty($row->payment_addstay)) {
                                                echo "noactioncell";
                                            }
                                            ?>"><?php
                                                    if (!empty($row->ornum_addstay)) {
                                                        echo "<b>OR #</b>" . " " . $row->ornum_addstay;
                                                    }
                                                    ?>
                                            </td>
                                            <!-- ORIGINAL RECEIPT NUMBER FOR ADDITIONAL STAY !-->
                                            <td class="text-left align-middle <?php
                                            if (!empty($row->addnumstay) && empty($row->ornum_addstay) && empty($row->payment_addstay)) {
                                                echo "noactioncell";
                                            }
                                            ?>"><?php
                                                    if (!empty($row->payment_addstay)) {
                                                        echo "<b>&#x20B1;</b>" . " " . number_format($row->payment_addstay, 2);
                                                    }
                                                    ?>
                                            </td>
                                            <!-- SIGNATURE SHIPPING AGENT FOR ADDITIONAL STAY  !-->
                                            <td class="text-center align-middle">
                                                <?php if (!empty($row->client_addstaysign)) { ?>
                                                    <img src="<?php echo base_url(); ?>assets/images/signatures/client/<?php echo $row->client_addstaysign; ?>" alt="Signature" width="150" height="50">
                                                <?php } ?>
                                            </td>
                                            <!-- SIGNATURE PPA PERSONNEL FOR ADDITIONAL STAY  !-->
                                            <td class="text-center align-middle <?php
                                            if (!empty($row->ornum_addstay) && !empty($row->payment_addstay) && !empty($row->client_addstaysign) && empty($row->ppa_addstaysign)) {
                                                echo "noactioncell";
                                            }
                                            ?>">
                                                    <?php if (!empty($row->ppa_addstaysign)) { ?>
                                                    <img src="<?php echo base_url(); ?>assets/images/signatures/ppa/<?php echo $row->ppa_addstaysign; ?>" alt="Signature" width="150" height="50">
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
            } else if ($action == "view_vessel") {
                ?>
                <div class="card">
                    <div class="card-body">
                        <table id="vessel_details" class="table table-striped table-bordered table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <!-- ACTION HEADING !-->
                                    <th class="text-center align-middle" rowspan="2">
                                        ACTION
                                    </th>
                                    <!-- NUMBER SEQUENCE HEADING !-->
                                    <th class="text-center align-middle" rowspan="2">
                                        #
                                    </th>
                                    <!-- SHIP CALL NUMBER HEADING!-->
                                    <th class="text-center align-middle" rowspan="2">
                                        SCN
                                    </th>
                                    <!-- VOYAGE NUMBER HEADING!-->
                                    <th class="text-center align-middle" rowspan="2">
                                        VOY #
                                    </th>
                                    <!-- VESSEL NAME HEADING!-->
                                    <th class="text-center align-middle" rowspan="2">
                                        VESSEL NAME
                                    </th>
                                    <!-- PARTICULARS HEADING!-->
                                    <th class="text-center align-middle" colspan="6">
                                        PARTICULARS
                                    </th>
                                </tr>
                                <tr>
                                    <th class="text-center align-middle">GT</th>
                                    <th class="text-center align-middle">NRT</th>
                                    <th class="text-center align-middle">DWT</th>
                                    <th class="text-center align-middle">Beam</th>
                                    <th class="text-center align-middle">LOA</th>
                                    <th class="text-center align-middle">Draft</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                if (!empty($data)) {
                                    foreach ($data as $row) {
                                        $i++;
                                        ?>
                                        <tr>
                                            <!-- ACTION BUTTON !-->
                                            <td class="text-center align-middle">
                                                <a href="<?php echo base_url(); ?>home/specific_vessel/?id=<?php echo $row->vesselid ?>&action=update_vessel">
                                                    <button class="btn btn-info" type="button" title="Edit Vessel">
                                                        <i class="fas fa-fw fa-pen"></i>
                                                    </button>
                                                </a>
                                            </td>
                                            <!--  ID !-->
                                            <td class="align-middle text-center"><?php echo $i; ?></td>
                                            <!--  SHIP CALL NUMBER !-->
                                            <td class="align-middle"><?php echo $row->scn; ?></td>
                                            <!--  VOYAGE NUMBER !-->
                                            <td class="align-middle"><?php echo $row->voyageno; ?></td>
                                            <!--  VESSEL NAME !-->
                                            <td class="align-middle"><?php echo $row->vesselname; ?></td>
                                            <!-- PARTICULARS : GRT !-->
                                            <td class="text-center align-middle"><?php echo $row->grt; ?></td>
                                            <!-- PARTICULARS : NRT !-->
                                            <td class="text-center align-middle"><?php echo $row->nrt; ?></td>
                                            <!-- PARTICULARS : DWT !-->
                                            <td class="text-center align-middle"><?php echo $row->dwt; ?></td>
                                            <!-- PARTICULARS : BEAM !-->
                                            <td class="text-center align-middle"><?php echo $row->beam; ?></td>
                                            <!-- PARTICULARS : LOA !-->
                                            <td class="text-center align-middle"><?php echo $row->loa; ?></td>
                                            <!-- PARTICULARS : DRAFT !-->
                                            <td class="text-center align-middle"><?php echo $row->draft; ?></td>
                                            <?php
                                        }
                                        ?>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
            } else if ($action == "add_user" || $action == "update_user") {
                if (!empty($data)) {
                    foreach ($data as $row) {
                        $usertype = $row->usertype;
                        $username = $row->username;
                        $company_id = $row->company_id;
                        $company_name = $row->company_name;
                        $signature = $row->signature;
                        $fname = $row->fname;
                        $mname = $row->mname;
                        $lname = $row->lname;
                        $userid = $row->userid;
                    }
                } else {
                    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $username = '';
                    for ($i = 0; $i < 10; $i++) {
                        $index = rand(0, strlen($characters) - 1);
                        $username .= $characters[$index];
                    }
                }
                ?>
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">User Information</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Usertype !--> 
                            <div class="form-group">
                                <label for="usertype">Type of User : </label>
                                <!-- radio -->
                                <div class="form-group">
                                    <div class="form-check-inline">
                                        <input class="form-check-input" type="radio" id="usertype" name="usertype" value="hoo" <?php
                                        if (!empty($usertype)) {
                                            if ($usertype == "hoo") {
                                                echo "checked";
                                            }
                                        }
                                        ?> required>
                                        <label class="form-check-label">HOO</label>
                                    </div>
                                    <div class="form-check-inline">
                                        <input class="form-check-input" type="radio" id="usertype" name="usertype" value="client" <?php
                                        if (!empty($usertype)) {
                                            if ($usertype == "client") {
                                                echo "checked";
                                            }
                                        }
                                        ?> required>
                                        <label class="form-check-label">Client</label>
                                    </div>
                                </div>
                            </div>
                            <!--  Default Username !-->
                            <div class="form-group">
                                <label for="username">Username : </label>
                                <input type="text" id="username" class="form-control" name="username" placeholder="Username" value="<?php echo $username; ?>" required>
                            </div>
                            <!--  Company ID !-->
                            <div class="form-group">
                                <label for="company_id">Company/Agency ID No. : </label>
                                <input type="text" id="company_id" class="form-control" name="company_id" placeholder="Company/Agency ID No." value="<?php
                                if (!empty($company_id)) {
                                    echo $company_id;
                                }
                                ?>" required>
                            </div>
                            <!--  Company Name !-->
                            <div class="form-group">
                                <label for="company_name">Company/Agency Name : </label>
                                <input type="text" id="company_name" class="form-control" name="company_name" placeholder="Company/Agency Name" value="<?php
                                if (!empty($company_name)) {
                                    echo $company_name;
                                }
                                ?>" required>
                            </div>
                        </div>  
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Personal Information</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <!--  First Name !-->
                            <div class="form-group">
                                <label for="fname">First Name : </label>
                                <input type="text" id="fname" class="form-control" name="firstname" placeholder="First Name" value="<?php
                                if (!empty($fname)) {
                                    echo $fname;
                                }
                                ?>" required>
                            </div>
                            <!--  Middle Name !-->
                            <div class="form-group">
                                <label for="mname">Middle Name : </label>
                                <input type="text" id="mname" class="form-control" name="middlename" placeholder="Middle Name" value="<?php
                                if (!empty($mname)) {
                                    echo $mname;
                                }
                                ?>" required>
                            </div>
                            <!--  Last Name !-->
                            <div class="form-group">
                                <label for="lname">Last Name : </label>
                                <input type="text" id="lname" class="form-control" name="lastname" placeholder="Last Name" value="<?php
                                if (!empty($lname)) {
                                    echo $lname;
                                }
                                ?>" required>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            } else if ($action == "view_users" || $action == "reset_password" || $action == "new_password" || $action == "reset_signature") {
                ?>
                <div class="card">
                    <div class="card-body">
                        <table id="user_details" class="table table-striped table-bordered table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <!-- ACTION HEADING !-->
                                    <th class="text-center align-middle">
                                        ACTION
                                    </th>
                                    <!-- # HEADING !-->
                                    <th class="text-center align-middle">
                                        #
                                    </th>
                                    <!-- COMPANY ID HEADING !-->
                                    <th class="text-center align-middle">
                                        COMPANY/PPA <br> ID NO.
                                    </th>
                                    <!-- COMPANY NAME HEADING !-->
                                    <th class="text-center align-middle">
                                        COMPANY/AGENCY <br> NAME
                                    </th>
                                    <!-- USERNAME HEADING !-->
                                    <th class="text-center align-middle">
                                        USERNAME
                                    </th>
                                    <!-- FIRST NAME HEADING !-->
                                    <th class="text-center align-middle">
                                        FIRST NAME
                                    </th>
                                    <!-- MIDDLE NAME HEADING !-->
                                    <th class="text-center align-middle">
                                        MIDDLE NAME
                                    </th>
                                    <!-- LAST NAME HEADING !-->
                                    <th class="text-center align-middle">
                                        LAST NAME
                                    </th>
                                    <!-- SIGNATURE HEADING !-->
                                    <th class="text-center align-middle">
                                        SIGNATURE  
                                    </th>
                                    <!-- USERTYPE HEADING !-->
                                    <th class="text-center align-middle">
                                        TYPE OF USER 
                                    </th>
                                    <?php
                                    if ($action == "new_password") {
                                        ?>
                                        <!-- SUBMIT HEADING !-->
                                        <th class="text-center align-middle">
                                            SUBMIT
                                        </th>
                                        <?php
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                if (!empty($data)) {
                                    foreach ($data as $row) {
                                        $i++;
                                        ?>
                                        <tr>
                                            <!-- ACTION BUTTON !-->
                                            <td class="text-center align-middle">
                                                <a href="<?php
                                                echo base_url() . "profile/";
                                                if ($action == "view_users") {
                                                    echo "update_user/?action=update_user&userid=" . $row->userid;
                                                } else if ($action == "reset_password" || $action == "new_password") {
                                                    echo "view_users/?action=new_password&userid=" . $row->userid;
                                                } else if ($action == "reset_signature") {
                                                    echo "view_users/?action=new_signature&userid=" . $row->userid;
                                                }
                                                ?>">
                                                    <button class="btn btn-info" type="button" title="
                                                    <?php
                                                    if ($action == "view_users") {
                                                        echo "Edit User";
                                                    } else if ($action == "reset_password" || $action == "new_password") {
                                                        echo "Reset User Password";
                                                    } else if ($action == "reset_signature") {
                                                        echo "Reset Signature";
                                                    }
                                                    ?>">
                                                        <i class="fas fa-fw <?php
                                                        if ($action == "view_users") {
                                                            echo "fa-pen";
                                                        } else if ($action == "reset_password" || $action == "new_password") {
                                                            echo "fa-key";
                                                        } else if ($action == "reset_signature") {
                                                            echo "fa-pen-nib";
                                                        }
                                                        ?>"></i>
                                                    </button>
                                                </a>
                                            </td>
                                            <!--  ID !-->
                                            <td class="align-middle text-center"><?php echo $i; ?></td>
                                            <!--  COMPANY ID !-->
                                            <td class="align-middle text-center"><?php echo $row->company_id; ?></td>
                                            <!--  COMPANY NAME !-->
                                            <td class="align-middle text-center"><?php echo $row->company_name; ?></td>
                                            <!--  USERNAME !-->
                                            <td class="align-middle text-center"><?php echo $row->username; ?></td>
                                            <!--  FIRST NAME !-->
                                            <td class="align-middle text-center"><?php echo $row->fname; ?></td>
                                            <!--  MIDDLE NAME !-->
                                            <td class="align-middle text-center"><?php echo $row->mname; ?></td
                                            <!--  LAST NAME !-->
                                            <td class="align-middle text-center"><?php echo $row->lname; ?></td>
                                            <!-- SIGNATURE !-->
                                            <td class="align-middle text-center">
                                                <?php
                                                if (!empty($row->signature)) {
                                                    ?>
                                                    <img src="<?php
                                                    echo base_url() . "assets/images/signatures/";
                                                    if ($row->usertype == "hoo") {
                                                        echo "ppa/";
                                                    } else if ($row->usertype == "client") {
                                                        echo "client/";
                                                    }
                                                    echo $row->signature;
                                                    ?>" alt="Signature" width="150" height="50">
                                                     <?php } ?>
                                            </td>
                                            <!-- USERTYPE !-->
                                            <td class="align-middle text-center">
                                                <?php echo strtoupper($row->usertype); ?>
                                            </td>
                                            <?php
                                            if (!empty($userid)) {
                                                if ($action == "new_password") {
                                                    ?>
                                                    <td class="align-middle text-center"><?php
                                                        if ($row->userid == $userid) {
                                                            ?>
                                                            <input type="hidden" id="userid" name="userid" value="<?php echo $userid; ?>">
                                                            <button class="btn btn-success" id="resetpw_btn" type="submit">
                                                                <i class="fas fa-check"></i>&nbsp;
                                                            </button>
                                                            <?php
                                                        }
                                                        ?></td>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
            } else if ($action == "new_signature") {
                /* USER CONTENT SOURCE CODE */
                foreach ($data as $row) {
                    $userid = $row->userid;
                    $firstname = $row->fname;
                    $middlename = $row->mname;
                    $lastname = $row->lname;
                    $usertype = $row->usertype;
                    $signature = $row->signature;
                    $pp = $row->pp;
                }
                ?>
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                     src="<?php echo base_url(); ?>assets/images/userpics/<?php echo $pp; ?>"
                                     alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center"><?php echo $firstname . " " . $middlename . " " . $lastname; ?></h3>
                            <p class="text-muted text-center"><?php
                                if ($usertype == "hoo") {
                                    echo "Harbor Operations Officer";
                                } else if ($usertype == "client") {
                                    echo "Client";
                                }
                                ?>
                            </p>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>
                                        <?php
                                        if ($usertype == "hoo" || $usertype == "administrator") {
                                            echo "Philippine Ports Authority - Port Management Office of Misamis Oriental Cagayan de Oro";
                                        }
                                        ?>
                                    </b>
                                </li>
                            </ul>
                            <!-- Signature Value !-->
                            <ul class="list-group mb-5">
                                <li class="list-group-item">
                                <center>
                                    <img src="<?php
                                    echo base_url() . "assets/images/signatures/";
                                    if ($usertype == "hoo" || $usertype == "administrator") {
                                        echo "ppa/";
                                    } else if ($usertype == "client") {
                                        echo "client/";
                                    }
                                    echo $signature;
                                    ?>" alt="Signature" width="250" height="100">
                                </center>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#">Signature</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="sign">
                                    <form class="form-horizontal" action="<?php echo base_url(); ?>profile/reset_signature" method="post" enctype="multipart/form-data" autocomplete="off">
                                        <input type="hidden" id="userid" name="userid" value="<?php echo $userid; ?>">
                                        <input type="hidden" id="usertype" name="usertype" value="<?php echo $usertype; ?>">
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
                <?php
            }
            if ($action == "update_vessel") {
                ?>
                <input type="hidden" id="vesselid" name="vesselid" value="<?php echo $row->vesselid; ?>">
                <?php
            }
            if ($action == "update_transaction") {
                ?>
                <input type="hidden" id="id" name="id" value="<?php echo $row->id; ?>">
                <input type="hidden" id="ppa_id" name="ppa_id" value="<?php echo $row->ppa_id; ?>">
                <input type="hidden" id="ppa_idaddstay" name="ppa_idaddstay" value="<?php echo $row->ppa_idaddstay; ?>">
                <input type="hidden" id="typeofport" name="typeofport" value="<?php echo $typeofport; ?>">
                <?php
            }
            if ($action == "report") {
                ?>
                <input type="hidden" id="typeofport" name="typeofport" value="<?php echo $typeofport; ?>">
                <input type="hidden" id="captypeofport" name="captypeofport" value="<?php echo ucfirst($port_type); ?>">
                <input type="hidden" id="report_class" name="report_class" value="<?php
                if (!empty($class)) {
                    echo $class;
                }
                ?>">
                       <?php
                   }
                   if ($action == "update_user" || $action == "new_password") {
                       ?>
                <input type="hidden" id="userid" name="userid" value="<?php echo $userid; ?>">
                <?php
            }
            if ($action == "add_transaction" || $action == "update_transaction" || $action == "add_vessel" || $action == "update_vessel" || $action == "add_user" || $action == "update_user" || $action == "report") {
                ?>
                <input type='hidden' id="baseurl" value="<?php echo base_url(); ?>" /> 
                <?php
            }

            if ($action == "add_transaction" || $action == "update_transaction" || $action == "add_vessel" || $action == "update_vessel" || $action == "add_user" || $action == "update_user") {
                ?>

                <div class="col-12">
                    <!--<a href="<?php echo base_url() . $_SESSION['trim_url']; ?>" class="btn btn-primary">BACK</a>!-->
                    <input type="submit" value="Save Changes" name="save" class="btn btn-success">
                </div>

        </form>
        <?php
    }
} else {
    ?>
    <p>Please select a process on the left menu.</p>
    <?php
}
?>

