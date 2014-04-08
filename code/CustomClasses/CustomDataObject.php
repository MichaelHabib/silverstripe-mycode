<?php

class CustomDataObject extends Dataobject {

//    static $singular_name = 'ExamplePage';
//    static $plural_name = 'ExamplePages';
    /* Add fields to the databse in $db
     * Data Types : 
     * Varchar(255) | HTMLVarchar(255) | Text | HTMLText | 
     * Boolean | "Enum('Opt1, Opt2')'DefaultOptHere'"|
     * Int | Decimal | Currency | Percentage | Date | SS_Datetime | Time | 
     */
    private static $db = array(
    );
    private static $has_one = array(
    );
    private static $has_many = array(
    );
    private static $many_many = array(
    );
    static $required_fields = array();
    static $unique_fields = array();

    function getCMSFields() {

        $fields = parent::getCMSFields();
        /* ---------------- */


        return $fields;

    }

//    public static $default_sort = 'SortID Asc';

    function canCreate($Member = null) {

        return true;

    }

    function canEdit($Member = null) {

        return true;

    }

    function canView($Member = null) {
        return true;

    }

    function canDelete($Member = null) {
        return true;

    }

    /**
     * This function is used in the validate() to make sure the supplied fields have unique values.
     * @return array List of fields that must have unique values. 
     */
    static function getUniqueFields() {
        $UniqueFields = static::$unique_fields;
        if (isset(parent::$unique_fields)) {
            $getParentUniqueFields = parent::$unique_fields;
            $UniqueFields = array_merge($UniqueFields, $getParentUniqueFields);
        }
        return $UniqueFields;

    }

    static function getRequiredFields() {
        $required_fields = static::$required_fields;
        if (isset(parent::$required_fields)) {
            $getParent_required_fields = parent::$required_fields;
            $required_fields = array_merge($required_fields, $getParent_required_fields);
        }
        return $required_fields;

    }

    protected function validate() {
        $result = parent::validate();
        $unique_fields = static::getUniqueFields();
        if ($unique_fields) {
            foreach ($unique_fields as $unique_field)
                if (self::get()->filter(array($unique_field => $this->getField($unique_field)))->exclude('ID', $this->ID)->exists()) {
                    $result->error("$unique_field must be unique.");
                }
        }
        $required_fields = static::getRequiredFields();
        if ($required_fields) {
            foreach ($required_fields as $required_field)
                if (!$this->$required_field) {
                    $result->error("$required_field is required.");
                }
        }
//        $this->extend('validate', $result);
        return $result;

    }

}

