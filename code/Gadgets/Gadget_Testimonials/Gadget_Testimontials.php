<?php

class Gadget_Testimonials extends Gadget {

    static $db = array(
    );
    static $has_one = array(
    );
    static $has_many = array(
    );
    static $defaults = array(
    );


    public function getCMSFields() {
        $fields = parent::getCMSFields();
        $GridField_Config = GridFieldConfig_RecordEditor::create();
        $GridField = GridField::create('Testimonials', 'testimonials', Testimonial::get(), $GridField_Config);
        $fields->addFieldsToTab('Root.Testimonials', $GridField);

        return $fields;

    }
    public function Testimonials() {
        return Testimonial::get();

    }
}


