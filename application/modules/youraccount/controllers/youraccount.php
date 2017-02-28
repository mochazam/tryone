<?php
class Youraccount extends MX_Controller 
{

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        //$this->form_validation->CI =& $this;
    }

    function logout() {
        unset($_SESSION['user_id']);
        $this->load->module('site_cookies');
        $this->site_cookies->destroy_cookie();
        redirect(base_url());
    }

    function welcome() {
        $this->load->module('site_security');
        $this->site_security->_make_sure_logged_in();
        $data = $this->fetch_data_from_post();
        $data['flash'] = $this->session->flashdata('item');
        $data['view_file'] = "welcome";
        $this->load->module('templates');
        $this->templates->public_bootstrap($data);
    }

    function login() {
        $data['username'] = $this->input->post('username', TRUE);
        $this->load->module('templates');
        $this->templates->login($data);
    }

    function submit_login() {
        $submit = $this->input->post('submit', TRUE);
        if ($submit == "Submit") {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('username', ' Username', 'required|min_length[5]|max_length[60]|callback_username_check');
            $this->form_validation->set_rules('pword', 'Password', 'required|min_length[7]|max_length[35]');

            if ($this->form_validation->run() == TRUE) {

                $col1 = 'username';
                $value1 = $this->input->post('username', TRUE); 
                $col2 = 'email';
                $value2 = $this->input->post('email', TRUE);
                $query = $this->store_accounts->get_with_double_condition($col1, $value1, $col2, $value2);
                foreach ($query->result() as $row) {
                    $user_id = $row->id;
                }

                $remember = $this->input->post('remember', TRUE);
                if ($remember == "remember-me") {
                    $login_type = "longterm";
                } else {
                    $login_type = "shortterm";
                }

                $this->_in_you_go($user_id, $login_type);
                
            } else {
                echo validation_errors();
            }
        }

    }

    function _in_you_go($user_id, $login_type) {
        $this->load->module('site_cookies');
        if ($login_type == "longterm") {
            $this->site_cookies->_set_cookies($user_id);
        } else {
            $this->session->userdata('user_id', $user_id);
        }

        redirect('youraccount/welcome');
    }

    function submit() {
        $submit = $this->input->post('submit', TRUE);
        if ($submit == "Submit") {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('username', ' Username', 'required|min_length[5]|max_length[60]|is_unique[store_accounts.username]');
            $this->form_validation->set_rules('email', ' email', 'required|valid_email|max_length[120]');
            $this->form_validation->set_rules('pword', 'Password', 'required|min_length[7]|max_length[35]');
            $this->form_validation->set_rules('repeat_pword', 'Repeat Password', 'required|match[pword]');

            if ($this->form_validation->run() == TRUE) {

                $this->_process_create_account();

                
            } else {
                $this->start();
            }
        }

    }

    function _process_create_account() {
        $this->load->module('store_accounts');
        $this->load->module('site_security');

        $data = $this->fetch_data_from_post();
        unset($data['repeat_pword']);

        $pword = $data['pword'];
        $data['pword'] = $this->site_security->_hash_string($pword);
        $this->store_accounts->_insert($data); 
    }

    function start() {
        $data = $this->fetch_data_from_post();
        $data['flash'] = $this->session->flashdata('item');
        $data['view_file'] = "start";
        $this->load->module('templates');
        $this->templates->public_bootstrap($data);
    }

    function fetch_data_from_post() {
        $data['username'] = $this->input->post('username');
        $data['email'] = $this->input->post('email');
        $data['pword'] = $this->input->post('pword');
        $data['repeat_pword'] = $this->input->post('repeat_pword');
        return $data;
    }

    function fetch_data_from_db($update_id) {
        $query = $this->get_where($update_id);
        foreach ($query->result() as $row) {
            $data['username'] = $row->username;
            $data['email'] = $row->email;
            $data['pword'] = $row->pword;
        }

        if (!isset($data)) {
            $data = "";
        }

        return $data;
    }

    function username_check($str) {

        $this->load->module('store_accounts');
        $this->load->module('site_security');

        $error_msg = "You did not enter a correct username or password.";

        $col1 = 'username';
        $value1 = $str; 
        $col2 = 'email';
        $value2 = $str;        
        $query = $this->store_accounts->get_with_double_condition($col1, $value1, $col2, $value2);
        $num_rows = $query->num_rows();

        if ($num_rows < 1) {
           $this->form_validation->set_message('username_check', $error_msg);
           return FALSE;
        }  

        foreach ($query->result() as $row) {
            $pword_on_table = $row->pword;
        } 

        $pword = $this->input->post('pword', TRUE);
        $result = $this->site_security->_verify_hash($pword, $pword_on_table);

        if ($result == TRUE) {
            return TRUE;
        } else {
            $this->form_validation->set_message('username_check', $error_msg);
            return FALSE;
        }
    }

}