<?php

class GadgetsAdmin extends ModelAdmin {

    public static $managed_models = array(
        'GadgetsArea',
        'Gadget',
    );
    // disable the importer
    public static $model_importers = array();
    // $url_segment in the backend
    static $url_segment = 'gadgets-admin';
    // title in cms navigation
    static $menu_title = 'Gadgets';

    // menu icon
//    static $menu_icon = 'flexslider/images/icons/flexslider_icon.png';

    public function getEditForm($id = null, $fields = null) {
        $form = parent::getEditForm($id, $fields);
//        
//        $gridField = $form->Fields()->fieldByName($this->sanitiseClassName($this->modelClass));
//        $GridFieldConfig = GridFieldConfig_MultiClassFullControl::create();
////        $GridFieldConfig->setGridField($gridField);
//        $gridField->setConfig($GridFieldConfig);
//        
        
        return $form;

    }

}


