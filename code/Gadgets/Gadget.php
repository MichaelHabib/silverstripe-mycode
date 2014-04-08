<?php

class Gadget extends Dataobject {

//    public $PageID = null;
    static $db = array(
        "Title" => "Text",
        "SubTitle" => "Text",
        "Identifier" => "Text",
        "Note" => "HTMLText",
        //View Options
        'showTitle' => 'boolean',
        "CSS_ID" => 'varchar',
        "CSS_Class" => 'varchar',
        "Template" => "Text", //From Dropdown
        "TemplateName" => "Text", //Template name typed by user
    );
    static $has_one = array();
    static $has_many = array();
    static $many_many = array(
        'GadgetsAreas' => 'GadgetsArea'
    );
    static $required_fields = array(
        'Title'
    );
    static $unique_fields = array(
        'Title'
    );
    static $defaults = array();
    static $summary_fields = array(
        'Identifier' => 'Identifier',
        'Title' => 'Title',
        'ClassName' => 'Type',
    );
    static $title = "BasicGallery";
    static $cmsTitle = "BasicGallery";
    static $description = "Places a BasicGallery on your page. go MyModelAdmin->BasicGallery and create one then link to it from the dropdown menu below.";
    static $showEditLink = false;
    public $Templates = array();

    public function getCMSFields() {
        $fields = parent::getCMSFields();
        $fields->removeByName('Main');
        $fields->removeByName('GadgetsAreas');
        $fields->removeByName('Identifier');
        //**********************************************	
        $FieldsArray = array(
            new TextField("Title"),
            new TextField("SubTitle"),
            new FieldGroup(
                    new ReadonlyField('ObjectClassName', "Class Name", $this->ClassName)
            ),
        );
        $fields->addFieldsToTab('Root.Main', $FieldsArray);
        //**********************************************	
        $FieldsArray = array(
            TextField::create("Identifier", "Identifier")->setRightTitle('Identifier must be unique.'),
            new DropdownField('Template', 'Template', SSViewerExtention::getTemplatesForDropdown('Gadgets/' . $this->ClassName, $this->ClassName)),
            CheckboxField::create('showTitle', 'Show Title'),
            TextField::create('TemplateName', 'Custom template name'),
            new FieldGroup(
                    TextField::create('CSS_ID', 'CSS ID'), TextField::create('CSS_Class', 'CSS Class(s)')
            )
        );
//        debug::dump(SSViewerExtention::getTemplatesForDropdown('Gadgets/' . $this->ClassName, $this->ClassName)); die;
        $fields->addFieldsToTab('Root.FrontEndSettings', $FieldsArray);
        //**********************************************	
        $fields->addFieldsToTab('Root.Note', new HtmlEditorField('Note'));

        return $fields;

    }

//
//    public function onBeforeWrite() {
//        parent::onBeforeWrite();
//
//    }

    public function onAfterWrite() {
        parent::onAfterWrite();
//        if (!$this->Title) {
//            $this->Title = $this->ClassName . "_" . $this->ID;
//        }
//        if (!$this->Identifier) {
//            $this->Identifier = get_called_class() . "_" . $this->ID;
//        }
//        $this->write();

    }

    protected function validate() {
        $result = parent::validate();
        return $result;

    }

    public function getCMSValidator() {
        return new RequiredFields('Title');

    }

//
//    function getValidator() {
//        parent::getValidator();
//
//    }
//
//    public function setTemplate($newTemplate) {
//        $Templates = &$this->Templates;
//        $Templates[]=$newTemplate;
//    }

    public function forTemplate() {
        $Templates = &$this->Templates;
        $Templates = array();
//        $Templates[] = 'Gadget';
        $Templates[] = get_called_class();

        if ($Template = $this->TemplateName) {
            $Templates[] = $Template;
        }
        if ($Template = $this->Template) {
            $Templates[] = $Template;
        }

//        $this->setTemplates($newTemplates);
        return $this->renderWith(array_reverse($this->Templates));
//        return $this->renderWith($newTemplates);

    }

    function CurrentPage() {
//        debug::dump(Page_Controller::curr());
////        die;
        return Page_Controller::curr();
//        return Director::get_current_page();

    }

    public function getGadgetTitle() {
        
    }

    public function getGadgetSubTitle() {
        
    }

    public function Render_Title($Template = null) {

        $renderWith = array();
        $renderWith[] = 'Title';
        $renderWith[] = "Gadget_Title";
        $renderWith[] = get_called_class() . "_Title";
        return $this->renderWith($renderWith);

    }

    public function CSS_Class() {
        $CSS_Classes = array();
        $CSS_Classes[] = "Gadget";
        $CSS_Classes[] = $this->ClassName;
        $CSS_Classes[] = 'Template_' . $this->Template;
        if ($this->Identifier) {
            $CSS_Classes[] = "GadgetIdentifier_" . $this->Identifier;
        }
        if ($this->Identifier) {
            $CSS_Classes[] = $this->CSS_Class;
        }

        return implode(' ', $CSS_Classes);

    }

    public function CSS_ID() {
        $css = 'Gadget_' . $this->ID;
        return $css;

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

    public function Gadget_EditURL() {

//        return Director::absoluteBaseURL(). 'admin/gadgets-admin/GadgetsArea/EditForm/field/GadgetsArea/item/'.$this->ID.'/edit';

    }

    static public function link_shortcode_handler($arguments, $content = null, $parser = null) {
        if (!isset($arguments['id']) || !is_numeric($arguments['id']))
            return;

        if (
                !($page = DataObject::get_by_id('SiteTree', $arguments['id']))         // Get the current page by ID.
                && !($page = Versioned::get_latest_version('SiteTree', $arguments['id'])) // Attempt link to old version.
                && !($page = DataObject::get_one('ErrorPage', '"ErrorPage"."ErrorCode" = \'404\'')) // Link to 404 page.
        ) {
            return; // There were no suitable matches at all.
        }

        $link = Convert::raw2att($page->Link());

        if ($content) {
            return sprintf('<a href="%s">%s</a>', $link, $parser->parse($content));
        } else {
            return $link;
        }

    }

}

