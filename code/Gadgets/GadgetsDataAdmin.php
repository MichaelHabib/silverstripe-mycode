<?php

class GadgetsDataAdmin extends ModelAdmin {

    public static $managed_models = array(
        'BasicGallery',
        'News',
        'Testimonial',
    );
    // disable the importer
    public static $model_importers = array();
    // $url_segment in the backend
    static $url_segment = 'gadgets-data-admin';
    // title in cms navigation
    static $menu_title = 'Gadgets Data';

    // menu icon
//    static $menu_icon = 'flexslider/images/icons/flexslider_icon.png';

    public function getEditForm($id = null, $fields = null) {
        $form = parent::getEditForm($id, $fields);

        $GridField = $form->Fields()->fieldByName($this->sanitiseClassName($this->modelClass));
        $GridField_Config = GridFieldConfig_RecordEditor::create();
        $GridField->setConfig($GridField_Config);

        return $form;

    }

}

