<?php

class ServicePage extends Page {

    static $db = array(
    );
    static $has_one = array(
    );
    static $has_many = array(
    );
    static $allowed_children = array();
}


// Page_controller is only created when page is actually visited
class ServicePage_Controller extends Page_Controller {

    // This will inherit Controller from parent
    function init() {
        parent::init();

    }

}

