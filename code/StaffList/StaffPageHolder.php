<?php

class StaffPageHolder extends Page {
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
    /* Add Fields to the CMS in getCMSFields()
     * Input field available:
     * AjaxUniqueTextField | CreditCardField | CurrencyField | EmailField | UniqueRestrictedTextField | 
     * UniqueTextField | HTMLEditorField | SimpleHTMLEditorField | NumericField | 
     * AutocompleteTextField | ConfirmedPasswordField | PasswordField | 
     */

    function getCMSFields() {

        $fields = parent::getCMSFields();
        return $fields;
    }

    // Add comments section to the page by Default
    static $defaults = array(
        'ProvideComments' => false
    );
    // Allowed children types under this page 
//    static $allowed_children = array(
//        'StaffPage'
//    );


    function requireDefaultRecords() {
        parent::requireDefaultRecords();
        $Page = DataObject::get_one('StaffPageHolder');
        if (!$Page) {
            $Page = new self();
            $Page->Title = "Staff Page Holder";
            $Page->URLSegment = "StaffPageHolder";
            $Page->Status = "Published";
            $Page->write();
            $Page->publish("Stage", "Live");

            $chilePage = new StaffPage();
            $chilePage->Title = "Staff Page 1";
            $chilePage->URLSegment = "StaffPage1";
            $chilePage->Status = "Published";
            $chilePage->ParentID = $Page->ID;
            $chilePage->write();
            $chilePage->publish("Stage", "Live");
            
            $chilePage = new StaffPage();
            $chilePage->Title = "Staff Page 2";
            $chilePage->URLSegment = "StaffPage2";
            $chilePage->Status = "Published";
            $chilePage->ParentID = $Page->ID;
            $chilePage->write();
            $chilePage->publish("Stage", "Live");
            
            DB::alteration_message("StaffPage created", "created");
        }
    }
}

class StaffPageHolder_Controller extends Page_Controller {

    // This will inherit Controller from parent
    function init() {
        parent::init();
    }

//    function RenderExamplePage($RenderWithTemplate=NULL) {
//        $RenderWithTemplateField = $this->data()->RenderWithTemaplte;
//        $getData = $this->data();
//        if ($RenderWithTemplate) {
//            
//        } elseif (!$RenderWithTemplate && $RenderWithTemplateField) {
//            $RenderWithTemplate = $RenderWithTemplateField;
//        } else {
//            $RenderWithTemplate = 'Page';
//        }
//
//        $renderWith = $getData->renderWith(array(
//            $RenderWithTemplate
//                ));
//        return $renderWith;
//    }
}

