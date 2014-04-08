<?php

class Gadgets_PageExtension extends DataExtension {

    private static $db = array(

    );
    private static $has_one = array(

    );
    private static $has_many = array(
        'GadgetsAreas' => 'GadgetsArea'
    );
    static $many_many = array(
    );


    public function updateCMSFields(FieldList $fields) {
        $GridField_Config = GridFieldConfig_RecordEditor::create();
//        $GridField_Config->addComponent(new GridFieldOrderableRows('Sort')); need many_many relation or Sort field on GadgetsArea
        $GridField = new GridField('GadgetsAreas', 'GadgetsAreas', $this->owner->GadgetsAreas());
        $GridField->setConfig($GridField_Config);
        $fields->addFieldsToTab('Root.GadgetsAreas', $GridField);

    }

    /**
     * Return an existing GadgetsArea or create a new one based on the "$GadgetsAreaIdentifier" param
     *  spesific to the current page. This function will only return GadgetsAreas that have a relation to the current page.
     * @param type $GadgetsAreaIdentifier
     * @return GadgetsArea
     */
    public function getPageGadgetsArea($GadgetsAreaIdentifier) {
        $PageID = $this->owner->ID;
        $Original_GadgetsAreaIdentifier = $GadgetsAreaIdentifier;
        $GadgetsAreaIdentifier = $GadgetsAreaIdentifier . '_Page' . $PageID;
        if (!$GadgetsArea = GadgetsArea::get()->filter(
                        array("Identifier" => $GadgetsAreaIdentifier, 'PageID' => $PageID)
                )->first()) {
            $GadgetsArea = new GadgetsArea();
            $GadgetsArea->Identifier = $GadgetsAreaIdentifier;
            $GadgetsArea->PageID = $PageID;
            $GadgetsArea->CSS_Class = $Original_GadgetsAreaIdentifier;
            $GadgetsArea->write();
        }
        return $GadgetsArea;

    }

    /**
     * Return an existing GadgetsArea or create a new one based on the "$GadgetsAreaIdentifier" param.
     * @param type $GadgetsAreaIdentifier
     * @return \GadgetsArea
     */
    public function getGadgetsArea($GadgetsAreaIdentifier) {
        if (!$GadgetsArea = GadgetsArea::get()->filter(array("Identifier" => $GadgetsAreaIdentifier))->first()) {
            $GadgetsArea = new GadgetsArea();
            $GadgetsArea->Identifier = $GadgetsAreaIdentifier;
            $GadgetsArea->write();
        }
        return $GadgetsArea;

    }

    public function getGadget($GadgetIdentifier) {
        if (!$Gadget = Gadget::get()->filter(array("Identifier" => $GadgetIdentifier))->first()) {
//            $Gadget = new Gadget();
//            $Gadget->Identifier = $GadgetIdentifier;
//            $Gadget->write();
        }
        return $Gadget;

    }

    public function getBasicGallery($ID) {
        return BasicGallery::get()->filter(array("ID" => $ID))->first();

    }

}


class Gadgets_Page_ControllerExtension extends DataExtension {
    
}

