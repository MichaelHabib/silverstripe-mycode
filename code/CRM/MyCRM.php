<?php
class MyCRM extends ModelAdmin {
    
    public static $managed_models = array(
//        'BasicMember',
//        'Member2',
        'Member',
        'Project'
        );
    
    // disable the importer
    public static $model_importers = array();
    
    // Linked as /admin/slides/
    static $url_segment = 'mycrm';
    
    // title in cms navigation
    static $menu_title = 'MyCRM';
    
    // menu icon
//    static $menu_icon = 'flexslider/images/icons/flexslider_icon.png';
    
    public function getCMSFields(){
        $fields=parent::getCMSFields();
        $newFieldsArray = array(
            
        );
        $firelds->addFieldsToTab('Root.NewTab',$newFieldsArray);
    }
}