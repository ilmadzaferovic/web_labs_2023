<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../vendor/autoload.php';
// import and register all business logic files (services) to FlightPHP
require_once __DIR__ . '/services/UserService.php';
require_once __DIR__ . '/services/BaseService.php';
Flight::register('userService', "UserService");
Flight::register('baseService', "BaseService");
// import all routes
require_once __DIR__ . '/routes/UserRoutes.php';

// it is still possible to add custom routes after the imports

Flight::start();
?>