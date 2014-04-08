<?php

global $project;
$project = 'mysite';

global $databaseConfig;
$databaseConfig = array(
	"type" => 'MySQLDatabase',
	"server" => 'localhost',
	"username" => 'root',
	"password" => 'pass2000',
	"database" => 'SS3_Base1',
	"path" => '',
);

include_once '_config/_MyConfig.php';