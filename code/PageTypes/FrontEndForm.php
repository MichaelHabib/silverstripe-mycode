<?php

class FrontEndForm extends Page {

    static $db = array(
        'Name' => 'text',
        'Address' => 'text',
        'Website' => 'text',
        'Phone' => 'int',
        'Fax' => 'int',
    );
    static $has_one = array(
    );
    static $has_many = array();
    static $many_many = array();

    function getCMSFields() {
        $fields = parent::getCMSFields();
        $newFieldsArray = array(
        );


        return $fields;

    }

// Add comments section to the page by Default
    static $defaults = array(
    );

    function onBeforeWrite() {
        parent::onBeforeWrite();

    }

    function onAfterWrite() {
        parent::onAfterWrite();

    }

    function requireDefaultRecords() {
        parent::requireDefaultRecords();

    }

}


class FrontEndForm_Controller extends Page_Controller {

// This will inherit Controller from parent
    function init() {
        parent::init();

    }

    public function Form() {

        $Fields = new FieldList(array(
//                    TextField::create('Name', 'Name', $this->data()->Name),
//                    HtmlEditorField::create('Note', 'Note', $this->data()->Note)
                    TextField::create('Title'),
                    HtmlEditorField::create('Note')
                ));
        $Actions = new FieldList(array(
                    new FormAction('storeForm', 'Save'))
        );
        RETURN new Form(
                        $this,
                        'Form',
                        $Fields,
                        $Actions
        );
//        return $Form;

    }

    public function doSave($data, $form) {
        if ($this->addMember($form))
            $form->sessionMessage(
                    _t('MemberProfiles.MEMBERADDED', 'The new member has been added.'), 'good'
            );

        return $this->redirectBack();

    }

    public function storeForm($data, $form) {
        $obj = new Gadget();
        $form->saveInto($obj);
        $obj->write();
        return $this->redirectBack();

    }

}


