<?php

class BasicGallery extends CustomDataObject {

//    static $singular_name = '';
//    static $plural_name = '';
//    static $icon = '';
    /* Add fields to the databse
     * Data Types : 
     * Varchar(255) | HTMLVarchar(255) | Text | HTMLText | 
     * Boolean | "Enum('Opt1, Opt2')'Default'"|
     * Int | Decimal | Currency | Percentage | Date | SS_Datetime | Time | 
     */
    static $db = array(
        'SortID' => 'int',
        "Title" => "Text",
        "SubTitle" => "Text",
        "ImagesPerRow" => "int",
        "ImagesPerPage" => "int",
    );
    static $has_one = array(
        'Image' => 'Image'
    );
    static $has_many = array(
        'Images' => 'BasicGalleryImage'
    );
    static $many_many = array();
    static $defaults = array(
        'Title' => 'BasicGallery'
    );
    static $indexes = array();
    public static $summary_fields = array(
        'ID' => 'ID',
        'Title' => 'Title'
    );
    static $unique_fields = array('Title', 'SubTitle');

//    static $unique_fields = array('Title', 'SubTitle');
// Add Fields to the CMS to edite the Fields added to the databse
    function getCMSFields() {

        /*
         * --------------------------------------------
         * GridField(s)
         * --------------------------------------------
         * */
        $fields = parent::getCMSFields();

        $newFieldsArray = array(
            new NumericField("ImagesPerRow", "Images Per Row"),
            new NumericField("ImagesPerPage", "Images Per Page"),
            new LiteralField('Note:', "Settings above will be the default unless overridden.<br/>"),
            new NumericField('SortID'),
            new NumericField('ID'),
        );
        $fields->addFieldsToTab('Root.DefaultSettings', $newFieldsArray);
        $fields->makeFieldReadonly('ID');



//        $GridField_Config = GridFieldConfig_RecordEditor::create();
//        $GridField_Config->getComponentByType('GridFieldAddNewButton')->setButtonName('Add New Image');
//        $GridField = new GridField('Images', 'Images', $this->Images(), $GridField_Config);
        $GridField = $this->GridField_Images();
        $newFieldsArray_Main = array(
            new TextField("Title", "Title"),
            new TextField("SubTitle", "SubTitle"),
            $GridField
        );
        $fields->removeByName('Images');
        $fields->addFieldsToTab('Root.Main', $newFieldsArray_Main);
        $fields->insertBefore(new UploadField('Image', 'Cover Image'), 'Images');


        return $fields;

    }

    public function requireDefaultRecords() {
        parent::requireDefaultRecords();
        $BasicGallery = self::get_one(__CLASS__);
        if (!$BasicGallery) {
            $BasicGallery = self::create();
            $BasicGallery->Title = __CLASS__ . " Sample";
            $BasicGallery->write();

            /* create sample SimpleGalleryImage(s) */
            for ($i = 0; $i <= 5; $i++) {
                $BasicGalleryImage = new BasicGalleryImage();
                $BasicGalleryImage->Parent = $BasicGallery->ID;
                $BasicGalleryImage->write();
            }
        }

    }

    /**
     * Predifined GridFeild with settings to be used anywhere .
     */
    public function GridField_Images() {
        $GridField_Config = GridFieldConfig_RecordAndRelationEditor::create();
        $GridField_Config->getComponentByType('GridFieldAddNewButton')->setButtonName('Add New Image');
        $GridField = new GridField('Images', 'Images', $this->Images(), $GridField_Config);
        return $GridField;

    }

    public function Pagination($limit = '20') {

        $getObjects = $this->Images();
//        $PaginatedList = new PaginatedList($getObjects, array($this->request));
        $PaginatedList = new PaginatedList($this->Images(), Controller::curr()->getRequest());
        $PaginatedList->setPagelength($limit);
        return $PaginatedList;

    }

}

