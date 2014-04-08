<?php

class HomePage extends Page {

//    static $singular_name = '';
//    static $plural_name = '';
//    static $icon = '';

    static $db = array(
        'CustomPageTitle'=>'text'
    );
    static $has_one = array(
        'Logo' => 'CustomImage',
    );
    static $has_many = array(
    );

// Add Fields to the CMS to edite the Fields added to the databse
    function getCMSFields() {

        $fields = parent::getCMSFields();

        $Field_Logo = new UploadField("Logo");
        $Field_Logo->setRightTitle('Upload your logo here  <br/> 
            <strong>Hint:</strong> Its recomended to have a square image. ');
        $fields->addFieldsToTab('Root.Images', $Field_Logo, 'Image');
        $fields->insertAfter(new TextField('CustomPageTitle'), 'Title');
        return $fields;

    }

    // Add comments section to the page by Default
    static $defaults = array(
    );

    // Allowed children types under this page 
    /*
      static $allowed_children = array(
      );
     */

    function requireDefaultRecords() {
        parent::requireDefaultRecords();
//        Helper::getPage('Home', 'HomePage');

    }

}


// Page_controller is only created when page is actually visited
class HomePage_Controller extends Page_Controller {

    // This will inherit Controller from parent
    function init() {
        parent::init();

    }

}

