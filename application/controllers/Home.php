<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    /* FUNCTION FOR HOME */

    public function __construct() {
        parent::__construct();

        $this->load->library('encryption');
        $this->load->library('session');
        $this->load->model('main_model');
    }

    /* FUNCTION FOR HOME INDEX */

    function index() {
        $typeofport = $this->session->userdata('typeofport');                   // GET THE TYPE OF PORT
        $usertype = $this->session->userdata('usertype');
        $sessionid = $this->session->userdata('sessionid');                     // GET SESSION ID/USER ID FROM DBASE
        if (empty($sessionid)) {
            redirect('login', 'refresh');
        }
        if (!empty($usertype)) {
            if ($usertype == "administrator") {
                redirect('home/adminhome');
            } else if ($usertype == "hoo") {
                if (!empty($typeofport)) {
                    redirect('home/view_transaction/?typeofport=' . $typeofport . '&action=view_transaction');
                } else {
                    redirect('home/view_transaction/?typeofport=baseport&action=view_transaction');
                }
            } else {
                redirect('login', 'refresh');
            }
        } else {
            redirect('login', 'refresh');
        }
    }

    /* FUNCTION FOR ADMINISTRATOR */

    function adminhome() {
        $sessionid = $this->session->userdata('sessionid');                     // GET SESSION ID/USER ID FROM DBASE
        if (empty($sessionid)) {
            redirect('login', 'refresh');
        } else {
            $this->load->view('home');
        }
    }

    /* FUNCTION FOR DISPLAYING VESSEL PARTICULARS */

    function particulars() {
        //  $voyageno = $this->input->post('voyageno');
        $vesselname = $this->input->post('vesselname');

        //    if (!empty($voyageno) && !empty($vesselname)) {
        if (!empty($vesselname)) {
            //       $data = $this->main_model->getparticulars($voyageno, $vesselname);
            $data = $this->main_model->getparticulars($vesselname);
            echo json_encode($data);
        }
    }

    /* FUNCTION FOR ADD VESSEL DETAILS */

    function add_vessel() {
        $sessionid = $this->session->userdata('sessionid');                     // GET SESSION ID/USER ID FROM DBASE
        if (empty($sessionid)) {
            redirect('login', 'refresh');
        } else if (!empty($this->input->post())) {
            $scn = $this->input->post('scn');
            $voyageno = $this->input->post('voyageno');
            $vesselcode = $this->input->post('vesselcode');
            $vesselname = strtoupper($this->input->post('vesselname'));
            $grt = $this->input->post('grt');
            $nrt = $this->input->post('nrt');
            $dwt = $this->input->post('dwt');
            $beam = $this->input->post('beam');
            $loa = $this->input->post('loa');
            $draft = $this->input->post('draft');

            $data = array(
                'vesselcode' => $vesselcode,
                'scn' => $scn,
                'voyageno' => $voyageno,
                'vesselname' => $vesselname,
                'grt' => $grt,
                'nrt' => $nrt,
                'dwt' => $dwt,
                'beam' => $beam,
                'loa' => $loa,
                'draft' => $draft);
            if ($this->main_model->save_vessel($data)) {
                redirect('home/add_vessel/?action=add_vessel&status=success');
            } else {
                redirect('home/add_vessel/?action=add_vessel&status=error');
            }
        } else {
            $data['data'] = $this->main_model->group_vessels();
            $this->load->view('home', $data);
        }
    }

    /* FUNCTION FOR DISPLAYING ALL VESSEL DETAILS */

    function view_vessels() {
        $sessionid = $this->session->userdata('sessionid');                     // GET SESSION ID/USER ID FROM DBASE
        if (empty($sessionid)) {
            redirect('login', 'refresh');
        } else {
            $data['data'] = $this->main_model->vessel_names();
            $this->load->view('home', $data);
        }
    }

    /* FUNCTION FOR DISPLAYING SPECIFIC VESSEL DETAILS */

    function specific_vessel() {
        $sessionid = $this->session->userdata('sessionid');                     // GET SESSION ID/USER ID FROM DBASE
        $vesselid = $this->input->get('id');
        if (empty($sessionid)) {
            redirect('login', 'refresh');
        } else {
            $data['data'] = $this->main_model->view_details($vesselid);
            $this->load->view('home', $data);
        }
    }

    /* FUNCTION FOR UPDATING VESSEL DETAILS */

    function update_vessel() {
        $sessionid = $this->session->userdata('sessionid');                     // GET SESSION ID/USER ID FROM DBASE
        $vesselid = $this->input->post('vesselid');
        if (empty($sessionid)) {
            redirect('login', 'refresh');
        } else if (!empty($this->input->post())) {
            $scn = $this->input->post('scn');
            $vesselcode = $this->input->post('vesselcode');
            $voyageno = $this->input->post('voyageno');
            $vesselname = strtoupper($this->input->post('vesselname'));
            $grt = $this->input->post('grt');
            $nrt = $this->input->post('nrt');
            $dwt = $this->input->post('dwt');
            $beam = $this->input->post('beam');
            $loa = $this->input->post('loa');
            $draft = $this->input->post('draft');
            echo $vesselcode;
            $data = array(
                'vesselcode', $vesselcode,
                'scn' => $scn,
                'voyageno' => $voyageno,
                'vesselname' => $vesselname,
                'grt' => $grt,
                'nrt' => $nrt,
                'dwt' => $dwt,
                'beam' => $beam,
                'loa' => $loa,
                'draft' => $draft);

            if ($this->main_model->update_details($data, $vesselid)) {
                redirect('home/specific_vessel/?id=' . $vesselid . '&action=update_vessel&status=success');
            } else {
                redirect('home/specific_vessel/?id=' . $vesselid . '&action=update_vessel&status=error');
            }
        }
    }

    /* FUNCTION FOR ADDING VESSEL TRANSACTION */

    function add_transaction() {
        $sessionid = $this->session->userdata('sessionid');                     // GET SESSION ID/USER ID FROM DBASE
        if (empty($sessionid)) {
            redirect('login', 'refresh');
        } else if (!empty($this->input->post())) {
            /* GET GENERAL INFORMATION VALUES */
            $vesselid = $this->input->post('vesselid');
            $transaction_id = $this->input->post('transaction_id');
            $transaction_date = $this->input->post('transaction_date');
            $scn = $this->input->post('scn');
            $voyageno = $this->input->post('voyageno');
            $vesselname = $this->input->post('vesselname');
            $berth_assignment = $this->input->post('berth_assignment');
            $typeofport = $this->input->post('typeofport');

            /* GET PARTICULAR VALUES */
            $grt = $this->input->post('grt');
            $nrt = $this->input->post('nrt');
            $dwt = $this->input->post('dwt');
            $beam = $this->input->post('beam');
            $loa = $this->input->post('loa');
            $draft = $this->input->post('draft');
        } else {
            $data['data'] = $this->main_model->vessel_transactions();
            $this->load->view('home', $data);
        }
    }

    /* FUNCTION FOR DISPLAYING THE DATABASE DATA */

    function view_transaction() {
        $this->session->unset_userdata('typeofport');
        $sessionid = $this->session->userdata('sessionid');
        if (empty($sessionid)) {
            redirect('login', 'refresh');                                        // REDIRECT TO HOMEPAGE IF SESSION ID IS SET
        } else {
            $typeofport = $this->input->get('typeofport');                      // GET THE PORT TYPE FROM THE URL
            $_SESSION['typeofport'] = $typeofport;                              // SET THE PORT TYPE SESSION
            $data['data'] = $this->main_model->view_all($typeofport);
            $this->load->view('home', $data);
        }
    }

    /* FUNCTION FOR DISPLAYING THE SPECIFIC DATABASE DATA FOR UPDATING DATABASE VALUES */

    function specific_transaction() {
        $sessionid = $this->session->userdata('sessionid');
        if (empty($sessionid)) {
            redirect('login', 'refresh');                                        // REDIRECT TO HOMEPAGE IF SESSION ID IS SET
        } else {
            $id = $this->input->get('id');
            $typeofport = $this->input->get('typeofport');                      // GET THE PORT TYPE FROM THE URL
            if ($this->main_model->display_spectransac($id, $typeofport)) {
                $data['data'] = $this->main_model->display_spectransac($id, $typeofport);
                $this->load->view('home', $data);
            }
        }
    }

    /* FUNCTION FOR DISPLAYING THE SPECIFIC DATABASE DATA BASED ON THE TYPE OF MOVEMENT AND DATE OR ARRIVAL/DEPARTURE */

    function display_date() {
        $sessionid = $this->session->userdata('sessionid');
        $typeofport = $this->session->userdata('typeofport');
        if (empty($sessionid)) {
            redirect('login', 'refresh');                                        // REDIRECT TO HOMEPAGE IF SESSION ID IS SET
        }
        if (!empty($this->input->post())) {
            $typeofmovement = $this->input->post('typeofmovement');
            if (!empty($this->input->post('ata'))) {
                $ata = $this->input->post('ata');
                $data['ata'] = $ata;
            } else if (!empty($this->input->post('etd'))) {
                $etd = $this->input->post('etd');
                $data['etd'] = $etd;
            } else if (!empty($this->input->post('atd'))) {
                $atd = $this->input->post('atd');
                $data['atd'] = $atd;
            }
            if (!empty($ata)) {
                $data['data'] = $this->main_model->view_ata($typeofport, $typeofmovement, $ata);
            } else if (!empty($etd)) {
                $data['data'] = $this->main_model->view_etd($typeofport, $typeofmovement, $etd);
            } else if (!empty($atd)) {
                $data['data'] = $this->main_model->view_atd($typeofport, $typeofmovement, $atd);
            } else {
                $data['data'] = $this->main_model->view_typeofmovement($typeofport, $typeofmovement);
            }
            $data['typeofmovement'] = $typeofmovement;
            $this->load->view('home', $data);
        }
    }

    /* FUNCTION FOR DISPLAYING THE SPECIFIC DATABASE DATA BASED ON THE TRANSACTION DATE */

    function display_transacdate() {
        $sessionid = $this->session->userdata('sessionid');
        $typeofport = $this->session->userdata('typeofport');
        if (empty($sessionid)) {
            redirect('login', 'refresh');                                        // REDIRECT TO HOMEPAGE IF SESSION ID IS SET
        } else if (!empty($this->input->post())) {
            if (!empty($this->input->post('transaction_date'))) {
                $transaction_date = $this->input->post('transaction_date');
                $data['data'] = $this->main_model->view_transactiondate($typeofport, $transaction_date);
                $data['transaction_date'] = $transaction_date;
            } else if (!empty($this->input->post('status'))) {
                $status = $this->input->post('status');
                $data['data'] = $this->main_model->view_status($typeofport, $status);
                $data['status'] = $status;
            }
            $this->load->view('home', $data);
        }
        $this->load->view('home');
    }

    /* FUNCTION FOR UPDATING DATABASE DATA */

    function update_transaction() {
        $sessionid = $this->session->userdata('sessionid');
        if (empty($sessionid)) {
            redirect('login', 'refresh');                                        // REDIRECT TO HOMEPAGE IF SESSION ID IS SET
        } else if (!empty($this->input->post())) {
            $typeofport = $this->input->post('typeofport');
            /* GET VESSEL DETAILS */
            $id = $this->input->post('id');
            $scn = $this->input->post('scn');
            $vesselname = $this->input->post('vesselname');
            $voyageno = $this->input->post('voyageno');
            $grt = $this->input->post('grt');
            $nrt = $this->input->post('nrt');
            $dwt = $this->input->post('dwt');
            $beam = $this->input->post('beam');
            $loa = $this->input->post('loa');
            $draft = $this->input->post('draft');
            /* PLACE ALL DATA/VALUES IN AN ARRAY */
            $data = array('scn' => $scn,
                'vesselname' => $vesselname,
                'voyageno' => $voyageno,
                'grt' => $grt,
                'nrt' => $nrt,
                'dwt' => $dwt,
                'beam' => $beam,
                'loa' => $loa,
                'draft' => $draft
            );

            if (!empty($data) && !empty($vesselid)) {
                $this->main_model->update_details($data, $vesselid);
            }

            /* GET VESSEL TRANSACTION DETAILS */
            $berth_assignment = $this->input->post('berth_assignment');
            $transaction_date = $this->input->post('transaction_date');
            $transaction_time = $this->input->post('transaction_time');
            $transaction_datetime = $transaction_date . " " . $transaction_time;

            /* GET ANCHORAGE - ATA VALUES */
            if (!empty($this->input->post('anchor_ata'))) {
                $anchor_ata = $this->input->post('anchor_ata');
            } else {
                $anchor_ata = NULL;
            }
            /* GET ANCHORAGE - ATD VALUES */
            if (!empty($this->input->post('anchor_atd'))) {
                $anchor_atd = $this->input->post('anchor_atd');
            } else {
                $anchor_atd = NULL;
            }
            /* GET BERTH - ATA VALUES */
            if (!empty($this->input->post('berth_ata'))) {
                $berth_ata = $this->input->post('berth_ata');
            } else {
                $berth_ata = NULL;
            }
            /* GET BERTH - ETD VALUES */
            if (!empty($this->input->post('berth_etd'))) {
                $berth_etd = $this->input->post('berth_etd');
            } else {
                $berth_etd = NULL;
            }
            /* GET BERTH - ATD VALUES */
            if (!empty($this->input->post('berth_atd'))) {
                $berth_atd = $this->input->post('berth_atd');
            } else {
                $berth_atd = NULL;
            }
            /* GET PORT OF CALL VALUES */
            $lastport = $this->input->post('lastport');
            $nextport = $this->input->post('nextport');

            /* GET PASSENGERS VALUES */
            $passengerin = $this->input->post('passengerin');
            $passengerout = $this->input->post('passengerout');

            /* GET PAYMENT VALUES */
            $ornum = $this->input->post('ornum');
            $payment = $this->input->post('payment');

            if (!empty($this->input->post('ppa_id'))) {
                $ppa_signature = $this->input->post('ppa_id');
            } else {
                $ppa_signature = $sessionid;
            }

            if (!empty($this->input->post('ppa_idaddstay'))) {
                $ppa_addstaysign = $this->input->post('ppa_idaddstay');
            } else {
                $ppa_addstaysign = $sessionid;
            }

            /* GET APPROVED VALUE */
            $approved = $this->input->post('approvedoption');
            if ($approved == "Yes") {
                $status = "done";
            } else if ($approved == "No") {
                $ppa_signature = NULL;
                $status = "pending";
            }

            /* GET ADDITIONAL STAY VALUES */
            if (!empty($this->input->post('addnumstay'))) {
                $addnumstay = $this->input->post('addnumstay');
                $ornumaddstay = $this->input->post('ornumaddstay');
                $paymentaddstay = $this->input->post('paymentaddstay');
                $addapprovedoption = $this->input->post('addapprovedoption');
            } else {
                $addnumstay = NULL;
                $ornumaddstay = NULL;
                $paymentaddstay = NULL;
                $ppa_addstaysign = NULL;
            }

            /* GET APPROVED VALUE FOR ADDITIONAL STAY */
            if (!empty($addapprovedoption)) {
                if ($addapprovedoption == "Yes") {
                    $status = "done";
                } else {
                    $ppa_addstaysign = NULL;
                    $status = "pending";
                }
            }

            /* PLACE ALL DATA/VALUES IN AN ARRAY */
            $data = array(
                'berth_assignment' => $berth_assignment,
                'transaction_datetime' => $transaction_datetime,
                'anchor_ata' => $anchor_ata,
                'anchor_atd' => $anchor_atd,
                'berth_ata' => $berth_ata,
                'berth_etd' => $berth_etd,
                'berth_atd' => $berth_atd,
                'lastport' => $lastport,
                'nextport' => $nextport,
                'passengerin' => $passengerin,
                'passengerout' => $passengerout,
                'ornum' => $ornum,
                'payment' => $payment,
                'ppa_signature' => $ppa_signature,
                'addnumstay' => $addnumstay,
                'ornum_addstay' => $ornumaddstay,
                'payment_addstay' => $paymentaddstay,
                'ppa_addstaysign' => $ppa_addstaysign,
                'status' => $status
            );

            /* UPDATE VESSEL INFORMATION */
            if ($this->main_model->update_spectransac($data, $id)) {
                redirect('home/specific_transaction/?id=' . $id . '&action=update_transaction&status=success&typeofport=' . $typeofport);
            }
        }
    }

    /* FUNCTION FOR VIEWING REPORT FOR REPORT GENERATION */

    function view_report() {
        $this->session->unset_userdata('typeofport');
        $sessionid = $this->session->userdata('sessionid');
        if (empty($sessionid)) {
            redirect('login', 'refresh');                                        // REDIRECT TO HOMEPAGE IF SESSION ID IS SET
        }
        if (!empty($this->input->get('typeofport'))) {
            $typeofport = $this->input->get('typeofport');                      // GET THE PORT TYPE FROM THE URL
            $_SESSION['typeofport'] = $typeofport;                              // SET THE PORT TYPE SESSION
        }
        if ($this->input->post()) {
            $report_type = $this->input->post('report_type');
            $data['report_type'] = $report_type;
            if (!empty($this->input->post('daily_report'))) {
                $dailyreport = $this->input->post('daily_report');
                $data['daily_report'] = $dailyreport;
                $data['data'] = $this->main_model->view_transactiondate($typeofport, $dailyreport);
            } else if (!empty($this->input->post('weekly_from')) && !empty($this->input->post('weekly_to'))) {
                $weekly_from = $this->input->post('weekly_from');
                $weekly_to = $this->input->post('weekly_to');
                $data['weekly_from'] = $weekly_from;
                $data['weekly_to'] = $weekly_to;
                $data['data'] = $this->main_model->view_weekly($typeofport, $weekly_from, $weekly_to);
            } else if (!empty($this->input->post('monthly_report'))) {
                $monthly_report = $this->input->post('monthly_report');
                $data['monthly_report'] = $monthly_report;
                $month = date('m', strtotime($monthly_report));
                $year = date('Y', strtotime($monthly_report));
                $data['data'] = $this->main_model->view_monthly($typeofport, $month, $year);
            } else if (!empty($this->input->post('yearly_report'))) {
                $yearly_report = $this->input->post('yearly_report');
                $data['yearly_report'] = $yearly_report;
                $data['data'] = $this->main_model->view_yearly($typeofport, $yearly_report);
            }
        } else {
            $data['data'] = $this->main_model->view_all($typeofport);
        }
        $this->load->view('home', $data);
    }

    /* FUNCTION FOR GENERATING PDF REPORT */

    function generate_report() {
        $typeofport = $this->input->post('typeofport');
        if (!empty($this->input->post('daily_report'))) {
            $dailyreport = $this->input->post('daily_report');
            $data['data'] = $this->main_model->report_daily($typeofport, $dailyreport);
        } else if (!empty($this->input->post('weekly_from')) && !empty($this->input->post('weekly_to'))) {
            $weekly_from = $this->input->post('weekly_from');
            $weekly_to = $this->input->post('weekly_to');
            $data['data'] = $this->main_model->report_weekly($typeofport, $weekly_from, $weekly_to);
        } else if (!empty($this->input->post('monthly_report'))) {
            $monthly_report = $this->input->post('monthly_report');
            $month = date('m', strtotime($monthly_report));
            $year = date('Y', strtotime($monthly_report));
            $data['data'] = $this->main_model->report_monthly($typeofport, $month, $year);
        } else if (!empty($this->input->post('yearly_report'))) {
            $yearly_report = $this->input->post('yearly_report');
            $data['data'] = $this->main_model->report_yearly($typeofport, $yearly_report);
        } else {
            $data['data'] = $this->main_model->display_transactions($typeofport);
        }
        echo json_encode($data);
    }

}
