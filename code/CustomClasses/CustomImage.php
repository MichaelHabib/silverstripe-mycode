<?php

class CustomImage extends Image {

//    static $singular_name = 'ExamplePage';
//    static $plural_name = 'ExamplePages';
    /* Add fields to the databse in $db
     * Data Types : 
     * Varchar(255) | HTMLVarchar(255) | Text | HTMLText | 
     * Boolean | "Enum('Opt1, Opt2')'DefaultOptHere'"|
     * Int | Decimal | Currency | Percentage | Date | SS_Datetime | Time | 
     */
    static $db = array(
    );
    static $has_one = array(
    );
    static $has_many = array(
    );
    static $many_many = array(
    );

    function getCMSFields() {
        $fields = parent::getCMSFields();

        return $fields;

    }

}


