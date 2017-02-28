<?php
class Store_item_colours extends MX_Controller 
{

    function __construct() {
        parent::__construct();
    }

    function _delete_for_item($item_id) {
        $mysql_query = "delete from Store_item_colours where item_id=$item_id";
        $query = $this->_custom_query($mysql_query);
    }

    function delete($update_id) {
         if (!is_numeric($update_id)) {
            redirect('site_security/not_allowed');
        }

        $this->load->library('session');
        $this->load->module('site_security');
        $this->site_security->_make_sure_is_admin();

        //
        $query = $this->get_where($update_id);
        foreach ($query->result() as $row) {
            $item_id = $row->item_id;
        }

        $this->_delete($update_id);

        $flash_msg = "The colour option was successfully deleted.";
        $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
        $this->session->set_flashdata('item', $value);

        redirect('Store_item_colours/update/'.$item_id);
    }

    function submit($update_id) {
        if (!is_numeric($update_id)) {
            redirect('site_security/not_allowed');
        }

        $this->load->library('session');
        $this->load->module('site_security');
        $this->site_security->_make_sure_is_admin();

        $submit = $this->input->post('submit', TRUE);
        $colour = trim($this->input->post('colour', TRUE));

        if ($submit == "Finished") {
            redirect('store_items/create/'.$update_id);
        } elseif ($submit == "Submit") {
            
            //attempt an insert
            if ($colour != "") {
                $data['item_id'] = $update_id;
                $data['colour'] = $colour;
                $this->_insert($data);

                $flash_msg = "The new colour option was successfully added.";
                $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
                $this->session->set_flashdata('item', $value);
            }
        }

        redirect('Store_item_colours/update/'.$update_id);
    }

    function update($update_id) {
        if (!is_numeric($update_id)) {
            redirect('site_security/not_allowed');
        }

        $this->load->library('session');
        $this->load->module('site_security');
        $this->site_security->_make_sure_is_admin();

        //fetch existing data
        $data['query'] = $this->get_where_custom('item_id', $update_id);
        $data['num_rows'] = $data['query']->num_rows();
        
        $data['headline'] = "Update Item Colours";
        $data['update_id'] = $update_id;
        $data['flash'] = $this->session->flashdata('item');
        $data['view_file'] = "update";
        $this->load->module('templates');
        $this->templates->admin($data);   
    }

    function get($order_by)
    {
        $this->load->model('mdl_store_item_colours');
        $query = $this->mdl_store_item_colours->get($order_by);
        return $query;
    }

    function get_with_limit($limit, $offset, $order_by) 
    {
        if ((!is_numeric($limit)) || (!is_numeric($offset))) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_store_item_colours');
        $query = $this->mdl_store_item_colours->get_with_limit($limit, $offset, $order_by);
        return $query;
    }

    function get_where($id)
    {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_store_item_colours');
        $query = $this->mdl_store_item_colours->get_where($id);
        return $query;
    }

    function get_where_custom($col, $value) 
    {
        $this->load->model('mdl_store_item_colours');
        $query = $this->mdl_store_item_colours->get_where_custom($col, $value);
        return $query;
    }

    function _insert($data)
    {
        $this->load->model('mdl_store_item_colours');
        $this->mdl_store_item_colours->_insert($data);
    }

    function _update($id, $data)
    {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_store_item_colours');
        $this->mdl_store_item_colours->_update($id, $data);
    }

    function _delete($id)
    {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_store_item_colours');
        $this->mdl_store_item_colours->_delete($id);
    }

    function count_where($column, $value) 
    {
        $this->load->model('mdl_store_item_colours');
        $count = $this->mdl_store_item_colours->count_where($column, $value);
        return $count;
    }

    function get_max() 
    {
        $this->load->model('mdl_store_item_colours');
        $max_id = $this->mdl_store_item_colours->get_max();
        return $max_id;
    }

    function _custom_query($mysql_query) 
    {
        $this->load->model('mdl_store_item_colours');
        $query = $this->mdl_store_item_colours->_custom_query($mysql_query);
        return $query;
    }

}