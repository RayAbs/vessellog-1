<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Error_404 extends CI_Controller {
    /* FUNCTION FOR HOME */

    public function __construct() {
        parent::__construct();

        $this->load->library('encryption');
        $this->load->library('session');
        $this->load->model('main_model');
    }

    function index() {
        $this->output->set_status_header('404');
        $this->load->view('404');
    }

}
