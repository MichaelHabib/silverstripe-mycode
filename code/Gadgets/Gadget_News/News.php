<?php

class News extends CustomDataObject {

    static $db = array(
        'SortID' => 'int',
        'Title' => 'text',
        'Content' => 'HTMLText'
    );
    static $has_one = array(
        'Page' => 'Page'
    );
    public static $defaults = array(
        'Title' => 'News Item',
        'Content' => 'This is the default content. Please login to edit this section.'
    );
    public static $summary_fields = array(
        "Title" => array(
            'Title' => 'Title',
            'Field' => 'TextField',
        ),
        "Content" => array(
            'Title' => 'Content',
            'Field' => 'TextField',
        ),
    );

//    static $title = "ChildrenPages";
//    static $cmsTitle = "ChildrenPages";
//    static $description = "get ChildrenPages of this page.";

    public function getCMSFields() {
        $fields = parent::getCMSFields();
        $fields->removeByName('Main');
        $newFieldsArray = array(
            TextField::create('Title'),
            DropdownField::create('PageID', 'Link Title to : ', Page::get()->Map("ID", "Title"))->setEmptyString('None'),
            HtmlEditorField::create('Content')
        );
        $fields->addFieldsToTab('Root.Main', $newFieldsArray);
        return $fields;

//        return new FieldList($newFieldsArray);

    }

}
