<?php

// @todo delete
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

require_once __DIR__.'/../lib/AutoLoader.php';

$app = new \Fw\Core\Application();
$app->run();