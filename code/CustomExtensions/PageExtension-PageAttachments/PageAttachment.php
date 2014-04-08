<?php

class PageAttachment extends DataObject {

    private static $db = array(
    );
    private static $has_one = array(
        'Files' => 'File'
    );
    private static $has_many = array(
        'Pages' => 'PageExtension_PageAttachments'
    );
    static $many_many = array(
    );
    public static $defaults = array(
    );

    public function getCMSFields() {
        $fields = parent::getCMSFields();
        
        
        return $fields;
    }

    public function updateCMSFields(FieldList $fields) {
        
    }

}

