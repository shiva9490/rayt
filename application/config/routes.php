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
//$route['api'] = 'api';


/***************

admin urls

*/

$route['default_controller']                			=   'dashboard/index';
$route['Admin/Login']                       			=   'logins/login';
$route['Admin/Log-out']                     			=   'logins/logout';
/*-----------------*/			
$route['Rayt-Admin/Ajax-Dashboard']         			=   'dashboard/ajax_dash';  
$route['Rayt-Admin/Dashboard']              			=   'dashboard/index';  
$route['Rayt-Admin/Forgot-Password']        			=   'login/forgotpassword';  
$route['Rayt-Admin/Ajax-Dashboard']         			=   'dashboard/ajax_dash';  
$route['Rayt-Admin/Permissions']      	    			=   'permissions/index'; 
$route['Rayt-Admin/AjaxPermission']         			=   'permissions/ajaxPermission'; 
$route['Rayt-Admin/Permissions']            			=   'permissions/index'; 
$route['Rayt-Admin/Delete-Role/(:any)']     			=   'role/delete_role/$1'; 
$route['Rayt-Admin/Update-Role/(:any)']     			=   'role/update_role/$1'; 
$route['Rayt-Admin/Ajax-Role-Active']      				=   'role/activedeactive'; 
$route['Rayt-Admin/Ajax-Role-Check']      				=   'role/unique_role_name'; 
$route['Rayt-Admin/viewRole/(:num)']      				=   'role/viewRole/$1'; 
$route['Rayt-Admin/Roles']      	        			=   'role/index'; 
$route['Rayt-Admin/Change-Password']        			=   'common/change_password';  
$route['Rayt-Admin/Logout']                 			=   'login/logout';  
$route['Rayt-Admin/Login']                  			=   'login/index';   
$route['Rayt-Admin']                        			=   'login/index';   
$route['Rayt-Admin/Users']      	        			=   'users/index';
$route['Rayt-Admin/country']      	        			=   'country/country';
$route['Rayt-Admin/Create-Resturant']       			= 	'resturant/create';
$route['Rayt-Admin/Resturant']              			= 	'resturant';
$route['Rayt-Admin/Create-Orders']          			= 	'orders/create';
$route['Rayt-Admin/Orders']                 			= 	'orders';
$route['Rayt-Admin/Zones']                  			= 	'zones';
$route['Rayt-Admin/Drivers']                			= 	'drivers';
$route['Rayt-Admin/Home']                   			= 	'home';
$route['Rayt-Admin/Address-Evalution']      			= 	'address';

/*-------customer restaurant----------*/
$route['Country-list']                       			= 	'apis/countries';
$route['Api-Register']                       			= 	'apis/register';
$route['Api-Login']                          			= 	'apis/loginapi';
$route['Api-Verfication']                    			= 	'apis/verify_otp';
$route['Api-Profile']                        			= 	'apis/view_profile';
$route['Api-Update-Profile']                 			= 	'apis/update_profile';
$route['Api-Forgot-Password']                			= 	'apis/forgotpassword';
/*-------customer 	----------*/

$route['Rayt-Admin/viewResturant/(:any)']                 =   'resturant/viewResturant/$1';
$route['Rayt-Admin/Ajax-Resturant-Active']                =   'resturant/ajax_resturant_active';
$route['Rayt-Admin/Delete-Resturant/(:any)']              =   'resturant/delete_resturant/$1'; 
$route['Rayt-Admin/Update-Resturant/(:any)']              =   'resturant/update_resturant/$1'; 
$route['Rayt-Admin/Delete-Res-Image/(:any)']              =   'resturant/delete_res_image/$1';


/*----------- customer------------*/
$route['Rayt-Admin/Customers']                            =   'customers';
$route['Rayt-Admin/viewCustomers/(:any)']                 =   'customers/viewCustomers/$1';
$route['Rayt-Admin/Ajax-Customers-Active']                =   'customers/ajax_customers_active';
$route['Rayt-Admin/Delete-Customers/(:any)']              =   'customers/delete_customers/$1';


/*----------- country------------*/

$route['Rayt-Admin/Country']                               =   'country';
$route['Rayt-Admin/viewCountry/(:any)']                    =   'country/viewCountry/$1';
$route['Rayt-Admin/Ajax-Country-Active']                   =   'country/ajax_country_active';
$route['Rayt-Admin/Update-Country/(:any)']                 =   'country/update/$1';
$route['Rayt-Admin/Delete-Country/(:any)']                 =   'country/delete_country/$1'; 
$route['Rayt-Admin/coutry_img']                            =   'country/coutry_img';
$route['Rayt-Admin/coutry_names']                          =   'country/coutry_names';
$route['Rayt-Admin/coutry_isd']                            =   'country/coutry_isd';

/*---------------restaurant---------------------*/

$route['Partner-Admin']                  	 			 	=   'pdashboard/index';
$route['Partner-Admin/Dashboard']            			 	=   'pdashboard/index';
$route['Partner-Admin/Login']                			 	=   'plogin/index';
$route['Partner-Admin/Logout']              			 	=   'plogin/logout';
$route['Partner-Admin/Menu']              			 		=   'menu/index';
$route['Partner-Admin/ViewItems/(:any)']              		=   'menu/ViewItems/$1';
$route['Partner-Admin/viewMenu/(:any)']              		=   'menu/viewMenu/$1';
$route['Partner-Admin/Add-Items/(:any)']              		=   'menu/add_items/$1';

/*---------------End restaurant---------------------*/

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;