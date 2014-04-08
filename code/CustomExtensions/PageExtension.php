<?php

class PageExtension extends DataExtension {

    private static $db = array(
        'SubTitle' => 'Text'
    );
    private static $has_one = array(
        'Image' => 'Image',
    );
    private static $has_many = array(
      
    );
    static $many_many = array(
    );
    public static $defaults = array(
        "Content" => "This is the default content for this page. You can edit this page at any time to change its content."
    );

    public function updateCMSFields(FieldList $fields) {
       
        $fields->insertAfter(new TextField('SubTitle'), 'Title');

        //**********************************************	
        $Image = new UploadField("Image");
        $Image->setRightTitle('Add the featured image for this page');
        $fields->addFieldsToTab('Root.Images', $Image);
        //**********************************************	
        $FieldsArray = array(
            new CheckboxField('showPageImage')
        );
        $fields->addFieldsToTab('Root.FrontEndOptions', $FieldsArray);

    }

    public function Render_Title($Template = null) {

        $renderWith = array();
        $renderWith[] = 'Title';
        $renderWith[] = "PageTitle";
        $renderWith[] = $this->owner->ClassName . "_Title";
        if ($Template) {
            $renderWith[] = $Template;
        }
        return $this->owner->renderWith(array_reverse($renderWith));

    }

    
    
    public function Render_PageImage(){
        
    }

    public function getPageByID($id) {
        return Page::get()->filter(array("ID" => $id))->first();

    }

}


class Page_ControllerExtension extends DataExtension {
    
}

