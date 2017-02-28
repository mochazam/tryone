<?php
class Cart extends MX_Controller 
{

    function __construct() {
        parent::__construct();
    }

    function _draw_add_to_cart($item_id) {

        //fetch colour
        $submitted_colour = $this->input->post('submitted_colour', TRUE);
        if ($submitted_colour == "") {
            $colour_options[''] = "Select...";
        }

        $this->load->module('store_item_colours');
        $query = $this->store_item_colours->get_where_custom('item_id', $item_id);
        $data['num_colours'] = $query->num_rows();
        foreach ($query->result() as $row) {
            $colour_options[$row->id] = $row->colour;
        }

        //fetch size
        $submitted_size =$this->input->post('submitted_size', TRUE);
        if ($submitted_size == "") {
            $size_options[''] = "Select...";
        }

        $this->load->module('store_item_sizes');
        $query = $this->store_item_sizes->get_where_custom('item_id', $item_id);
        $data['num_sizes'] = $query->num_rows();
        foreach ($query->result() as $row) {
            $size_options[$row->id] = $row->size;
        }

        $data['submitted_colour'] = $submitted_colour;
        $data['submitted_size'] = $submitted_size;
        $data['colour_options'] = $colour_options;
        $data['size_options'] = $size_options;
        $data['item_id'] = $item_id;
        $this->load->view('add_to_cart', $data);
    }

}