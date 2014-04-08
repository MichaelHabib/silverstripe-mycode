<?php

class Gadget_ChildrenPages extends Gadget {

    static $db = array(
        'ChildrenPagesSortBy' => 'text',
        'ChildrenPagesSort' => 'text',
        'ChildrenPagesLimit' => 'int',
        'AllChildren' => 'boolean',
    );
    static $has_one = array(
        'Page' => 'Page'
    );
    static $has_many = array(
    );
    static $defaults = array(
    );

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        $FieldsArray = array(
            DropdownField::create('PageID', 'Link to Page: ', Page::get()->Map("ID", "Title"))->setEmptyString('None'),
            DropdownField::create('ChildrenPagesSortBy', 'Children Pages Sort by', array(
                'Created' => 'Date Created',
                'LastEdited' => 'Last Edited',
                'Sort' => 'Pages Sort Order',
            )),
            DropdownField::create('AllChildren', 'List all children including ones hidden from Menu', array(
                '0' => 'False',
                '1' => 'True',
            )),
            DropdownField::create('ChildrenPagesSort', 'Children Pages Sort', array(
                'ASC' => 'ASC',
                'DESC' => 'DESC',
            )),
            NumericField::create('ChildrenPagesLimit', 'Children Pages Limit')
        );
        $fields->addFieldsToTab('Root.Main', $FieldsArray);
        return $fields;

    }

    public function ChildrenPages() {
        if (!$Page = $this->Page()) {
            $Page = $this->CurrentPage();
        }
        if (!$SortBy = $this->ChildrenPagesSortBy) {
            $SortBy = 'Sort';
        }
        if (!$Sort = $this->ChildrenPagesSort) {
            $Sort = 'DESC';
        }
        if (!$Limit = $this->ChildrenPagesLimit) {
            $Limit = 50;
        }
//        debug::dump($Page);
//        die;
        if (method_exists($Page, 'Children')) {
            
        }
        if ($this->AllChildren) {
            $children = $Page->AllChildren()->sort($SortBy, $Sort)->limit($Limit);
        } else {
            $children = $Page->Children()->sort($SortBy, $Sort)->limit($Limit);
        }
        return $children;

    }

}

