<?php
class Store_accounts extends MX_Controller 
{

    function __construct() {
        parent::__construct();
    }

    function _get_customer_name($update_id, $optional_customer_data=NULL) {
        if (!isset($optional_customer_data)) {
            $data = $this->fetch_data_from_db($update_id);
        } else {
            $data['firstname'] = $optional_customer_data['firstname'];
            $data['lastname'] = $optional_customer_data['lastname'];
            $data['company'] = $optional_customer_data['company'];
        }

        if ($data == "") {
            $customer_name = "Unknown";
        } else {
            $firstname = trim(ucfirst($data['firstname']));
            $lastname = trim(ucfirst($data['lastname']));
            $company = trim(ucfirst($data['company']));

            $company_length = strlen($company);
            if ($company_length > 2) {
                $customer_name = $company;
            } else {
                $customer_name = $firstname." ".$lastname;
            }
        }
        return $customer_name;
    }

    function update_pword() {
        $this->load->library('session');
        $this->load->module('site_security');
        $this->site_security->_make_sure_is_admin();

        $update_id = $this->uri->segment(3);
        $submit = $this->input->post('submit', TRUE);

        if (!is_numeric($update_id)) {
            redirect('store_accounts/manage');
        } elseif ($submit == "Cancel") {
            redirect('store_accounts/create/'.$update_id);
        } 

        if ($submit == "Submit") {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('pword', 'Password', 'required|min_length[7]|max_length[35]');
            $this->form_validation->set_rules('repeat_pword', 'Repeat Password', 'required|match[pword]');

            if ($this->form_validation->run() == TRUE) {
                $pword = $this->input->post('pword', TRUE);
                $this->load->module('site_security');
                $data['pword'] = $this->site_security->_hash_string($pword);

                $this->_update($update_id, $data);
                $flash_msg = "The account password was successfully updated.";
                $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
                $this->session->set_flashdata('account', $value);
                redirect('store_accounts/create/'.$update_id);
                
            } 
        }

        $data['headline'] = "Update account password";
        $data['update_id'] = $update_id;
        $data['flash'] = $this->session->flashdata('account');
        $data['view_file'] = "update_pword";
        $this->load->module('templates');
        $this->templates->admin($data);
    }

    function create() {
        $this->load->library('session');
        $this->load->module('site_security');
        $this->site_security->_make_sure_is_admin();

        $update_id = $this->uri->segment(3);
        $submit = $this->input->post('submit', TRUE);

        if ($submit == "Cancel") {
            redirect('store_accounts/manage');
        }

        if ($submit == "Submit") {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('username', ' Username', 'required');
            $this->form_validation->set_rules('firstname', 'First Name', 'required');

            if ($this->form_validation->run() == TRUE) {
                $data = $this->fetch_data_from_post();

                if (is_numeric($update_id)) {
                    $this->_update($update_id, $data);
                    $flash_msg = "The account details were successfully updated.";
                    $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
                    $this->session->set_flashdata('account', $value);
                    redirect('store_accounts/create/'.$update_id);
                } else {
                    $data['date_made'] = time();
                    $this->_insert($data);
                    $update_id = $this->get_max();

                    $flash_msg = "The account details was successfully added.";
                    $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
                    $this->session->set_flashdata('account', $value);
                    redirect('store_accounts/create/'.$update_id);
                }
            } 
        }

        if ((is_numeric($update_id)) && ($submit!="Submit")) {
            $data = $this->fetch_data_from_db($update_id);
        } else {
            $data = $this->fetch_data_from_post();
        }

         if (!is_numeric($update_id)) {
            $data['headline'] = "Add new account";
        } else {
            $data['headline'] = "Update account detail";
        }

        $data['update_id'] = $update_id;
        $data['flash'] = $this->session->flashdata('account');
        $data['view_module'] = "Store_accounts";
        $data['view_file'] = "create";
        $this->load->module('templates');
        $this->templates->admin($data);
    }

