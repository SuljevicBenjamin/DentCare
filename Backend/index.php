<?php
require 'vendor/autoload.php'; 


require_once __DIR__ . '/rest/config.php';
require_once __DIR__ . '/middleware/AuthMiddleware.php';
require_once __DIR__ . '/data/roles.php';


require_once __DIR__ . '/rest/services/BaseService.php';
require_once __DIR__ . '/rest/services/AppointmentsService.php';
require_once __DIR__ . '/rest/services/ContactMessagesService.php';
require_once __DIR__ . '/rest/services/DentistsService.php';
require_once __DIR__ . '/rest/services/PricingPlansService.php';
require_once __DIR__ . '/rest/services/ServicesService.php';
require_once __DIR__ . '/rest/services/UserService.php';
require_once __DIR__ . '/rest/services/AuthService.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);




Flight::register('auth_service', "AuthService");
Flight::register('appointmentsService', 'AppointmentsService');
Flight::register('contactMessagesService', 'ContactMessagesService');
Flight::register('dentistsService', 'DentistsService');
Flight::register('pricingPlansService', 'PricingPlansService');
Flight::register('servicesService', 'ServicesService');
Flight::register('usersService', 'UsersService');
Flight::register('auth_middleware', 'AuthMiddleware');

Flight::before("start", function(&$params, &$output) {
    $url = Flight::request()->url;
    if(
        strpos($url, '/auth/login') !== false ||
        strpos($url, '/auth/register') !== false ||
        strpos($url, '/public/v1/docs') !== false ||
        strpos($url, '/docs') !== false ||
        strpos($url, '/dentists/public') !== false ||
        preg_match('#\.(css|js|png|jpg|jpeg|svg|ico)$#i', $url)
    ) {
        return TRUE;
    } else {
        try {
            $token = Flight::request()->getHeader("Authentication");
            if(!$token) {
                $token = Flight::request()->getHeader("Authorization");
            }
            if(Flight::auth_middleware()->verifyToken($token))
                return TRUE;
        } catch (\Exception $e) {
            Flight::halt(401, $e->getMessage());
        }
    }
});



// Flight::before('start', function () {

//     $publicRoutes = [
//         '/web/backend/auth/login',
//         '/web/backend/auth/register',
//         '/web/backend/dentists/public'
//     ];

//     $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

//     if (in_array($requestUri, $publicRoutes)) {
//         return; // skip auth
//     }

//     $headers = getallheaders();

//     if (!isset($headers['Authorization'])) {
//         Flight::json([
//             'error' => 'Missing authentication header'
//         ], 401);
//         exit;
//     }

    
//     $token = $headers['Authorization'];
//     Flight::auth_middleware()->verifyToken($token);
// });
 

require_once __DIR__ . '/rest/routes/AppointmentsRoutes.php';
require_once __DIR__ . '/rest/routes/ContactMessagesRoutes.php';
require_once __DIR__ . '/rest/routes/DentistsRoutes.php';
require_once __DIR__ . '/rest/routes/PricingPlansRoutes.php';
require_once __DIR__ . '/rest/routes/ServicesRoutes.php';
require_once __DIR__ . '/rest/routes/UserRoutes.php';
require_once __DIR__ .'/rest/routes/AuthRoutes.php';


Flight::start();  
?>
