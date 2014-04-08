<?php

class CatalogTree extends Page {
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
        'ProvideComments' => false,
        'Content' => '
 Phasellus faucibus mattis mauris sit amet vestibulum. Fusce volutpat, sem in tempus gravida, libero nisl dignissim risus, vitae congue felis mauris vel odio. Fusce quis libero sit amet nunc convallis sagittis eleifend hendrerit elit. Morbi nec urna lorem, quis luctus tortor.
 Integer sed libero et velit dapibus auctor. Curabitur a dui a odio ultricies consequat vitae non tellus. In metus risus, laoreet et egestas nec, fringilla id nunc. Fusce sit amet leo congue velit iaculis iaculis. 
            ',
    );

    function requireDefaultRecords() {
        parent::requireDefaultRecords();
        
    }

}

class CatalogTree_Controller extends Page_Controller {

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
    public function Pagination() {
        $getChildrenPages = $this->children();
        $PaginatedList = new PaginatedList($getChildrenPages, $this->request);
        $PaginatedList->setPagelength('2');
        return $PaginatedList;
    }

    public function PaginatedPages() {
        return new PaginatedList(Page::get(), $this->request);
    }

}

