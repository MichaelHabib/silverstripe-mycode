<?php

class GridFieldConfig_MultiClass_Base extends GridFieldConfig {

    public $GridField = null;
    public $GridFieldAddNewMultiClass_Classes;
    public $AtRelationLimit = false;

    /**
     *
     * @param int $itemsPerPage - How many items per page should show up
     */
    public function __construct($itemsPerPage = null) {

        $this->addComponent(new GridFieldButtonRow('before'));
        $this->addComponent(new GridFieldAddNewButton('buttons-before-left'));
        $this->addComponent(new GridFieldToolbarHeader());
        $this->addComponent($sort = new GridFieldSortableHeader());
        $this->addComponent($filter = new GridFieldFilterHeader());
        $this->addComponent(new GridFieldDataColumns());

        $this->addComponent(new GridFieldPageCount('toolbar-header-right'));
        $this->addComponent($pagination = new GridFieldPaginator($itemsPerPage));
        $this->addComponent(new GridFieldDetailForm());



        $this->addComponent(new GridFieldAddNewMultiClass());
        $this->removeComponentsByType('GridFieldAddNewButton');


        $sort->setThrowExceptionOnBadDataType(false);
        $filter->setThrowExceptionOnBadDataType(false);
        $pagination->setThrowExceptionOnBadDataType(false);

    }

    public function setGridField($GridField = null) {
        $this->GridField = $GridField;

    }

    public function getGridField() {
        return $this->GridField;

    }

    public function setGridFieldAddNewMultiClass_Classes($classes = array()) {
        $this->GridFieldAddNewMultiClass_Classes = $classes;
        $Component = $this->getComponentByType('GridFieldAddNewMultiClass');
        $Component->setClasses($classes);

    }

    public function addGridFieldAddNewMultiClass() {
        $classes = array_values(ClassInfo::subclassesFor($this->getGridField()->getModelClass()));
        if (count($classes) > 1 && class_exists('GridFieldAddNewMultiClass')) {
            $this->removeComponentsByType('GridFieldAddNewButton');
            $this->addComponent(new GridFieldAddNewMultiClass());
            return $this;
        }

    }

    /**
     *  Set the limit on the number of relations GridField can manage.
     * @param int $RelationCount Current relation count. i.e : $this->RelationName()->count()
     * @param int  $limit
     */
    public function setRelationLimit($RelationCount, $limit = 10) {
        if ($RelationCount >= $limit) {
            $this->AtRelationLimit = true;
        }

    }

    /**
     * Remove an array of compoenents. This method already has a list of default componets to remove.
     * @param array $Components
     * @param boolean $RemoveSetComponentsOnly  If true, ignore the default list of compoenets to remove & only use whatever is passed in through $Components, If false, merge $Components with $DefaultComponents.
     */
    public function RemoveComponentsOnRelationLimit($Components = array(), $RemoveSetComponentsOnly = FALSE) {
        $DefaultComponents = array(
            'GridFieldAddExistingSearchButton',
            'GridFieldCopyButton',
            'GridFieldAddNewButton',
            'GridFieldAddNewMultiClass',
            'GridFieldAddExistingAutocompleter',
        );
        if (!$RemoveSetComponentsOnly) {
            $Components = array_merge($DefaultComponents, $Components);
        }
        if ($this->AtRelationLimit && is_array($Components) && count($Components) > 0) {
            foreach ($DefaultComponents as $key => $Component) {
                $this->removeComponentsByType($Component);
            }
        }

    }

}


class GridFieldConfig_MultiClassFullControl extends GridFieldConfig_MultiClass_Base {

    public function __construct($itemsPerPage = null) {
        parent::__construct($itemsPerPage);
        //        $this->addComponent(new GridFieldAddExistingAutocompleter('buttons-before-left'));
        $this->addComponent(new GridFieldAddExistingSearchButton());

        $this->removeComponentsByType('GridFieldEditButton');
        $this->removeComponentsByType('GridFieldDeleteAction');
        $this->removeComponentsByType('GridFieldDetailForm');
        $this->addComponent(new GridFieldDetailForm());
//        $this->addComponent(new GridFieldCopyButton());
        $this->addComponent(new GridFieldEditButton());
        $this->addComponent(new GridFieldDeleteAction(true));
        $this->addComponent(new GridFieldDeleteAction());


//        $this->addComponent(new GridFieldOrderableRows('SortID'));

    }

}


class GridFieldConfig_EditableColumns extends GridFieldConfig {

//    public $GridField = null;

    /**
     *
     * @param int $itemsPerPage - How many items per page should show up
     */
    public function __construct($itemsPerPage = null) {

        $this->addComponent(new GridFieldButtonRow('before'));

//        $this->addComponent(new GridFieldAddNewButton('buttons-before-left'));
        $this->addComponent(new GridFieldAddExistingAutocompleter('buttons-before-left'));
        $this->addComponent(new GridFieldAddExistingSearchButton());
        $this->addComponent(new GridFieldToolbarHeader());
        $this->addComponent($sort = new GridFieldSortableHeader());
        $this->addComponent($filter = new GridFieldFilterHeader());
//        $this->addComponent(new GridFieldDataColumns());

        $this->addComponent(new GridFieldEditableColumns());
        $this->addComponent(new GridFieldAddNewInlineButton());

        $this->addComponent(new GridFieldEditButton());
        $this->addComponent(new GridFieldCopyButton(), 'GridFieldDeleteAction');
        $this->addComponent(new GridFieldDeleteAction(true));
        $this->addComponent(new GridFieldDeleteAction());
        $this->addComponent(new GridFieldPageCount('toolbar-header-right'));
        $this->addComponent($pagination = new GridFieldPaginator($itemsPerPage));
//        $this->addComponent(new GridFieldDetailForm());
//        $this->addComponent(new GridFieldOrderableRows('SortID'));



        $sort->setThrowExceptionOnBadDataType(false);
        $filter->setThrowExceptionOnBadDataType(false);
        $pagination->setThrowExceptionOnBadDataType(false);

    }

}


class GridFieldConfig_RecordAndRelationEditor extends GridFieldConfig_RecordEditor {

    public function __construct($itemsPerPage = null) {
        $this->addComponent(new GridFieldButtonRow('before'));
        $this->addComponent(new GridFieldAddNewButton('buttons-before-left'));
        $this->addComponent(new GridFieldToolbarHeader());
        $this->addComponent($sort = new GridFieldSortableHeader());
        $this->addComponent($filter = new GridFieldFilterHeader());
        $this->addComponent(new GridFieldDataColumns());

        $this->addComponent(new GridFieldAddExistingSearchButton());
        $this->addComponent(new GridFieldEditButton());
        $this->addComponent(new GridFieldDeleteAction());
        $this->addComponent(new GridFieldDeleteAction(true));
        $this->addComponent(new GridFieldPageCount('toolbar-header-right'));
        $this->addComponent($pagination = new GridFieldPaginator($itemsPerPage));
        $this->addComponent(new GridFieldDetailForm());

        $sort->setThrowExceptionOnBadDataType(false);
        $filter->setThrowExceptionOnBadDataType(false);
        $pagination->setThrowExceptionOnBadDataType(false);

    }

}

