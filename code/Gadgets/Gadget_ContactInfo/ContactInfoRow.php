<?php

class ContactInfoRow  extends CustomDataObject {

    static $db = array(
        'SortID' => 'int',
        'Title' => 'text',
        'Content' => 'HTMLText'
    );
    static $has_one = array(
    );
    public static $defaults = array(
        'Title' => 'News Item',
        'Content' => 'This is the default content. Please login to edit this section.'
    );
    public static $summary_fields = array(
        "Title" => 'Title',
        "Content" => "Content"
    );

//    static $title = "ChildrenPages";
//    static $cmsTitle = "ChildrenPages";
//    static $description = "get ChildrenPages of this page.";

    public function getCMSFields() {
        $fields = parent::getCMSFields();
        $fields->removeByName('Main');
        $newFieldsArray = array(
            TextField::create('Title'),
            TextareaField::create('Content')
        );
        $fields->addFieldsToTab('Root.Main', $newFieldsArray);
        return $fields;

//        return new FieldList($newFieldsArray);

    }

}

