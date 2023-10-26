<?php
define('DIR_BASE', __DIR__ . '/../');
define('DIR_CONFIG', DIR_BASE . 'Config/');
define('DIR_CONTROLLER', DIR_BASE . 'Controller/');
define('DIR_MODEL', DIR_BASE . 'Model/');
define('DIR_VIEW', DIR_BASE . 'View/');
define('DIR_PRIVATE', DIR_BASE . 'Private/');
define('DIR_PUBLIC', DIR_BASE . 'Public/');

define('BASE_HREF', '/');
/* Avec Composer Autoload */
require_once DIR_BASE . 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(DIR_BASE);
$dotenv->safeLoad();
session_start();

ini_set("display_errors", "off");
error_reporting(E_ALL);

set_error_handler(['\Controller\App_Exceptions', 'PhpErrors'], E_ALL);
register_shutdown_function(['\Controller\App_Exceptions', 'PhpFatalErrors']);


define('DB_HOST', $_ENV['DB_HOST']);
define('DB_NAME', $_ENV['DB_NAME']);
define('DB_USER', $_ENV['DB_USER']);
define('DB_PASSWORD', $_ENV['DB_PASSWORD']);

require_once DIR_CONFIG . 'routes.php';
