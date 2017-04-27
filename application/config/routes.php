<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['default_controller'] = 'Index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//region User
$route['api/user']["get"] = 'API/User/malformed';
$route['api/user/(:num)']["get"] = 'API/User/get/$1';

$route['api/user']["post"] = 'API/User/insert';

$route['api/user']["put"] = 'API/User/malformed';
$route['api/user/(:num)']["put"] = 'API/User/update/$1';

$route['api/user']["delete"] = 'API/User/malformed';
$route['api/user/(:num)']["delete"] = 'API/User/delete/$1';

$route['api/user/login']["post"] = 'API/User/login';
$route['api/user/search']["post"] = 'API/User/search';
$route['api/user/dashboard']["get"] = 'API/User/dashboard';
//endregion

//region Product
$route['api/product']["get"] = 'API/Product/malformed';
$route['api/product/(:num)']["get"] = 'API/Product/get/$1';

$route['api/product']["post"] = 'API/Product/insert';

$route['api/product']["put"] = 'API/Product/malformed';
$route['api/product/(:num)']["put"] = 'API/Product/update/$1';

$route['api/product']["delete"] = 'API/Product/malformed';
$route['api/product/(:num)']["delete"] = 'API/Product/delete/$1';

$route['api/product/getProductsOfToday']["get"] = 'API/Product/getProductsOfToday';
$route['api/product/dashboard']["get"] = 'API/Product/dashboard';

//endregion
