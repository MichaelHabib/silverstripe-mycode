<?php

class GadgetsArea extends Dataobject {

    private static $db = array(
        "Title" => "Text",
        "Identifier" => "Text",
        "Note" => "HTMLText",
        "Template" => "Text",
        //View Options
        'showTitle' => 'boolean',
        "CSS_ID" => 'varchar',
        "CSS_Class" => 'varchar',
    );
    private static $has_one = array(
        'Page' => 'Page'
    );
    private static $has_many = array();
    private static $many_many = array(
        'Gadgets' => 'Gadget'
    );
    public static $many_many_extraFields = array(
        'Gadgets' => array(
            'Sort' => 'int',
        )
    );
//    static $unique_fields = array(
//        'Identifier'
//    );
    static $defaults = array();
    static $summary_fields = array(
        'Identifier' => 'Identifier',
        'Title' => 'Title'
//        'Gadgets()->count()' => 'Gadgets Count',
    );
//    static $title = "xxx";
    static $cmsTitle = "";
    static $description = "";
    static $showEditLink = false;

    public function getCMSFields() {
        $fields = parent::getCMSFields();
        $fields->removeByName('Main');
        $fields->removeByName('Gadgets');
//**********************************************	
        $FieldsArray_Content = array(
            TextField::create("Title"),
            TextField::create('Identifier')->setRightTitle('This must be unique'),
//            new DropdownField('Template', SSViewerExtention::getTemplatesForDropdown('Gadgets/' . $this->ClassName, $this->ClassName))
        );
        $fields->addFieldsToTab('Root.Content', $FieldsArray_Content);
//**********************************************	
        $GridField_Config = GridFieldConfig_MultiClassFullControl::create();
        $orderable = new GridFieldOrderableRows('Sort');
//        $orderable->getSortTable($this->Gadgets());
        $GridField_Config->addComponent($orderable);
        $GridField = new GridField('Gadgets', 'Gadgets', $this->Gadgets(), $GridField_Config);
        $fields->addFieldsToTab('Root.Content', $GridField);
//**********************************************	
        $FieldsArray_ViewOptions = array(
            CheckboxField::create('showTitle', 'Show Title'),
            TextField::create('CSS_ID', 'CSS ID'),
            TextField::create('CSS_Class', 'CSS Class(s)'),
        );
        $fields->addFieldsToTab('Root.ViewOptions', $FieldsArray_ViewOptions);
//**********************************************	
        $fields->addFieldsToTab('Root.Note', new HtmlEditorField('Note'));
        return $fields;

    }

    public function onAfterWrite() {
        parent::onAfterWrite();
        if (!$this->Identifier) {
            $this->Identifier = get_called_class() . "_" . $this->ID;
            $this->write();
        }

    }

    protected function validate() {
        $result = parent::validate();
        return $result;

    }

    /*
     * --------------------------------------------
     *  Template / View related functions
     * --------------------------------------------
     *  */

    public function forTemplate() {

        return $this->renderWith('GadgetsArea');

    }

    function Gadgets() {
//        return $this->isInDB() ? $this->getManyManyComponents('RelatedPages')->sort('SortOnPage', 'ASC') : false;
        return $this->isInDB() ? $this->getManyManyComponents('Gadgets')->sort('Sort', 'ASC') : false;

    }

    public function CSS_Class() {
        $css = "GadgetsArea";
        if ($Identifier = $this->Identifier) {
            $css.=" GadgetsAreaIdentifier_" . $Identifier;
        }
        if ($Identifier != $this->ClassName) {
            $css.=" GadgetsAreaIdentifier_" . $Identifier;
            $css.=" ";
        }
        if ($CSS_Class = $this->CSS_Class) {

            $css.=" ";
            $css.= $CSS_Class;
        }
        return $css;

    }

    public function CSS_ID() {
        $css = 'GadgetArea_' . $this->ID;
        if ($CSS_ID = $this->CSS_ID) {
            $css.=" ";
            $css.= $CSS_ID;
        }

    }

    /**
     * @param bool $showEditLink enable or disable Edit link on front end.
     * @return bool
     */
    public static function set_showEditLink($showEditLink) {


        if ($showEditLink === (false || 0)) {
            self::$showEditLink = $showEditLink;
        } elseif ($showEditLink === (true || 1)) {
            self::$showEditLink = $showEditLink;
        }

    }

    public function showEditLink() {
        if (Member::currentUserID()) {
            $CurrentmemberIsAdmin = Member::currentUser()->inGroup('Administrators');
            if ($CurrentmemberIsAdmin) {
                return self::$showEditLink;
            }
        }

        return FALSE;

    }

    public function GadgetsArea_EditURL() {

        return Director::absoluteBaseURL() . 'admin/gadgets-admin/GadgetsArea/EditForm/field/GadgetsArea/item/' . $this->ID . '/edit';

    }

}

