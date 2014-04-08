<?php

class FAQs extends Page {

    static $singular_name = 'FAQs';
    static $plural_name = 'FAQs';
//    static $icon = '';
    /* Add fields to the databse
     * Data Types : 
     * Varchar(255) | HTMLVarchar(255) | Text | HTMLText | 
     * Boolean | "Enum('Opt1, Opt2')'Default'"|
     * Int | Decimal | Currency | Percentage | Date | SS_Datetime | Time | 
     */
    static $db = array(
    );
    static $has_one = array(
    );
    static $has_many = array(
        'FAQsList' => 'FAQ'
    );

// Add Fields to the CMS to edite the Fields added to the databse
    function getCMSFields() {
        /*
         * AjaxUniqueTextField | CreditCardField | CurrencyField | EmailField | UniqueRestrictedTextField | 
         * UniqueTextField | HTMLEditorField | SimpleHTMLEditorField | NumericField | 
         * AutocompleteTextField | ConfirmedPasswordField | PasswordField | 
         */
        $fields = parent::getCMSFields();
        /*
         * Add extra basic fields to the CMS + Extra Tab 
         * $newFieldsArray = list of fields need to be added to tab
         * $newFieldsArray MUST be used to add array of fields as fields need to be declared before they can be added to a tab !
         */
        /*
         * --------------------------------------------
         * GridField(s)
         * --------------------------------------------
         *  */
        $gridFieldConfig = GridFieldConfig_RelationEditor::create();
        $gridFieldConfig->addComponents(
                new GridFieldSortableRows("SortID")
        );
//        $gridFieldConfig->getComponentByType('GridFieldAddNewButton')->setButtonName('Add New Testimonial');
        $gridField = new GridField("FAQsList", "FAQsList", $this->FAQsList(), $gridFieldConfig);
        $fields->addFieldsToTab('Root.FAQs', $gridField);
        return $fields;
    }

    // Add comments section to the page by Default
    static $defaults = array(
    );

    function onBeforeWrite() {
        parent::onBeforeWrite();
        user_error("Bad \$ids passed to applicablePagesHelper()", E_USER_ERROR);
        exit ();
    }

}

// Page_controller is only created when page is actually visited
class FAQs_Controller extends Page_Controller {

    // This will inherit Controller from parent
    function init() {
        parent::init();
//            Debug::dump($this->Testimonials());
    }

}

