<?php

class CatalogHolder extends Page {
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
     
    );
    private static $allowed_children = array('CatalogPage');

}

class CatalogHolder_Controller extends Page_Controller {

    // This will inherit Controller from parent
    function init() {
        parent::init();
    }
    public function Pagination() {
        $getChildrenPages = $this->children();
        $PaginatedList = new PaginatedList($getChildrenPages, $this->request);
        $PaginatedList->setPagelength('6');
        return $PaginatedList;
    }

    public function PaginatedPages() {
        return new PaginatedList(Page::get(), $this->request);
    }

}

