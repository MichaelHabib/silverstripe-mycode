<?php

class TeamPage extends Page {

    static $db = array(
    );
    static $has_one = array(
    );
    static $has_many = array(
    );

}


// Page_controller is only created when page is actually visited
class TeamPage_Controller extends Page_Controller {

    // This will inherit Controller from parent
    function init() {
        parent::init();

    }

}

