<?php

class Gadget_ContactInfo extends Gadget {

    static $db = array(
    );
    static $has_one = array(
        "Page" => 'Page',
    );
    static $has_many = array(
    );
    static $many_many = array(
        'ContactInfoRows' => 'ContactInfoRow'
    );
    static $defaults = array(
    );

//    static $title = "ChildrenPages";
//    static $cmsTitle = "ChildrenPages";
//    static $description = "get ChildrenPages of this page.";

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        $newFieldsArray = array(
        );
        $fields->insertAfter(DropdownField::create('PageID', 'Link Title to : ', Page::get()->Map("ID", "Title"))->setEmptyString('None'), 'Title');

        $fields->removeByName('ContactInfoRows');
        $GridField = new GridField('ContactInfoRows', 'ContactInfoRows', $this->ContactInfoRows());
        $GridField_Config = GridFieldConfig_MultiClassFullControl::create();
        $GridField_Config->getComponentByType('GridFieldAddNewButton')->setButtonName('Add New Contact Info');
        $GridField->setConfig($GridField_Config);
        $fields->addFieldsToTab('Root.Content', $GridField);
        return $fields;

    }

    public function TitleLink() {
        if ($this->Page()->exists()) {
            return $this->Page()->Link;
        }

    }
//
//    public function forTemplate() {
//        $renderWith = array();
//        if ($this->Template) {
//            $renderWith[] = $this->Template;
//        }
//        $renderWith[] = $this->ClassName;
////        $renderWith[] = 'Gadget';
//        return $this->renderWith($renderWith);
//
//    }



}

