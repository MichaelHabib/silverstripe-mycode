<?php

class Gadget_News extends Gadget {

    static $db = array(
    );
    static $has_one = array(
    );
    static $has_many = array(
    );
    static $defaults = array(
    );

//    static $title = "ChildrenPages";
//    static $cmsTitle = "ChildrenPages";
//    static $description = "get ChildrenPages of this page.";

    public function getCMSFields() {
        $fields = parent::getCMSFields();


        return $fields;

    }


    public function News() {
        return News::get();

    }

}


