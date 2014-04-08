<?php

class DataObjectExtension extends DataExtension {

    static $db = array(
    );
    static $has_one = array(
    );
    static $has_many = array(
    );
    static $many_many = array(
    );
    static $required_fields = array(
    );
    static $unique_fields = array(
    );

    //**********************************************
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

    public function Render_Title($Template = null) {

        $renderWith = array();
        if ($Template) {
            $renderWith[] = $Template;
        }
        $renderWith[] = 'Title';
        $renderWith[] = $this->owner->ClassName . "_Title";
        return $this->owner->renderWith($renderWith);

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

    /*
     * Problems with accessing static Preperty & Methods of the extended DO
     */

//    public function validate(ValidationResult $validationResult) {
////        $result = new ValidationResult();
////        $this->extend('validate', $result);
//        
//        $result = $this->owner;
//        debug::dump($result->getRequiredFields());
////        debug::dump($result->staticMethod());
////        debug::dump($result->instanceMethod());
////        debug::dump($result);
//        die;
//        $unique_fields = static::getUniqueFields();
//        if ($unique_fields) {
//            foreach ($unique_fields as $unique_field)
//                if (self::get()->filter(array($unique_field => $this->getField($unique_field)))->exclude('ID', $this->ID)->exists()) {
//                    $result->error("$unique_field must be unique.");
//                }
//        }
//        $required_fields = static::getRequiredFields();
//        if ($required_fields) {
//            foreach ($required_fields as $required_field)
//                if (!$this->$required_field) {
//                    $result->error("$required_field is required.");
//                }
//        }
//
//        return $result;
//
//    }

    public function CMSBreadcrumbsTitle() {
        if ($CMSBreadcrumbsTitle = $this->Title) {
            
        } else if ($CMSBreadcrumbsTitle = $this->Name) {
            
        } else if ($CMSBreadcrumbsTitle = $this->ID) {
            
        }
return 'xxxxxx';
        return $CMSBreadcrumbsTitle;

    }

}