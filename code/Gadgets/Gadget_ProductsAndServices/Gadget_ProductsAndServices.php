<?php

class Gadget_ProductsAndServices extends Gadget {

    static $db = array(
        'DataSource' => 'text',
        'Products_showFeaturedProducts' => 'boolean',
        'ItemsCount' => 'int',
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
            new DropdownField('DataSource', 'Data Source', array(
                'ProductPage' => 'ProductPage',
                'ProducCategorytPage' => 'ProducCategorytPage',
                'ServicePage' => 'ServicePage',
                    )),
        );
        $fields->addFieldsToTab('Root.Main', $FieldsArray);

        $FieldsArray = array(
            new NumericField('ItemsCount')
        );
        $fields->addFieldsToTab('Root.Main', $FieldsArray);
        
        $FieldsArray = array(
            new CheckboxField('Products_showFeaturedProducts','ONLY show featured Products')
        );
        $fields->addFieldsToTab('Root.ProductsSettings', $FieldsArray);

        $FieldsArray = array(
        );
        $fields->addFieldsToTab('Root.ServicesSettings', $FieldsArray);

        return $fields;

    }

    /**
     * Return an array of items based on DataSources & other settings
     * @return Array
     */
    public function Items() {
        $Class = $this->DataSource;
        if (!$limit = $this->ItemsCount) {
            $limit = 5;
        }

        if ($Class == 'ProductPage' && $this->Products_showFeaturedProducts) {
            return $Class::get()->filter(array(
                        'Featured' => '1'
                    ))->limit($limit);
        } else {
            return $Class::get()->limit($limit);
        }

    }

}

