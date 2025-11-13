<?php
require 'vendor/autoload.php'; 


require_once __DIR__ . '/rest/config.php';


require_once __DIR__ . '/rest/services/BaseService.php';
require_once __DIR__ . '/rest/services/AppointmentsService.php';
require_once __DIR__ . '/rest/services/ContactMessagesService.php';
require_once __DIR__ . '/rest/services/DentistsService.php';
require_once __DIR__ . '/rest/services/PricingPlansService.php';
require_once __DIR__ . '/rest/services/ServicesService.php';
require_once __DIR__ . '/rest/services/UserService.php';


Flight::register('appointmentsService', 'AppointmentsService');
Flight::register('contactMessagesService', 'ContactMessagesService');
Flight::register('dentistsService', 'DentistsService');
Flight::register('pricingPlansService', 'PricingPlansService');
Flight::register('servicesService', 'ServicesService');
Flight::register('usersService', 'UsersService');


require_once __DIR__ . '/rest/routes/AppointmentsRoutes.php';
require_once __DIR__ . '/rest/routes/ContactMessagesRoutes.php';
require_once __DIR__ . '/rest/routes/DentistsRoutes.php';
require_once __DIR__ . '/rest/routes/PricingPlansRoutes.php';
require_once __DIR__ . '/rest/routes/ServicesRoutes.php';
require_once __DIR__ . '/rest/routes/UserRoutes.php';


Flight::start();  
?>
