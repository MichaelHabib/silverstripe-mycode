<?php

class Gadget_Page extends Gadget {

    static $db = array(
        'usePageTitle' => 'boolean',
        'showPageSummary' => 'boolean',
        'PageSummaryLimit' => 'int',
        'showReadMoreButton' => 'boolean',
        'showPageImage' => 'boolean',
    );
    static $has_one = array(
        'Page' => 'Page'
    );
    static $defaults = array(
        'showTitle' => 1,
        'usePageTitle' => 1,
        'showPageImage' => 1,
        'showReadMoreButton' => 1,
        'showPageSummary' => 1,
        'PageSummaryLimit' => 20,
    );

//    static $title = "ChildrenPages";
//    static $cmsTitle = "ChildrenPages";
//    static $description = "get ChildrenPages of this page.";

    public function getCMSFields() {
        $fields = parent::getCMSFields();
        $fields->insertAfter(DropdownField::create('PageID', 'Link to Page: ', Page::get()->Map("ID", "Title"))->setEmptyString('None'), 'Title');

        $FieldsArray = new FieldGroup(
                new CheckboxField("showTitle"), new CheckboxField("usePageTitle"), new CheckboxField("showPageSummary"), new CheckboxField("PageSummaryLimit"), new CheckboxField("showReadMoreButton"), new CheckboxField("showPageImage")
        );
        $fields->removeByName('showTitle');
        $fields->addFieldsToTab('Root.FrontEndSettings', $FieldsArray);
        return $fields;

    }

//    public function forTemplate() {
//        $renderWith = array();
//        if ($this->Template) {
//            $renderWith[] = $this->Template;
//        }
//        $renderWith[] = $this->ClassName;
////        $renderWith[] = 'Gadget';
//        return $this->renderWith($renderWith);
//
//    }

}

