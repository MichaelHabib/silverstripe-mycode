<?php

class Gadget_FooterNotice extends Gadget {

    static $db = array(
        'Section1' => 'HTMLText',
        'Section2' => 'HTMLText',
        'Section3' => 'HTMLText',
    );
    static $has_one = array(
    );
    static $defaults = array(

    );

//    static $title = "ChildrenPages";
//    static $cmsTitle = "ChildrenPages";
//    static $description = "get ChildrenPages of this page.";

    public function getCMSFields() {
        $fields = parent::getCMSFields();
        $new_FieldsArray = array(
            new HtmlEditorField('Section1'),
            new HtmlEditorField('Section2'),
            new HtmlEditorField('Section3'),
        );
        $fields->addFieldsToTab('Root.Main', $new_FieldsArray);

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

