<?php
class Site_settings extends MX_Controller 
{

    function __construct() {
        parent::__construct();
    }

    function _get_support_team_name() {
        $name = "Customer Support";
        return $name;
    }

    function _get_welcome_msg($customer_id) {
        $this->load->module('store_accounts');
        $customer_name = $this->store_accounts->_get_customer_name($customer_id);

        $msg = "Hello ".$customer_name.",<br><br>";
        $msg.= "Thank you for creating an account with xxshop. if you have any question ";
        $msg.= "about any of our products and services then please do get in touch. we are here ";
        $msg.= "seven days a week and would be happy to help you.<br><br>";
        $msg.= "Regards.<br><br>";
        $msg.= "Dave (founder)";
        return $msg;
    }

    function _get_cookie_name() {
        $cookie_name = 'hasbcekcsda';
        return $cookie_name;
    }

    function _get_currency_symbol() {
        $symbol = "&pound;";
        return $symbol;
    }

    function _get_item_segments() {
        // return the segments for the store_item pages
        $segments = "musical/instrument/";
        return $segments;
    }

    function _get_items_segments() {
        // return the segments for the category pages
        $segments = "music/instruments/";
        return $segments;
    }

    function _get_page_not_found_msg() {
        $msg = "<h1>Page Not Found!</h1>";
        $msg.= "<p>Please check your vibe and try again.</p>";
        return $msg;
    }

}