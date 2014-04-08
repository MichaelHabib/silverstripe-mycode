<?php

class CustomTemplatesExtension extends DataExtension {

    public static $db = array(
        'InheritTemplateSettings' => 'Boolean',
        'temp' => 'text',
        'MainTemplate' => 'text',
        'LayoutTemplate' => 'text'
    );
    public static $has_one = array(
//        'MasterTemplate' => 'UserTemplate',
//        'LayoutTemplate' => 'UserTemplate',
    );
    public static $defaults = array(
        'InheritTemplateSettings' => 1
    );

//    public function updateSettingsFields(FieldList $fields) {
    public function updateCMSFields(\FieldList $fields) {
        parent::updateCMSFields($fields);
        $MainTemplates = Helper::getTemplatesByPath('templates/');
        $LayoutTemplates = Helper::getTemplatesByPath('templates/Layout/');
        $CurrentTheme = SiteConfig::current_site_config()->Theme;
//        $CurrentTheme = 'Base1';
        $newFieldsArray_Themes = array(
            DropdownField::create('MainTemplate', 'MainTemplate field', $MainTemplates),
            DropdownField::create('LayoutTemplate', 'LayoutTemplate field', $LayoutTemplates),
            CheckboxField::create('InheritTemplateSettings', 'Inherit Settings')
        );

        $effectiveMain = $this->effectiveTemplate('Main');
        $effectiveLayout = $this->effectiveTemplate('Layout');

        if ($effectiveMain) {
            $newFieldsArray_Themes[] = ReadonlyField::create('EffectiveMaster', 'Effective master template', $effectiveMain);
        }

        if ($effectiveLayout) {
            $newFieldsArray_Themes[] = ReadonlyField::create('EffectiveLayout', 'Effective layout template', $effectiveLayout);
        }

        $fields->addFieldsToTab('Root.Themes', $newFieldsArray_Themes);
        return $fields;

    }

    /**
     * 
     * @param string $type
     * 					Whether to get a master or layout template
     * @param string $action
     * 					If there's a specific action involved for the template
     * @return type
     */
    public function effectiveTemplate($type = 'Main', $action = null) {
        if ($this->owner->InheritTemplateSettings && $this->owner->ParentID) {
            return $this->owner->Parent()->effectiveTemplate($type, $action);
        } else {
            $FieldName = $type . 'Template';
            return $this->owner->$FieldName;
        }

    }

}


class CustomTemplatesControllerExtension extends DataExtension {

    public function updateViewer($action, $viewer) {
        $CurrentTheme = SiteConfig::current_site_config()->Theme;
//        $CurrentTheme = 'Base1';
        if ($MainTemplate = $this->owner->data()->effectiveTemplate()) {
            $MainTemplatePath = '../themes/' . $CurrentTheme . '/templates/' . $MainTemplate . '.ss';
            $viewer->setTemplateFile('main', $MainTemplatePath);
        }
        IF ($LayoutTemplate = $this->owner->data()->effectiveTemplate('Layout')) {
            $LayoutTemplatePath = '../themes/' . $CurrentTheme . '/templates/Layout/' . $LayoutTemplate . '.ss';
            $viewer->setTemplateFile('Layout', $LayoutTemplatePath);
        }
        $MainTemplatePath = '../themes/' . $CurrentTheme . '/templates/' . $MainTemplate . '.ss';
        $viewer->setTemplateFile('main', $MainTemplatePath);
        $LayoutTemplatePath = '../themes/' . $CurrentTheme . '/templates/Layout/' . $LayoutTemplate . '.ss';
        $viewer->setTemplateFile('Layout', $LayoutTemplatePath);
//        debug::dump($CurrentTheme);
//        die;

    }

}

