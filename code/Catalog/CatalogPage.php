<?php

class CatalogPage extends Page {
    /* Add fields to the databse in $db
     * Data Types : 
     * Varchar(255) | HTMLVarchar(255) | Text | HTMLText | 
     * Boolean | "Enum('Opt1, Opt2')'DefaultOptHere'"|
     * Int | Decimal | Currency | Percentage | Date | SS_Datetime | Time | 
     */

    static $db = array(
        'Price' => 'Int',
        'OldPrice' => 'Int',
        'isFeatured' => 'Boolean'
    );
    static $has_one = array(
    );
    static $has_many = array(
    );
    static $many_many = array(
    );

    function getCMSFields() {

        $fields = parent::getCMSFields();

        $fieldsArray = array(
            new NumericField('Price', 'Price'),
            new NumericField('OldPrice', 'Old Price'),
            new CheckBoxField('isFeatured', 'Featured Page?')
        );
        $fields->addFieldsToTab('Root.Main', $fieldsArray, 'Content');
        return $fields;
    }

}

class CatalogPage_Controller extends Page_Controller {

    // This will inherit Controller from parent
    function init() {
        parent::init();
    }


}

