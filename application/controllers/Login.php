<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('encryption');
        $this->load->model('main_model');
    }

    function index() {
        $sessionid = $this->session->userdata('sessionid');                     // GET SESSION ID/USER ID FROM DBASE
        if (!empty($sessionid)) {                                               // CHECK IF SESSION ID IS SET 
            $usertype = $this->session->userdata('usertype');
            if ($usertype == "administrator") {
                redirect('home/adminhome');
            } else if ($usertype == "hoo") {
                redirect('home/view_transaction/?typeofport=baseport&action=view_transaction');
            } else {
                $this->load->view('login');                                         // REDIRECT TO LOGIN PAGE IF SESSION IS NOT SET
            }
        } else {
            $this->load->view('login');                                         // REDIRECT TO LOGIN PAGE IF SESSION IS NOT SET
        }
    }

    /* FUNCTION FOR CHECKING LOGIN CREDENTIALS */

    function validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run()) {
            //true  
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $this->load->model('main_model');
            if ($this->main_model->can_login($username, $password)) {
                $usertype = $this->session->userdata('usertype');
                if ($usertype == "administrator") {
                    redirect('home/adminhome');
                } else if ($usertype == "hoo") {
                    redirect('home/view_transaction/?typeofport=baseport&action=view_transaction');
                } else {
                    $this->session->set_flashdata('error', 'Invalid Username and Password');
                    redirect('login', 'refresh');
                }
            } else {
                $this->session->set_flashdata('error', 'Invalid Username and Password');
                redirect('login', 'refresh');
            }
        } else {
            //false  
            $this->index();
        }
    }

    /* FUNCTION FOR LOGOUT */

    function logout() {
        $user_data = $this->session->all_userdata();
        foreach ($user_data as $key => $value) {
            if ($key != 'sessionid' && $key != 'usertype' && $key != 'nameofuser' && $key != 'typeofport' && $key != 'ppa_signature' && $key != 'pp' && $key != 'typeofmovement') {
                $this->session->unset_userdata($key);
            }
        }
        $this->session->sess_destroy();
        redirect('login');
    }

}
