<?php

class ProductCategoryPage extends Page {

    static $db = array(
    );
    static $has_one = array(
    );
    static $has_many = array(
    );
//    static $allowed_children = array('ProductPage');
}


// Page_controller is only created when page is actually visited
class ProductCategoryPage_Controller extends Page_Controller {

    // This will inherit Controller from parent
    function init() {
        parent::init();

    }

}

