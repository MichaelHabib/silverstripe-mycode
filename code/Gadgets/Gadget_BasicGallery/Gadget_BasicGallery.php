<?php

class Gadget_BasicGallery extends Gadget {

    static $db = array(
        "ImagesPerRow" => "Int",
        "ImagesPerPage" => "Int",
        "ResizeMethod" => "Text"
    );
    static $has_one = array(
        'Gallery' => 'BasicGallery'
    );
    static $has_many = array();
    static $many_many = array(
    );
    static $defaults = array(
    );
//    static $title = "BasicGallery";
    static $cmsTitle = "BasicGallery";
    static $description = "Places a BasicGallery on your page. go MyModelAdmin->BasicGallery and create one then link to it from the dropdown menu below.";

    public function getCMSFields() {

        $fields = parent::getCMSFields();
        $FieldsArray = array(
            new DropdownField('Template', 'Template', SSViewerExtention::getTemplatesForDropdown('Gadgets/' . $this->ClassName, $this->ClassName)),
            new NumericField("ImagesPerRow", "Images Per Row"),
            new NumericField("ImagesPerPage", "Images Per Page"),
            new DropdownField('GalleryID', 'GalleryID', Dataobject::get("BasicGallery")->map("ID", "Title"))
        );
        if ($this->Gallery()) {
            $GridField = $this->Gallery()->GridField_Images();
            $fields->addFieldToTab('Root.Gallery', $GridField);
        }

        $fields->addFieldsToTab('Root.Main', $FieldsArray);
        return $fields;

    }

//    public function forTemplate() {
//        $renderWith = array();
//        if ($this->TemplateName) {
//            $renderWith[] = $this->TemplateName;
//        }
//        if ($this->Template) {
//            $renderWith[] = $this->Template;
//        }
//        $renderWith[] = $this->ClassName;
////        $renderWith[] = 'Gadget';
//        return $this->renderWith($renderWith);
//    }

}

