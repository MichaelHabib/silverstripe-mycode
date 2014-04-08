<?php

class BasicMember extends Member {

    static $db = array(
        'Phone' => 'int',
        'FacebookURL' => 'text',
        'TwitterURL' => 'text',
        'GoogleURL' => 'text',
        'Details' => 'HTMLText',
        'AboutMe' => 'HTMLText',
    );
    static $has_one = array(
        'Photo' => 'image',
        'Resume' => 'file'
    );

    function getCMSFields() {
        $fields = parent::getCMSFields();

//        $fields->removeByName('Locale');
//        $fields->removeByName('DateFormat');
//        $fields->removeByName('TimeFormat');
//        $fields->removeByName('Password');
        
        
        $newFieldsArray = array (
           new TextField('FacebookURL'),
           new TextField('TwitterURL'),
           new TextField('GoogleURL')
        );
        $fields->addFieldsToTab('Root.Main', $newFieldsArray);
        return $fields;
    }

//    public function getCMSValidator() {
//        return new RequiredFields('FirstName','Surname','AboutMe','Phone');
//    }

    public static $default_sort = 'SortID Asc';
    public static $summary_fields = array(
        'SortID' => 'SortID',
        'ID' => 'ID',
        'FirstName' => 'FirstName',
        'Surname' => 'Surname',
        'Phone' => 'Phone',
    );
    
    static $defaults = array(
        'FirstName'=>'FirstName',
        'Email'=>'member@designerx.com.au'        
        );
}
