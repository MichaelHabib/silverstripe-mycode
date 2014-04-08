<?php

class Project extends DataObject {

    static $db = array(
        'SortID' => 'Int',
        'ProjectName' => 'Text',
        'AboutProject' => 'HTMLText',
        'ProjectType' => "enum('Quote,Job','Quote')",
        'ProjectStatus' => "enum('Open,Closed','Open')",
        'Cost' => 'int',
        'Details' => 'HTMLText',
        'Changelog' => 'HTMLText'
    );
    static $has_one = array(
        'Folder' => 'Folder'
    );
    static $has_many = array(
    );
    static $many_many = array(
        'Files' => 'File'
    );

    function getCMSFields() {
        $fields = parent::getCMSFields();
        $fields->removeByName('Main');
        $fields->removeByName('Files');
        $fields->removeByName('Folder');
        $newFieldsArray = array(
            new TextField('ProjectName', 'ProjectName'),
//            new LiteralField('FolderName', $this->findOrMakeFolder()),
            new DropdownField('ProjectType', 'ProjectType', $this->dbObject('ProjectType')->enumValues()),
            new DropdownField('ProjectStatus', 'ProjectStatus', array(
                0 => 'Closed',
                1 => 'Open'
            )),
            new HtmlEditorField('AboutProject', 'AboutProject'),
            new HtmlEditorField('Details'),
            new HtmlEditorField('Changelog'),
        );
        $fields->addFieldsToTab('Root.Main', $newFieldsArray);


        $newUploadField = new UploadField('Files');
        $newUploadField->setFolderName($this->Folder()->Title);
//        $newUploadField->setFolderName($this->Folder()->Title);
        //Show UploadField only if Object has been created and saved
        if (!$this->ID > 0) {
            $newUploadField = $newUploadField->performReadonlyTransformation();
        }
        $fields->insertAfter($newUploadField, 'ProjectStatus');

        return $fields;
    }

    public function getCMSValidator() {
        return new RequiredFields('ProjectName', 'ProjectType', 'ProjectStatus');
    }

    public static $default_sort = 'ID Desc';
    public static $summary_fields = array(
        'ID' => 'ID',
        'ProjectName' => 'ProjectName',
        'ProjectType' => 'ProjectType',
        'ProjectStatus' => 'ProjectStatus',
        'Cost' => 'Cost'
    );
    static $defaults = array(
    );

//    function findOrMakeFolder() {
//        $Title = $this->ID . '-' . $this->ProjectName;
//        if ($this->Folder() && $this->Folder()->exists()) {
//            $folder = $this->Folder();
//        } else {
//            $folder = Folder::find_or_make($Title);
//            $folder->write();
//        }
//        $this->FolderID = $folder->ID;
//        $folder->setName($Title);
//        $folder->setTitle($Title);
//        $folder->setFilename($Title);
//        $folder->updateFilesystem();
//        $folder->write();
//    }

    function getFolderName() {
        return $this->ID . '-' . $this->ProjectName;
    }

    function getFolderPath() {
        return 'Projects/' . $this->getFolderName();
    }

    function MakeFolder() {
        $Title = $this->getFolderName();
        if ($this->Folder() && $this->Folder()->exists()) {
            
        } else {
            $folder = Folder::find_or_make($Title);
            $folder->write();
            $this->FolderID = $folder->ID;
        }
    }

    function fixFolderName() {
        $Title = $this->getFolderName();
        if ($this->Folder() && $this->Folder()->exists()) {
            $folder = $this->Folder();
            $folder->setName($Title);
            $folder->setTitle($Title);
            $folder->setFilename($Title);
            $folder->updateFilesystem();
            $folder->write();
        } else {
            
        }
    }

    function onBeforeWrite() {
        parent::onBeforeWrite();
        $this->MakeFolder();
    }

    function onBeforeDelete() {
        parent::onBeforeDelete();
    }

    function onAfterWrite() {
        parent::onAfterWrite();
        if ($this->isChanged('URLSegment')) {
            $this->fixFolderName();
        }
    }

    function canCreate($Member = null) {

        return true;
    }

    function canEdit($Member = null) {

        return true;
    }

    function canView($Member = null) {
        return true;
    }

    function canDelete($Member = null) {
        return true;
    }

}