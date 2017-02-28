<?php
class Yourmessages extends MX_Controller 
{

    function __construct() {
        parent::__construct();
    }

    function create() {
        $this->load->library('session');
        $this->load->module('site_security');
        $this->site_security->_make_sure_is_admin();

        $update_id = $this->uri->segment(3);
        $submit = $this->input->post('submit', TRUE);
        $this->load->module('timedate');

        if ($submit == "Cancel") {
            redirect('yourmessages/inbox');
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
                $data['sent_by'] = $this->site_security->_get_user_id;
                $data['sent_to'] = 0;
                $data['opened'] = 0;

                $this->_insert($data);
                $flash_msg = "The message was successfully sent.";
                $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
                $this->session->set_flashdata('item', $value);
                redirect('youraccount/welcome');
            
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

    function fetch_data_from_post() {
        $data['subject'] = $this->input->post('subject');
        $data['urgent'] = $this->input->post('urgent');
        $data['message'] = $this->input->post('message');
        return $data;
    }

    function view() {
        $this->load->module('enquiries');
        $this->load->module('site_security');
        $this->load->module('timedate');
        $this->site_security->_make_sure_logged_in();

        $code = $this->uri->segment(3);
        $col1 = 'sent_to';
        $value1 = $this->site_security->_get_user_id();
        $col2 = 'code';
        $value2 = $code;
        $query = $this->enquiries->get_with_double_condition($col1, $value1, $col2, $value2);
        $num_rows = $query->num_rows();
        if ($num_rows < 1) {
            redirect('site_security/not_allowed');
        }

        foreach ($query->result() as $row) {
            $update_id = $row->id;
            $data['subject'] = $row->subject;
            $data['message'] = nl2br($row->message);
            $data['sent_to'] = $row->sent_to;
            $data['sent_by'] = $row->sent_by;
            $date_created = $row->date_created;
            $data['opened'] = $row->opened;
        }

        $data['date_created'] = $this->timedate->get_nice_date($date_created, 'full');
        $this->enquiries->_set_to_opened($update_id);

        $data['flash'] = $this->session->flashdata('item');
        $data['view_file'] = "view";
        $this->load->module('templates');
        $this->templates->public_bootstrap($data);          
    }

}