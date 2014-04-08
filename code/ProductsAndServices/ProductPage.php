<?php

class ProductPage extends Page {

    static $db = array(
        'Price' => 'int',
        'SalePrice' => 'int',
        'Featured' => 'boolean',
    );
    static $has_one = array();
    static $has_many = array();
    static $defaults = array(
        'showInMenu' => '0'
    );
    static $allowed_children = array();

    public function getCMSFields() {
        $fields = parent::getCMSFields();
        $FieldsArray = array(
            new NumericField('Price'),
            new NumericField('SalePrice'),
            new CheckboxField('Featured')
        );
        $fields->addFieldsToTab('Root.ProductOptions', $FieldsArray);
        return $fields;

    }

//    public function Render_Title($Template = null) {
//
//        $renderWith = array();
//        $renderWith[] = 'Title';
//        $renderWith[] = "PageTitle";
//        $renderWith[] = $this->owner->ClassName . "_Title";
//        if ($Template) {
//            $renderWith[] = $Template;
//        }
//        return $this->renderWith($renderWith);
//
//    }
}


// Page_controller is only created when page is actually visited
class ProductPage_Controller extends Page_Controller {

    // This will inherit Controller from parent
    function init() {
        parent::init();

    }

}

