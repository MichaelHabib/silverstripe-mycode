<?php

class Gadget_TemplateLoader extends Gadget {

    static $db = array(
        /*
         * --------------------------------------------
         * Page Related Settings
         * --------------------------------------------
         *  */
        'usePageTitle' => 'boolean',
        'showPageSummary' => 'boolean',
        'PageSummaryLimit' => 'int',
        'showReadMoreButton' => 'boolean',
        'showPageImage' => 'boolean',
    );
    static $has_one = array(
        "Page" => 'Page',
    );
    static $has_many = array(
    );
    static $defaults = array(
    );

    public function getCMSFields() {
        $fields = parent::getCMSFields();
        $fields->insertAfter(DropdownField::create('PageID', 'Link to Page : ', Page::get()->Map("ID", "Title"))->setEmptyString('None'), 'Title');

//        $fields->addFieldsToTab('Root.Main', $FieldsArray);


        $FieldsArray = array(
            new FieldGroup(
                    CheckboxField::create("usePageTitle"), CheckboxField::create("showPageSummary", "show Page Summary if 'Content' field is empty"), new NumericField("PageSummaryLimit"), CheckboxField::create("showReadMoreButton", "show 'read more' button ONLY if 'Link to Page' is set."), new CheckboxField("showPageImage", "show 'Page Image' if 'Image' field is not set.")
            ),
        );
        $fields->removeByName('showTitle');
        $fields->removeByName('showTitle');
        $fields->addFieldsToTab('Root.FrontEndSettings', $FieldsArray);

        return $fields;

    }

    public function TitleLink() {
        if ($this->Page()) {
            return $this->Page()->Link();
        }

    }

    public function Title() {
        if ($this->PageID && $this->usePageTitle) {
            return $this->Page()->Title;
        } else {
            return $this->Title;
        }

    }

    public function Image() {
        $Component = $this->getComponent('Image');
        if (!$Component && $this->Page() && $this->usePageImage) {
            return $this->Page()->Image;
        } else {
            return $Component;
        }

    }

    public function TheContent() {
//        if ($this->Content) {
        if (!$this->Content && $this->Page() && $this->showPageSummary) {
            return $this->Page()->Content;
        } else {
            return $this->Content;
        }

    }

    public function showReadMoreButton() {
        if ($this->showReadMoreButton && $this->Page()) {
            return true;
        } else {
            return false;
        }

    }

    public function showPageImage() {
        if ($this->Page() && $this->showPageImage) {
            return true;
        } else {
            return false;
        }

    }

}