    function autogen() {
        $mysql_query = "show column from store_accounts";
        $query = $this->_custom_query($mysql_query);
        foreach ($query->result() as $row) {
            $column_name = $row->Field;

            if ($column_name != "") {
                echo '$data[\''.$column_name.'\'] = $this->input->post(\''.$column_name.'\', TRUE);<br>';
            }
        }

        foreach ($query->result() as $row) {
            $column_name = $row->Field;

            if ($column_name != "") {
                echo '$data[\''.$column_name.'\'] = $row->'.$column_name.';<br>';
            }
        }
    }

    function fetch_data_from_post() {
        $data['username'] = $this->input->post('username');
        $data['firstname'] = $this->input->post('firstname');
        $data['lastname'] = $this->input->post('lastname');
        $data['company'] = $this->input->post('company');
        $data['address1'] = $this->input->post('address1');
        $data['address2'] = $this->input->post('address2');
        $data['town'] = $this->input->post('town');
        $data['country'] = $this->input->post('country');
        $data['postcode'] = $this->input->post('postcode');
        $data['telnum'] = $this->input->post('telnum');
        $data['email'] = $this->input->post('email');
        $data['date_made'] = $this->input->post('date_made');
        $data['pword'] = $this->input->post('pword');
        return $data;
    }

    function fetch_data_from_db($update_id) {
        $query = $this->get_where($update_id);
        foreach ($query->result() as $row) {
            $data['username'] = $row->username;
            $data['firstname'] = $row->firstname;
            $data['lastname'] = $row->lastname;
            $data['company'] = $row->company;
            $data['address1'] = $row->address1;
            $data['address2'] = $row->address2;
            $data['town'] = $row->town;
            $data['country'] = $row->country;
            $data['postcode'] = $row->postcode;
            $data['telnum'] = $row->telnum;
            $data['email'] = $row->email;
            $data['date_made'] = $row->date_made;
            $data['pword'] = $row->pword;
        }

        if (!isset($data)) {
            $data = "";
        }

        return $data;
    }


    function manage() {
        $this->load->module('site_security');
        $this->site_security->_make_sure_is_admin();

        $data['query'] = $this->get('lastname');

        $data['flash'] = $this->session->flashdata('account');
        $data['view_file'] = "manage";
        $this->load->module('templates');
        $this->templates->admin($data);   
    }

    function get($order_by)
    {
        $this->load->model('mdl_store_accounts');
        $query = $this->mdl_store_accounts->get($order_by);
        return $query;
    }

    function get_with_limit($limit, $offset, $order_by) 
    {
        if ((!is_numeric($limit)) || (!is_numeric($offset))) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_store_accounts');
        $query = $this->mdl_store_accounts->get_with_limit($limit, $offset, $order_by);
        return $query;
    }

    function get_where($id)
    {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_store_accounts');
        $query = $this->mdl_store_accounts->get_where($id);
        return $query;
    }

    function get_where_custom($col, $value) 
    {
        $this->load->model('mdl_store_accounts');
        $query = $this->mdl_store_accounts->get_where_custom($col, $value);
        return $query;
    }

    function get_with_double_condition($col1, $value1, $col2, $value2) 
    {
        $this->load->model('mdl_store_accounts');
        $query = $this->mdl_store_accounts->get_with_double_condition($col1, $value1, $col2, $value2) ;
        return $query;
    }

    function _insert($data)
    {
        $this->load->model('mdl_store_accounts');
        $this->mdl_store_accounts->_insert($data);
    }

    function _update($id, $data)
    {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_store_accounts');
        $this->mdl_store_accounts->_update($id, $data);
    }

    function _delete($id)
    {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_store_accounts');
        $this->mdl_store_accounts->_delete($id);
    }

    function count_where($column, $value) 
    {
        $this->load->model('mdl_store_accounts');
        $count = $this->mdl_store_accounts->count_where($column, $value);
        return $count;
    }

    function get_max() 
    {
        $this->load->model('mdl_store_accounts');
        $max_id = $this->mdl_store_accounts->get_max();
        return $max_id;
    }

    function _custom_query($mysql_query) 
    {
        $this->load->model('mdl_store_accounts');
        $query = $this->mdl_store_accounts->_custom_query($mysql_query);
        return $query;
    }

}