<?php
class Music extends MX_Controller 
{

    function __construct() {
        parent::__construct();
    }

    function instrument() {
        // figure out what the item ID is
        $cat_url = $this->uri->segment(3);
        $this->load->module('store_categories');
        $cat_id = $this->store_categories->_get_item_id_from_item_url($cat_url);
        $this->store_categories->view($cat_id);
    }

}