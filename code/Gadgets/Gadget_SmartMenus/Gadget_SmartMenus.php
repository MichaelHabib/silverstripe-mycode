<?php

class Gadget_SmartMenus extends Gadget {

    static $db = array(
        'MenuOrientation' => 'varchar(20)',
        'MenuStyle' => 'varchar(20)',
    );
    static $has_one = array(
    );
    static $has_many = array(
    );
    static $defaults = array(
    );

    public function getCMSFields() {
        $fields = parent::getCMSFields();
        $FieldsArray = array(
            new DropdownField('MenuOrientation', 'Menu Orientation', array(
                'horizontal' => 'Horizontal',
                'vertical' => 'Vertical',
                'flat' => 'Flat Navigation (to do!)',
            )),
            new DropdownField('MenuStyle', 'Menu Style', array(
                'custom' => 'Custom',
                'blue' => 'Blue',
                'simple' => 'Simple',
                'clean' => 'Clean',
            )),
        );
        $fields->addFieldsToTab('Root.Main', $FieldsArray);

        return $fields;

    }

    public function CSS_Class_MenuOrientation() {
        if ($this->MenuOrientation == 'horizontal') {
            return 'sm-horizontal';
        } else if ($this->MenuOrientation == 'vertical') {
            return 'sm-vertical';
        }

    }

    public function CSS_Class_MenuStyle() {
        $style = $this->MenuStyle;
        switch ($style) {
            case 'custom':
                return 'sm-custom';
                break;
            case 'clean':
                return 'sm-clean';
                break;
            case 'simple':
                return 'sm-simple';
                break;
            case 'blue':
                return 'sm-blue';
                break;
        }

    }

}

