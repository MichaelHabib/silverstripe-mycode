<?php

class FAQ extends CustomDataObject {

    static $singular_name = 'FAQs';
//    static $plural_name = '';
//    static $icon = '';
    /* Add fields to the databse
     * Data Types : 
     * Varchar(255) | HTMLVarchar(255) | Text | HTMLText | 
     * Boolean | "Enum('Opt1, Opt2')'Default'"|
     * Int | Decimal | Currency | Percentage | Date | SS_Datetime | Time | 
     */
    static $db = array(
        'SortID'=>'int',
        'Q' => 'Text',
        'A' => 'Text'
    );
    static $has_one = array(
        'Page' => 'FAQs'
    );
    static $has_many = array(
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
        return $fields;
    }

    // Add comments section to the page by Default
    static $defaults = array(
        'Q' => 'Question',
        'A' => 'Answer');

}
