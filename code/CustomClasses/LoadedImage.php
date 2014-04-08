<?php

class LoadedImage extends DataObject {

//    static $singular_name = 'ExamplePage';
//    static $plural_name = 'ExamplePages';
    /* Add fields to the databse in $db
     * Data Types : 
     * Varchar(255) | HTMLVarchar(255) | Text | HTMLText | 
     * Boolean | "Enum('Opt1, Opt2')'DefaultOptHere'"|
     * Int | Decimal | Currency | Percentage | Date | SS_Datetime | Time | 
     */
    static $db = array(
        'SortID'=>'int'
    );
    static $has_one = array(
        'Image'=>'CustomImage'
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

//     Summary fields
    public static $summary_fields = array(
        'Image.CMSThumbnail' => 'Image',
        'SortID' => 'SortID',
        'ID' => 'ID'
    );
}

