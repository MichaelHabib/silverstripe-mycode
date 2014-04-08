<?php

class BasicGalleryImage extends CustomDataObject {

//    static $singular_name = 'ExamplePage';
//    static $plural_name = 'ExamplePages';
    /* Add fields to the databse in $db
     * Data Types : 
     * Varchar(255) | HTMLVarchar(255) | Text | HTMLText | 
     * Boolean | "Enum('Opt1, Opt2')'DefaultOptHere'"|
     * Int | Decimal | Currency | Percentage | Date | SS_Datetime | Time | 
     */
    static $db = array(
        'SortID' => 'int',
        'Title' => 'text',
        'CustomLink' => 'text',
        'LinkTarget' => 'Text',
        'Caption' => 'HTMLText',
    );
    static $has_one = array(
        'Image' => 'Image',
        'Parent' => 'BasicGallery',
        'Page' => 'Page'
    );
    static $has_many = array();
    static $many_many = array();
    static $required_fields = array(
    );
//     Summary fields
    public static $summary_fields = array(
        'SortID' => 'SortID',
        'Image.CMSThumbnail' => 'Image',
        'ID' => 'ID',
        'Title' => 'Title',
    );

    function getCMSFields() {

        $fields = parent::getCMSFields();
        $fields->removeByName('Main');
        $newFieldsArray = array(
            UploadField::create('Image'),
            new TextField('Title'),
            new TextareaField('Caption'),
            DropdownField::create('PageID', 'Link to Page', Dataobject::get('Page')->map('Title', 'Title'))->setEmptyString('None'),
//            new CheckboxField("OpenLinkIn", 'Open Link In New Tab'),
            TextField::create('CustomLink', 'Link to ...')->setRightTitle('Place your custom URL here, this will override "Link to Page"'),
            DropdownField::create('LinkTarget', 'Link Target', array(
                "_self" => 'Current Tab',
                "_new" => 'New Tab'
            ))
        );
        $fields->addFieldsToTab('Root.Main', $newFieldsArray);
//        $this->write();
        return $fields;

    }

    public function getLink() {
        
    }

    public function ImageLink() {
        if ($link = $this->CustomLink) {
            return $link;
        }
        if ($link = $this->Page()->Link()) {
            return $link;
        }
        return false;

    }

}

