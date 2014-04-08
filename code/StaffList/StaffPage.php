<?php

class StaffPage extends Page {
    /* Add fields to the databse in $db
     * Data Types : 
     * Varchar(255) | HTMLVarchar(255) | Text | HTMLText | 
     * Boolean | "Enum('Opt1, Opt2')'DefaultOptHere'"|
     * Int | Decimal | Currency | Percentage | Date | SS_Datetime | Time | 
     */

    static $db = array(
        'Name'=>'Text',
        'Email'=>'Text',
        'Phone'=>'Int',
        'Fax'=>'Int',
        'Website'=>'Text'

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
        $fieldsArray=array(
            new TextField('Name'),
            new TextField('Email'),
            new TextField('Phone'),
            new TextField('Fax'),
            new TextField('Website')
            
        );
        $fields->addFieldsToTab('Root.Staff Info',$fieldsArray);
        return $fields;
    }

    // Add comments section to the page by Default
    static $defaults = array(
        'ProvideComments' => false,
        'Content'=>'is simply dummy text of the printing and typesetting industry. Lorem Ipsum 
            has been the industry standard dummy text ever since the 1500s, 
            when an unknown printer took a galley of type and scrambled it 
            to make a type specimen book. It has survived not only five 
            centuries, but also the leap into electronic typesetting, 
            remaining essentially unchanged. It was popularised in the 1960s 
            with the release of Letraset sheets containing Lorem Ipsum passages,
            and more recently with desktop publishing software like Aldus 
            PageMaker including versions of Lorem Ipsum',
        'Name'=>'Staff Name',
        'Email'=>'Staff Email',
        'Phone'=>'000 000 000',
        'Fax'=>'111 111 111',
        'Website'=>'Staff Website'
    );

//    function requireDefaultRecords() {
//        parent::requireDefaultRecords();
//        $Page = DataObject::get_one('StaffPage');
//        if (!$Page) {
//            $Page = new self();
//            $Page->Title = "StaffPage";
//            $Page->URLSegment = "StaffPage";
//            $Page->Status = "Published";
//            $Page->write();
//            $Page->publish("Stage", "Live");
//
//            DB::alteration_message("StaffPage created", "created");
//        }
//    }

}

class StaffPage_Controller extends Page_Controller {

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

