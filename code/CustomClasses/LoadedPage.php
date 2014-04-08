<?php
//
//class LoadedPage extends Page {
//
//    /* Add fields to the databse in $db
//     * Data Types : 
//     * Varchar(255) | HTMLVarchar(255) | Text | HTMLText | 
//     * Boolean | "Enum('Val1, Val2, Val3', 'Val1')" |
//     * Int | Decimal | Currency | Percentage | Date | SS_Datetime | Time | 
//     */
//
////    private static $singular_name = 'Page';
////    private static $plural_name = 'Pages';
//
////    static $db = array(
////        'SubTitle' => 'Text'
////    );
////    static $has_one = array(
////        'Image' => 'Image',
////        'Folder' => 'Folder'
////    );
////    static $has_many = array(
////    );
////    static $many_many = array(
////    );
//
//    function getCMSFields() {
//
//        $fields = parent::getCMSFields();
//
////        $fields->insertAfter(new TextField('SubTitle'), 'Title');
////
////        //**********************************************	
////        $Image = new UploadField("Image");
////        $Image->setRightTitle('Add the featured image for this page');
////        $fields->addFieldsToTab('Root.Images', $Image);
////        //**********************************************	
////        $FieldsArray = array(
////            new CheckboxField('showPageImage')
////        );
////        $fields->addFieldsToTab('Root.FrontEndOptions', $FieldsArray);
//        return $fields;
//
//    }
//
//    // Add comments section to the page by Default
//    static $defaults = array(
//    );
//
////     Allowed children types under this page 
////    static $allowed_children = array();
//
//    function requireDefaultRecords() {
//        parent::requireDefaultRecords();
//
//    }
//
//    /**
//     *  Auto change name & path of folder accurding to thisPage URL
//     * https://gist.github.com/4482171
//     */
//    function autoFolder() {
//        $Title = SiteTree::generateURLSegment($this->Title);
//        if ($this->Folder() && $this->Folder()->exists()) {
//            $folder = $this->Folder();
//        } else {
//            $folder = Folder::find_or_make($Title);
//            $folder->write();
//        }
//        $folder->Name = $Title;
//        $folder->Title = $Title;
//        $this->FolderID = $folder->ID;
//        $folder->write();
//
//        $ParentID = $this->ParentID;
//
//    }
//
//}
//
//
//class LoadedPage_Controller extends Page_Controller {
//
//    // This will inherit Controller from parent
//    function init() {
//        parent::init();
//
//    }
//
//}
//
