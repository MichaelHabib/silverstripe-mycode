<?php

/**
 * Create Database Backup.
 * 
 * Description:
 *  - http://www.daniloaz.com/en/560/programming/backup-de-bases-de-datos-mysql-con-php/
 *  - cc
 * 
 */
class TestTask extends BuildTask {

    protected $title = 'Test Task';
    protected $description = 'Run some test code where on demand';
    protected $enabled = true;

    function run($request) {
        echo $this->create_link('?method=xxx');

    }

    public function create_link($link, $text = null, $target = null) {
        if (!$text) {
            $text = $link;
        }
        if (!$target) {
            $target = '_self';
        }
        return "<a href=\"$link\" target=\"$target\"> $text </a>";

    }

}