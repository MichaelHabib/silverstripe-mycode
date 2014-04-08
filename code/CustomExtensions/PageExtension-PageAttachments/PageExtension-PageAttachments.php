<?php

class PageExtension_PageAttachments extends DataExtension {

    private static $db = array(
    );
    private static $has_one = array(
    );
    private static $has_many = array(
    );
    static $many_many = array(
        'Attachments' => 'PageAttachment'
    );
    public static $many_many_extraFields = array(
        'Attachments' => array(
            'Sort' => 'int',
        )
    );
    public static $defaults = array(
    );

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        $GridField_Config = GridFieldConfig_MultiClassFullControl::create();
        $orderable = new GridFieldOrderableRows('Sort');
//        $orderable->getSortTable($this->Gadgets());
        $GridField_Config->addComponent($orderable);
        $GridField = new GridField('Attachments', 'Attachments', $this->Attachments(), $GridField_Config);
        $fields->addFieldsToTab('Root.Attachments', $GridField);
        return $fields;

    }

    public function updateCMSFields(FieldList $fields) {
        
    }

}


class PageExtension_PageAttachments_ControllerExtension extends DataExtension {
    
}

