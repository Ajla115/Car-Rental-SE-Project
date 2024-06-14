<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require '../vendor/autoload.php';
require_once '../config_email.php';


// import and register all business logic files (services) to FlightPHP
require_once __DIR__ . '/services/CustomerService.php';
require_once __DIR__ . '/services/BookingService.php';
require_once __DIR__ . '/services/EmployeeService.php';
require_once __DIR__ . '/services/LocationService.php';
require_once __DIR__ . '/services/ReviewService.php';
require_once __DIR__ . '/services/VehicleService.php';
require_once __DIR__ . '/services/UserService.php';
require_once __DIR__ . '/services/TestemonialsService.php';
require_once __DIR__ . '/services/CarinfoService.php';
require_once __DIR__ . '/services/VisitsService.php';

require_once __DIR__ . '/dao/UserDao.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

Flight::register('customerService', "CustomerService");
Flight::register('bookingService', "BookingService");
Flight::register('employeeService', "EmployeeService");
Flight::register('locationService', "LocationService");
Flight::register('reviewService', "ReviewService");
Flight::register('vehicleService', "VehicleService");
Flight::register('userService', "UserService");
Flight::register('testemonialsService', "TestemonialsService");
Flight::register('carinfoService', "CarinfoService");
Flight::register('visitsService', "VisitsService");

Flight::register('userDao', "UserDao");
Flight::register('customerDao', "CustomerDao");

// middleware
Flight::route('/*', function(){
  //perform JWT decode
  $path = Flight::request()->url;
  if ($path == '/login'  || $path == '/resetpassword' || $path == '/sendemail' || $path == '/tests' || $path == '/visitors' ||  $path == '/customer' ||  $path == '/docs.json') return TRUE; 

 $headers = getallheaders();
  if (@!$headers['Authorization']){
    Flight::json(["message" => "Authorization is missing"], 403);
    return FALSE;
  }else{
    try {
      $decoded = (array) JWT::decode($headers['Authorization'], new Key(Config::JWT_SECRET(), 'HS256'));
      $current_time = time();
      if(isset($decoded['exp']) && $decoded['exp'] < $current_time){
          Flight::json(["message" => "Authorization token has expired"], 403);
          return FALSE;
      }
      if(isset($decoded['iat']) && $current_time - $decoded['iat'] > 86400){ // 86400 seconds = 24 hours
          Flight::json(["message" => "Authorization token was issued more than 24 hours ago"], 403);
          return FALSE;
      }
      Flight::set('user', $decoded);
      return TRUE;
  } catch (\Exception $e) {
      Flight::json(["message" => "Authorization token is not valid"], 403);
      return FALSE;
  }
}
});


/* REST API documentation endpoint */
Flight::route('GET /docs.json', function () {
  $openapi = \OpenApi\scan('routes');
  header('Content-Type: application/json');
  echo $openapi->toJson();
});


// import all routes
require_once __DIR__ . '/routes/CustomerRoutes.php';
require_once __DIR__ . '/routes/BookingRoutes.php';
require_once __DIR__ . '/routes/EmployeeRoutes.php';
require_once __DIR__ . '/routes/LocationRoutes.php';
require_once __DIR__ . '/routes/ReviewRoutes.php';
require_once __DIR__ . '/routes/VehicleRoutes.php';
require_once __DIR__ . '/routes/TestemonialsRoutes.php';
require_once __DIR__ . '/routes/CarinfoRoutes.php';
require_once __DIR__ . '/routes/VisitsRoutes.php';

// it is still possible to add custom routes after the imports
/*Flight::route('GET /', function () {
    //$base = new BaseDao("customers"); ovo je mali hack da se pozove base dao samo na jednu tabelu
});*/


Flight::start();
