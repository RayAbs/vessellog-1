<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
    /* FUNCTION FOR PROFILE */

    public function __construct() {
        parent::__construct();

        $this->load->library('encryption');
        $this->load->library('session');
        $this->load->model('main_model');
        $this->load->helper('form');
        $this->load->helper('url');
    }

    public function index() {
        $userid = $this->session->userdata('sessionid');                     // GET SESSION ID/USER ID FROM DBASE
        if (empty($userid)) {
            redirect('login', 'refresh');
        } else {
            $data['data'] = $this->main_model->user_info($userid);
            $this->load->view('profile', $data);
        }
    }

    /* FUNCTION FOR DISPLAYING DATA FROM ALL USERS */

    function view_users() {
        $sessionid = $this->session->userdata('sessionid');
        if (empty($sessionid)) {
            redirect('login', 'refresh');                                        // REDIRECT TO HOMEPAGE IF SESSION ID IS SET
        } else if (!empty($this->input->get('userid'))) {
            $data['userid'] = $this->input->get('userid');
            $userid = $data['userid'];
            $data['data'] = $this->main_model->display_specuser($userid);
            $this->load->view('home', $data);
        } else {
            $data['data'] = $this->main_model->display_users();
            $this->load->view('home', $data);
        }
    }

    /* FUNCTION FOR ADDING A NEW USER TO THE DATABASE */

    function add_user() {
        $sessionid = $this->session->userdata('sessionid');
        if (empty($sessionid)) {
            redirect('login', 'refresh');                                        // REDIRECT TO HOMEPAGE IF SESSION ID IS SET
        } else if (!empty($this->input->post())) {
            $username = $this->input->post('username');
            $defaultpassword = "password@1";
            $password = password_hash($defaultpassword, PASSWORD_DEFAULT);
            $company_id = $this->input->post('company_id');
            $company_name = $this->input->post('company_name');
            $fname = $this->input->post('fname');
            $mname = $this->input->post('mname');
            $lname = $this->input->post('lname');
            $userpp = "default.png";
            $usertype = $this->input->post('usertype');
            $data = array('username' => $username,
                'password' => $password,
                'company_id' => $company_id,
                'company_name' => $company_name,
                'fname' => $fname,
                'mname' => $mname,
                'lname' => $lname,
                'pp' => $userpp,
                'usertype' => $usertype,
            );
            if ($this->main_model->save_user($data)) {
                redirect('profile/add_user/?action=add_user&status=success');
            } else {
                redirect('profile/add_user/?action=add_user&status=error');
            }
        } else {
            $this->load->view('home');
        }
    }

    /* FUNCTION TO UPDATE USER GENERAL INFORMATION */

    public function update_user() {
        $usertype = $this->session->userdata('usertype');
        $session_id = $this->session->userdata('sessionid');
        if ($usertype == "administrator") {
            $userid = $this->input->get('userid');
        } else {
            $userid = $this->session->userdata('sessionid');
        }

        if (empty($session_id)) {
            redirect('login', 'refresh');
        } else if (!empty($this->input->post())) {
            $firstname = $this->input->post('firstname');
            $middlename = $this->input->post('middlename');
            $lastname = $this->input->post('lastname');
            $company_id = $this->input->post('company_id');
            $username = $this->input->post('username');
            if (!empty($this->input->post('userid'))) {
                $userid = $this->input->post('userid');
            }
            if ($this->main_model->update_info($username, $userid, $firstname, $middlename, $lastname, $company_id)) {
                if ($usertype == "administrator") {
                    redirect('profile/update_user/?action=update_user&userid=' . $userid . '&status=success');
                } else {
                    $this->session->set_flashdata('success', 'Sucessfully Updated User Data!');
                    redirect('profile?action=viewprofile&active=info', 'refresh');
                }
            }
        } else {
            if ($usertype == "administrator") {
                $data['data'] = $this->main_model->user_info($userid);
                $this->load->view('home', $data);
            }
        }
    }

    /* FUNCTION TO UPDATE USER PROFILE PICTURE */

    public function update_profilepic() {
        $userid = $this->session->userdata('sessionid');
        if (empty($userid)) {
            redirect('login', 'refresh');
        }

        $config['upload_path'] = './assets/images/userpics/';
        $config['allowed_types'] = 'gif|jpg|png';
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('profilepic')) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('error', 'File was not uploaded!' . " " . $error);
            redirect('profile?action=viewprofile&active=pp', 'refresh');
        } else {
            $profilepic = $this->upload->data('file_name');
            if ($this->main_model->update_profilepic($userid, $profilepic)) {
                $data['pp'] = $profilepic;
                $this->session->set_userdata($data);
                $this->session->set_flashdata('success', 'Sucessfully Updated Profile Picture!');
                redirect('profile?action=viewprofile&active=pp', 'refresh');
            }
        }
    }

    /* FUNCTION TO UPDATE USER SIGNATURE */

    public function update_signature() {
        $userid = $this->session->userdata('sessionid');
        $usertype = $this->session->userdata('usertype');
        if (empty($userid)) {
            redirect('login', 'refresh');
        }
        if ($usertype == "hoo" || $usertype == "administrator") {
            $config['upload_path'] = './assets/images/signatures/ppa/';
        }
        $config['allowed_types'] = 'gif|jpg|png';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('signature')) {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', 'File was not uploaded!' . " " . $error);
            redirect('profile?action=viewprofile&active=signature', 'refresh');
        } else {
            $signature = $this->upload->data('file_name');
            if ($this->main_model->update_signature($userid, $signature)) {
                //   $data['ppa_signature'] = $signature;
                //      $this->session->set_userdata($data);
                $this->session->set_flashdata('success', 'Sucessfully Updated User Signature!');
                redirect('profile?action=viewprofile&active=signature', 'refresh');
            }
        }
    }

    /* FUNCTION TO UPDATE USER PASSWORD */

    public function update_password() {
        $userid = $this->session->userdata('sessionid');
        $password = $this->input->post('password');
        $confirmpassword = $this->input->post('confirmpassword');
        if (empty($userid)) {
            redirect('login', 'refresh');
        } else if ($password == $confirmpassword) {
            $newpassword = password_hash($password, PASSWORD_DEFAULT);
            if ($this->main_model->update_password($userid, $newpassword)) {
                $this->session->set_flashdata('success', 'Sucessfully Updated Password!');
                redirect('profile?action=viewprofile&active=password', 'refresh');
            }
        } else {
            $this->session->set_flashdata('error', 'Password does not match!');
            redirect('profile?action=viewprofile&active=password', 'refresh');
        }
    }

    /* FUNCTION TO RESET PASSWORD */

    public function reset_password() {
        $userid = $this->session->userdata('sessionid');
        if (empty($userid)) {
            redirect('login', 'refresh');
        } else if (!empty($this->input->post())) {
            $userid = $this->input->post('userid');
            $password = "t3mp_p@ssw0rd";
            $newpassword = password_hash($password, PASSWORD_DEFAULT);
            if ($this->main_model->update_password($userid, $newpassword)) {
                redirect('profile/view_users/?action=new_password&status=success&userid='.$userid, 'refresh');
            }
        } else {
            $this->load->view('home');
        }
    }

    /* FUNCTION TO RESET SIGNATURE */

    public function reset_signature() {
        $userid = $this->session->userdata('sessionid');

        if (empty($userid)) {
            redirect('login', 'refresh');
        }

        $usertype = $this->input->post('usertype');
        $userid = $this->input->post('userid');
        if ($usertype == "hoo") {
            $config['upload_path'] = './assets/images/signatures/ppa/';
        } else if ($usertype == "client") {
            $config['upload_path'] = './assets/images/signatures/client/';
        }
        $config['allowed_types'] = 'gif|jpg|png';
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('signature')) {
            $signature = $this->upload->data('file_name');
            if ($this->main_model->update_signature($userid, $signature)) {
                redirect('profile/view_users/?action=new_signature&userid=' . $userid.'&status=success', 'refresh');
            } else {
                $error = $this->upload->display_errors();
                redirect('profile/view_users/?action=new_signature&userid=' . $userid.'&status=error', 'refresh');
            }
        } else {
            $this->load->view('home');
        }
    }

}
