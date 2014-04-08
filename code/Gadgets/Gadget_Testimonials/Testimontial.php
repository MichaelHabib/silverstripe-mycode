<?php

class Testimonial extends CustomDataObject {

    static $db = array(
        'SortID' => 'int',
        'Title' => 'text',
        'Content' => 'HTMLText'
    );
    static $has_one = array(
    );
    public static $defaults = array(
    );
    public static $summary_fields = array(
    );

    public function getCMSFields() {
        $fields = parent::getCMSFields();
        $fields->removeByName('Main');
        $newFieldsArray = array(
            TextField::create('Title'),
            HtmlEditorField::create('Content')
        );

        $fields->addFieldsToTab('Root.Main', $newFieldsArray);

        return $fields;

    }

    public function requireDefaultRecords() {
        parent::requireDefaultRecords();
        $TestimonialsCount = self::get()->count();
        if ($TestimonialsCount == 0) {
            for ($i = 3, $count = 0; $i > $count; $count++) {
                $object = new self();
                $object->Title = "Testimonial";
                $object->Content = "This is a sample Testimonial. Please login to edit the content. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus volutpat euismod faucibus. Cras hendrerit nisl at orci lobortis, eu ultrices nisl tincidunt. Duis non commodo urna.";
                $object->write();
            }
        }

    }

}

