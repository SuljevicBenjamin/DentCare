<?php
require 'vendor/autoload.php'; //run autoloader

// Load configuration
require_once __DIR__ . '/rest/config.php';

// Load services
require_once __DIR__ . '/services/BaseService.php';
require_once __DIR__ . '/services/AppointmentsService.php';
require_once __DIR__ . '/services/ContactMessagesService.php';
require_once __DIR__ . '/services/DentistsService.php';
require_once __DIR__ . '/services/PricingPlansService.php';
require_once __DIR__ . '/services/ServicesService.php';
require_once __DIR__ . '/services/UserService.php';

// Register services
Flight::register('appointmentsService', 'AppointmentsService');
Flight::register('contactMessagesService', 'ContactMessagesService');
Flight::register('dentistsService', 'DentistsService');
Flight::register('pricingPlansService', 'PricingPlansService');
Flight::register('servicesService', 'ServicesService');
Flight::register('usersService', 'UsersService');

// Load routes
require_once __DIR__ . '/routes/AppointmentsRoutes.php';
require_once __DIR__ . '/routes/ContactMessagesRoutes.php';
require_once __DIR__ . '/routes/DentistsRoutes.php';
require_once __DIR__ . '/routes/PricingPlansRoutes.php';
require_once __DIR__ . '/routes/ServicesRoutes.php';
require_once __DIR__ . '/routes/UserRoutes.php';


Flight::start();  //start FlightPHP
?>
