<?php

class ProductsHolderPage extends Page {

    static $db = array(
    );
    static $has_one = array(
    );
    static $has_many = array(
    );
    static $allowed_children = array(
        'ProductCategoryPage',
//        'ProductPage'
        );
    
//    function requireDefaultRecords() {
//        parent::requireDefaultRecords();
//
//        if (!ProductsHolder::get()->first()) {
//            $Parent = Helper::getPage('Products Holder', 'ProductsHolder');
//
//            Helper::makePages('ProductPage', 'ProductPage', $Parent->ID, 6);
//        }
//
//    }

}


// Page_controller is only created when page is actually visited
class ProductsHolderPage_Controller extends Page_Controller {

    // This will inherit Controller from parent
    function init() {
        parent::init();

    }

}

