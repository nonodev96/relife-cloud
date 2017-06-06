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
$route['api/user']["get"] = 'api/User/malformed';
$route['api/user/(:num)']["get"] = 'api/User/get/$1';
$route['api/user']["post"] = 'api/User/insert';

$route['api/user']["put"] = 'api/User/malformed';
$route['api/user/(:num)']["put"] = 'api/User/update/$1';
$route['api/user']["delete"] = 'api/User/malformed';
$route['api/user/(:num)']["delete"] = 'api/User/delete/$1';

$route['api/user/login']["post"] = 'api/User/login';
$route['api/user/search']["post"] = 'api/User/search';
$route['api/user/dashboard']["get"] = 'api/User/dashboard';

$route['users/(:num)'] = 'Users/edit/$1';
$route['users/new'] = 'Users/new_user';
$route['users/deleteUsers']['post'] = 'Users/deleteUsers';
$route['users/uploadImage/(:num)']['post'] = 'Users/uploadImage/$1';
//endregion

//region Product
$route['api/product/(:num)']["get"] = 'api/Product/get/$1';
$route['api/product']["post"] = 'api/Product/insert';
$route['api/product/(:num)']["put"] = 'api/Product/update/$1';
$route['api/product/(:num)']["delete"] = 'api/Product/delete/$1';

$route['api/product/search']["post"] = 'api/Product/search';
$route['api/product/getAllProducts']["get"] = 'api/Product/getAllProducts';
$route['api/product/getProductsOfToday']["get"] = 'api/Product/getProductsOfToday';
$route['api/product/dashboard']["get"] = 'api/Product/dashboard';

$route['products/search/(:any)']["get"] = 'Products/search/$1';
$route['products/(:num)'] = 'Products/edit/$1';
$route['products/new'] = 'Products/new_product';
$route['products/deleteProducts']['post'] = 'Products/deleteProducts';
$route['products/uploadImage/(:num)']['post'] = 'Products/uploadImage/$1';
//endregion

//region Sale
$route['api/sale']["get"] = 'api/Sale/malformed';
$route['api/sale/(:num)']["get"] = 'api/Sale/get/$1';

$route['api/sale/getAllBids']["get"] = 'api/Sale/getAllBids';

$route['api/sale']["post"] = 'api/Sale/insert';
//endregion