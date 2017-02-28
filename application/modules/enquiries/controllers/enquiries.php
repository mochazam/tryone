<?php
class Enquiries extends MX_Controller 
{

    function __construct() {
        parent::__construct();
    }

    function _draw_customer_inbox($customer_id) {
        $folder_type = "Inbox";
        $data['customer_id'] = $customer_id;
        $data['query'] = $this->_fetch_customer_enquiries($folder_type, $customer_id);
        $data['folder_type'] = ucfirst($folder_type);
        $data['flash'] = $this->session->flashdata('item');
        $this->load->view('customer_inbox', $data);
    }

    function create() {
        $this->load->library('session');
        $this->load->module('site_security');
        $this->site_security->_make_sure_is_admin();

        $update_id = $this->uri->segment(3);
        $submit = $this->input->post('submit', TRUE);
        $this->load->module('timedate');

        if ($submit == "Cancel") {
            redirect('enquiries/inbox');
        }

        if ($submit == "Submit") {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('subject', 'Subject', 'required|max_length[250]');
            $this->form_validation->set_rules('message', 'Messsage', 'required');
            $this->form_validation->set_rules('sent_to', 'Recipient', 'required');
         
            if ($this->form_validation->run() == TRUE) {
                $data = $this->fetch_data_from_post();
                //convert datepicker into unix timestamp
                $data['date_created'] = time();
                $data['sent_by'] = 0;
                $data['opened'] = 0;

                $this->_insert($data);
                $flash_msg = "The message was successfully sent.";
                $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
                $this->session->set_flashdata('item', $value);
                redirect('enquiries/inbox/');
            
            } 
        }

        if ((is_numeric($update_id)) && ($submit!="Submit")) {
            $data = $this->fetch_data_from_db($update_id);
        } else {
            $data = $this->fetch_data_from_post();
        }

         if (!is_numeric($update_id)) {
            $data['headline'] = "Compose New Message";
        }

        $data['options'] = $this->_fetch_customer_as_options();
        $data['update_id'] = $update_id;
        $data['flash'] = $this->session->flashdata('item');
        $data['view_file'] = "create";
        $this->load->module('templates');
        $this->templates->admin($data);
    }

    function _fetch_customer_as_options() {
        $options[] = "Select Customer....";
        $this->load->module('store_accounts');
        $query = $this->store_accounts->get('lastname');
        foreach ($query->result() as $row) {
            $customer_name = $row->firstname." ".$row->lastname;

            $company_length = strlen($row->company);
            if ($company_length > 2) {
                $customer_name.= " from ".$row->company;
            }

            $customer_name = trim($customer_name);
            if ($customer_name != "") {
                $options[$row->id] = $customer_name;
            }
        }

        return $options;
    }

    function fetch_data_from_post() {
        $data['subject'] = $this->input->post('subject');
        $data['sent_to'] = $this->input->post('sent_to');
        $data['message'] = $this->input->post('message');
        return $data;
    }

    function fetch_data_from_db($update_id) {
        $query = $this->get_where($update_id);
        foreach ($query->result() as $row) {
            $data['subject'] = $row->subject;
            $data['sent_to'] = $row->sent_to;
            $data['sent_by'] = $row->sent_by;
            $data['message'] = $row->message;
            $data['date_created'] = $row->date_created;
            $data['opened'] = $row->opened;
        }

        if (!isset($data)) {
            $data = "";
        }

        return $data;
    }

    function view() {
        $this->load->module('site_security');
        $this->site_security->_make_sure_is_admin();

        $update_id = $this->uri->segment(3);
        $this->_set_to_opened($update_id);

        $data['query'] = $this->get_where($update_id);
        $data['headline'] = "Enquirie ID ".$update_id;
        $data['flash'] = $this->session->flashdata('item');
        $data['view_file'] = "view";
        $this->load->module('templates');
        $this->templates->admin($data);          
    }

    function _set_to_opened($update_id) {
        $data['opened'] = 1;
        $this->_update($update_id, $data);
    }

    function inbox() {
        $this->load->module('site_security');
        $this->site_security->_make_sure_is_admin();

        $folder_type = "inbox";
        $data['query'] = $this->_fetch_enquiries($folder_type);
        $data['folder_type'] = ucfirst($folder_type);

        $data['flash'] = $this->session->flashdata('item');
        $data['view_file'] = "view_enquiries";
        $this->load->module('templates');
        $this->templates->admin($data);  
    }

    function _fetch_enquiries($folder_type) {
        //$mysql_query = "select * from enquiries where sent_to=0 order by date_created desc";

        $mysql_query = "
            SELECT enquiries.*,
            store_accounts.firstname,
            store_accounts.lastname,
            store_accounts.company
            FROM enquiries INNER JOIN store_accounts ON enquiries.sent_by = store_accounts.id
            WHERE enquiries.sent_to=0 
            ORDER BY enquiries.date_created DESC
        ";
        $query = $this->_custom_query($mysql_query);
        return $query;
    }

    function _fetch_customer_enquiries($folder_type, $customer_id) {
        $mysql_query = "
            SELECT enquiries.*,
            store_accounts.firstname,
            store_accounts.lastname,
            store_accounts.company
            FROM enquiries INNER JOIN store_accounts ON enquiries.sent_to = store_accounts.id
            WHERE enquiries.sent_to=$customer_id 
            ORDER BY enquiries.date_created DESC
        ";
        $query = $this->_custom_query($mysql_query);
        return $query;
    }

    function get($order_by)
    {
        $this->load->model('mdl_enquiries');
        $query = $this->mdl_enquiries->get($order_by);
        return $query;
    }

    function get_with_limit($limit, $offset, $order_by) 
    {
        if ((!is_numeric($limit)) || (!is_numeric($offset))) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_enquiries');
        $query = $this->mdl_enquiries->get_with_limit($limit, $offset, $order_by);
        return $query;
    }

    function get_with_double_condition($col1, $value1, $col2, $value2) 
    {
        $this->load->model('mdl_enquiries');
        $query = $this->mdl_enquiries->get_with_double_condition($col1, $value1, $col2, $value2) ;
        return $query;
    }

    function get_where($id)
    {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_enquiries');
        $query = $this->mdl_enquiries->get_where($id);
        return $query;
    }

    function get_where_custom($col, $value) 
    {
        $this->load->model('mdl_enquiries');
        $query = $this->mdl_enquiries->get_where_custom($col, $value);
        return $query;
    }

    function _insert($data)
    {
        $this->load->model('mdl_enquiries');
        $this->mdl_enquiries->_insert($data);
    }

    function _update($id, $data)
    {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_enquiries');
        $this->mdl_enquiries->_update($id, $data);
    }

    function _delete($id)
    {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_enquiries');
        $this->mdl_enquiries->_delete($id);
    }

    function count_where($column, $value) 
    {
        $this->load->model('mdl_enquiries');
        $count = $this->mdl_enquiries->count_where($column, $value);
        return $count;
    }

    function get_max() 
    {
        $this->load->model('mdl_enquiries');
        $max_id = $this->mdl_enquiries->get_max();
        return $max_id;
    }

    function _custom_query($mysql_query) 
    {
        $this->load->model('mdl_enquiries');
        $query = $this->mdl_enquiries->_custom_query($mysql_query);
        return $query;
    }

}