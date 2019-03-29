<?php

ini_set('display_errors', 1);

define('DSN', 'mysql:host=localhost;dbname=linedb;charset=utf8');
define('DB_USERNAME', 'user_name');
define('DB_PASSWORD', 'user_password');

define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST']);

require_once(__DIR__ . '/../lib/functions.php');
require_once(__DIR__ . '/autoload.php');

session_start();
