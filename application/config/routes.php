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
$route['default_controller']                			    =   'theme/index';
$route['Admin/Login']                       			    =   'logins/login';
$route['Admin/Log-out']                     			    =   'logins/logout';
/*-----------------*/			    
$route['Rayt-Admin/Ajax-Dashboard']         			    =   'dashboard/ajax_dash';  
$route['Rayt-Admin/Dashboard']              			    =   'dashboard/index';  
$route['Rayt-Admin/Forgot-Password']        			    =   'login/forgotpassword'; 
$route['Rayt-Admin/Lock-Screen']        			        =   'login/lockscreen';  
$route['Rayt-Admin/Ajax-Dashboard']         			    =   'dashboard/ajax_dash';  
$route['Rayt-Admin/Permissions']      	    			    =   'permissions/index'; 
$route['Rayt-Admin/AjaxPermission']         			    =   'permissions/ajaxPermission'; 
$route['Rayt-Admin/Permissions']            			    =   'permissions/index'; 
$route['Rayt-Admin/Delete-Role/(:any)']     			    =   'role/delete_role/$1'; 
$route['Rayt-Admin/Update-Role/(:any)']     			    =   'role/update_role/$1'; 
$route['Rayt-Admin/Ajax-Role-Active']      				    =   'role/activedeactive'; 
$route['Rayt-Admin/Ajax-Role-Check']      				    =   'role/unique_role_name'; 
$route['Rayt-Admin/viewRole/(:num)']      				    =   'role/viewRole/$1'; 
$route['Rayt-Admin/Roles']      	        			    =   'role/index'; 
$route['Rayt-Admin/Change-Password']        		    	=   'common/change_password';  
$route['Rayt-Admin/Helpdesk-Enquire']        			    =   'common/helpdesk_enquire';  
$route['Rayt-Admin/viewHelpenquireform/(:any)']        		=   'common/viewHelpenquireform';  
    
/*-------Helpdesk 	----------*/    
$route['Rayt-Admin/Helpdesk-Category']                      = 	'common/helpdesk_category';
$route['Rayt-Admin/viewHelpcategory/(:any)']                =   'common/viewHelpcategory/$1';
$route['Rayt-Admin/Ajax-Helpcategory-Active']               =   'common/helpcategory_activedeactive';
$route['Rayt-Admin/Update-Helpcategory/(:any)']             =   'common/update_helpcategory/$1';
$route['Rayt-Admin/Delete-Helpcategory/(:any)']             =   'common/delete_helpcategory/$1';
$route['Rayt-Admin/Helpdesk-Subcategory']                   =   'common/helpdesk_subcategory';
$route['Rayt-Admin/viewHelpsubcategory/(:any)']             =   'common/viewHelpsubcategory/$1';
$route['Rayt-Admin/Ajax-Helpsubcategory-Active']            =   'common/helpsubcategory_activedeactive/$1';
$route['Rayt-Admin/Update-Helpsubcategory/(:any)']          =   'common/update_helpsubcategory/$1';
$route['Rayt-Admin/Delete-Helpsubcategory/(:any)']          =   'common/delete_helpsubcategory/$1';
$route['Partner-Admin/Helpdesk-Category-List']              =   'common/helpdesk_category_list';
    
$route['Rayt-Admin/Logout']                 			    =   'login/logout';  
$route['Rayt-Admin/Login']                  			    =   'login/index';   
$route['Rayt-Admin']                        			    =   'login/index';   
$route['Rayt-Admin/Users']      	        			    =   'users/index';
$route['Rayt-Admin/country']      	        			    =   'country/country';
$route['Rayt-Admin/Create-Resturant']       			    = 	'resturant/create';
$route['Rayt-Admin/Resturant']              			    = 	'resturant';
$route['Rayt-Admin/Resturant-Menu/(:any)']                  = 	'menu/index';
$route['Rayt-Admin/Create-Orders']          			    = 	'orders/create';
    
/*------------------------------------------------------    ---*/
$route['Rayt-Admin/Menus/(:any)']      			 		    =   'resturant/menus/index/$1';
$route['Rayt-Admin/ViewItems/(:any)/(:any)']                =   'resturant/menus/ViewItems/$1/$2';
$route['Rayt-Admin/viewMenu/(:any)']              		    =   'resturant/menus/viewMenu/$1';
$route['Rayt-Admin/Add-Items/(:any)']              		    =   'resturant/menus/add_items/$1';
$route['Rayt-Admin/Update-Items/(:any)']              	    =   'resturant/menus/update_items/$1';
$route['Rayt-Admin/Weely-Avaliable']              		    =   'resturant/menus/weely_avaliable';
$route['Rayt-Admin/Addon-model']                 		    =   'resturant/menus/addon_model';
$route['Rayt-Admin/Veg-Types']                 		        =   'resturant/menus/veg_types';
$route['Rayt-Admin/Variant-model']                 		    =   'resturant/menus/variant_model';
$route['Rayt-Admin/Min-Selection']                 		    =   'resturant/menus/min_selection';
$route['Rayt-Admin/Add-Category']                 		    =   'resturant/menus/add_category';
$route['Rayt-Admin/Adding-Category']                 	    =   'resturant/menus/adding_category';
$route['Rayt-Admin/Adding-variant']                 	    =   'resturant/menus/adding_variant';
$route['Rayt-Admin/Adding-variants']                        =   'resturant/menus/adding_variants';
$route['Rayt-Admin/Active-Inactive-Item']                   =   'resturant/menus/active_inactive_item';
$route['Rayt-Admin/Delete-Items/(:any)']                    =   'resturant/menus/delete_items/$1';
$route['Rayt-Admin/Delete-Addon-List/(:any)']               =   'resturant/menus/delete_addon_list/$1';
$route['Rayt-Admin/Addons-List']                            =   'resturant/menus/addons_list';
$route['Rayt-Admin/variants-List']                          =   'resturant/menus/variants_list';
$route['Rayt-Admin/Update-Category-Menu/(:any)']            =   'resturant/menus/update_category_menu/$1';
$route['Rayt-Admin/Category-Rest-Delete/(:any)']            =   'resturant/menus/category_rest_delete/$1';
    
/*------------------------------------------------------    ---*/
$route['Rayt-Admin/Orders']                 			    = 	'orders';
$route['Rayt-Admin/payment']                 			    = 	'orders/payment';
$route['Rayt-Admin/viewOrders/(:any)']                 	    = 	'orders/viewOrders/$1';
$route['Rayt-Admin/Counts']                 	            = 	'orders/counts';
    
$route['Rayt-Admin/Drivers']                			    = 	'drivers';
$route['Rayt-Admin/Home']                   			    = 	'home';
$route['Rayt-Admin/Address-Evalution']      			    = 	'address';
    
/*---------------Zones------------------------------*/  
$route['Rayt-Admin/Zones']                  			    = 	'zones/index';
$route['Rayt-Admin/Add-Zones']                  	        = 	'zones/new_zone';
$route['Rayt-Admin/Add-Zone']                  		        = 	'zones/add_zone';
$route['Rayt-Admin/viewZones/(:any)']                  	    = 	'zones/viewZones/$1';
$route['Rayt-Admin/Active-Deactive-Zone']                   =   'zones/activedeactive';
$route['Rayt-Admin/Delete-Zone/(:any)']                     =   'zones/delete_zones/$1'; 
$route['Rayt-Admin/Update-Zone/(:any)']                     =   'zones/update_zones/$1'; 
$route['Rayt-Admin/validation-Zonename']                    =   'zones/validation_name'; 
/*---------------Zones------------------------------*/

/*-------customer restaurant------------------------*/
$route['Country-list']                       			    = 	'apis/countries';
$route['Api-Register']                       			    = 	'apis/register';
$route['Api-Login']                          			    = 	'apis/loginapi';
$route['Api-Verfication']                    			    = 	'apis/verify_otp';
$route['Api-Profile']                        			    = 	'apis/view_profile';
$route['Api-Update-Profile']                 			    = 	'apis/update_profile';
$route['Api-Forgot-Password']                			    = 	'apis/forgotpassword';
$route['Api-Dashboard']                			            = 	'apis/dashboard';
$route['Api-Inner-Dashboard']                			    = 	'apis/inner_dashboard';
$route['Api-Restraint-Details']                			    = 	'apis/restraint_details';
$route['Api-Item-Details']                  			    = 	'apis/item_details';
$route['Api-Addtocart']                  			        = 	'apis/addtocart';
$route['Api-Add-Address']                  			        = 	'apis/addaddress';
$route['Api-Update-Address']                  			    = 	'apis/updateaddress';
$route['Api-View-Address']                  			    = 	'apis/view_address';
$route['Api-Delete-Address']                  			    = 	'apis/delete_address';
$route['Api-View-Cart']                  			        = 	'apis/view_cart';
$route['Api-Update-Cart']                  			        = 	'apis/update_cart';
$route['Api-Delete-Cart']                  			        = 	'apis/delete_cart';
$route['Api-Item-Details-ios']                  		    = 	'apis/item_details_ios';
$route['Api-Cart-payment']                        		    = 	'apis/payment';
$route['Api-Checkout']                  		            = 	'apis/checkout';
$route['Api-Order-History']              		            = 	'apis/order_history';
$route['Api-Order-Details']              		            = 	'apis/order_details';

/*-------customer 	----------*/

$route['Rayt-Admin/viewResturant/(:any)']                   =   'resturant/viewResturant/$1';
$route['Rayt-Admin/Ajax-Resturant-Active']                  =   'resturant/ajax_resturant_active';
$route['Rayt-Admin/Delete-Resturant/(:any)']                =   'resturant/delete_resturant/$1'; 
$route['Rayt-Admin/Update-Resturant/(:any)']                =   'resturant/update_resturant/$1'; 
$route['Rayt-Admin/Update-Resturant-Document/(:any)']       =   'resturant/update_resturant_document/$1'; 
$route['Rayt-Admin/Update-Res-Image-Doc/(:any)']            =   'resturant/update_res_image_doc/$1'; 
$route['Rayt-Admin/Delete-Res-Image-Doc/(:any)']            =   'resturant/delete_res_image_doc/$1'; 
$route['Rayt-Admin/Add-Res-Image-Doc/(:any)']               =   'resturant/add_res_image_doc/$1'; 
$route['Rayt-Admin/Update-Res-Images']                      =   'resturant/update_res_images';
    
/*----------- customer------------*/    
$route['Rayt-Admin/Customers']                              =   'customers';
$route['Rayt-Admin/viewCustomers/(:any)']                   =   'customers/viewCustomers/$1';
$route['Rayt-Admin/Ajax-Customers-Active']                  =   'customers/ajax_customers_active';
$route['Rayt-Admin/Delete-Customers/(:any)']                =   'customers/delete_customers/$1';

/*-------Driver 	----------*/
$route['Rayt-Admin/Drivers']                		        = 	'drivers';
$route['Rayt-Admin/Create-Drivers']       			        = 	'drivers/create';
$route['Rayt-Admin/viewDriver/(:any)']                      =   'drivers/viewDriver/$1';
$route['Rayt-Admin/Ajax-Driver-Active']                     =   'drivers/ajax_driver_active';
$route['Rayt-Admin/Delete-Driver/(:any)']                   =   'drivers/delete_driver/$1'; 
$route['Rayt-Admin/Update-Driver/(:any)']                   =   'drivers/update_driver/$1'; 
$route['Rayt-Admin/Delete-Driver-Image/(:any)']             =   'drivers/delete_driver_image/$1';
$route['Rayt-Admin/Update-Driver-Document/(:any)']          =   'drivers/update_driver_document/$1';  
$route['Rayt-Admin/Update-Dri-Image-Doc/(:any)']            =   'drivers/update_dri_image_doc/$1';
$route['Rayt-Admin/Delete-Dri-Image-Doc/(:any)']            =   'drivers/delete_dri_image_doc/$1'; 
$route['Rayt-Admin/Add-Dri-Image-Doc/(:any)']               =   'drivers/add_dri_image_doc/$1'; 
$route['Rayt-Admin/Update-Dri-Images']                      =   'drivers/update_dri_images';
$route['Rayt-Admin/Ajax-Res-List']                          =   'drivers/ajax_res_list';
$route['Rayt-Admin/Driver-Details/(:any)']                  = 	'drivers/driver_details/$1';
$route['Rayt-Admin/Update-Drive-Loc']                       = 	'drivers/update_drive_loc';

/*----------- country------------*/

$route['Rayt-Admin/Country']                               =   'country';
$route['Rayt-Admin/viewCountry/(:any)']                    =   'country/viewCountry/$1';
$route['Rayt-Admin/Ajax-Country-Active']                   =   'country/ajax_country_active';
$route['Rayt-Admin/Update-Country/(:any)']                 =   'country/update/$1';
$route['Rayt-Admin/Delete-Country/(:any)']                 =   'country/delete_country/$1'; 
$route['Rayt-Admin/coutry_img']                            =   'country/coutry_img';
$route['Rayt-Admin/coutry_names']                          =   'country/coutry_names';

/*----------- cuisine------------*/

$route['Rayt-Admin/Cuisine']                               =   'cuisine';
$route['Rayt-Admin/viewCuisine/(:any)']                    =   'cuisine/viewCuisine/$1';
$route['Rayt-Admin/Ajax-Cuisine-Active']                   =   'cuisine/activedeactive';
$route['Rayt-Admin/Update-Cuisine/(:any)']                 =   'cuisine/update/$1';
$route['Rayt-Admin/Delete-Cuisine/(:any)']                 =   'cuisine/delete_cuisine/$1'; 

/*----------- banner------------*/

$route['Rayt-Admin/Banner']                               =   'banner';
$route['Rayt-Admin/viewBanner/(:any)']                    =   'banner/viewBanner/$1';
$route['Rayt-Admin/Ajax-Banner-Active']                   =   'banner/activedeactive';
$route['Rayt-Admin/Update-Banner/(:any)']                 =   'banner/update/$1';
$route['Rayt-Admin/Delete-Banner/(:any)']                 =   'banner/delete_banner/$1';

/*----------- resturant_banner------------*/
$route['Rayt-Admin/Resturant-Banner']                     =   'resturant_banner';
$route['Rayt-Admin/viewResturant_banner/(:any)']          =   'resturant_banner/viewResturant_banner/$1';
$route['Rayt-Admin/Ajax-Resturant_banner-Active']         =   'resturant_banner/activedeactive';
$route['Rayt-Admin/Update-Resturant-Banner/(:any)']       =   'resturant_banner/update/$1';
$route['Rayt-Admin/Delete-Resturant_banner/(:any)']       =   'resturant_banner/delete_resturant_banner/$1';

/*----------- Category------------*/
$route['Rayt-Admin/Category']                             =   'category/index';
$route['Rayt-Admin/viewcategory/(:any)']                  =   'category/viewcategory/$1';
$route['Rayt-Admin/Update-Category/(:any)']               =   'category/update_category/$1';
$route['Rayt-Admin/Delete-Category/(:any)']               =   'category/delete_category/$1';
$route['Rayt-Admin/Ajax-Category-Active']                 =   'category/ajax_category_active';

/*----------- End Category------------*/
/*----------- addon------------*/

$route['Rayt-Admin/Addon']                                =   'addon';
$route['Rayt-Admin/viewAddon/(:any)']                     =   'addon/viewAddon/$1';
$route['Rayt-Admin/Ajax-Addon-Active']                    =   'addon/activedeactive';
$route['Rayt-Admin/Update-Addon/(:any)']                  =   'addon/update/$1';
$route['Rayt-Admin/Delete-Addon/(:any)']                  =   'addon/delete_addon/$1'; 
 
/*----------- variant------------*/

$route['Rayt-Admin/Variant']                               =   'variant';
$route['Rayt-Admin/viewVariant/(:any)']                    =   'variant/viewVariant/$1';
$route['Rayt-Admin/Ajax-Variant-Active']                   =   'variant/activedeactive';
$route['Rayt-Admin/Update-Variant/(:any)']                 =   'variant/update/$1';
$route['Rayt-Admin/Delete-Variant/(:any)']                 =   'variant/delete_variant/$1';

/*---------------restaurant---------------------*/
$route['Partner-Admin']                  	 			 	=   'pdashboard/index';
$route['Partner-Admin/Dashboard']            			 	=   'order/order_list';//'pdashboard/index';
$route['Partner-Admin/Login']                			 	=   'plogin/index';
$route['Partner-Admin/Logout']              			 	=   'plogin/logout';
$route['Partner-Admin/Menu']              			 		=   'menu/index';
$route['Partner-Admin/ViewItems/(:any)']              		=   'menu/ViewItems/$1';
$route['Partner-Admin/viewMenu/(:any)']              		=   'menu/viewMenu/$1';
$route['Partner-Admin/Add-Items/(:any)']              		=   'menu/add_items/$1';
$route['Partner-Admin/Update-Items/(:any)']              	=   'menu/update_items/$1';
$route['Partner-Admin/Weely-Avaliable']              		=   'menu/weely_avaliable';
$route['Partner-Admin/Addon-model']                 		=   'menu/addon_model';
$route['Partner-Admin/Veg-Types']                 		    =   'menu/veg_types';
$route['Partner-Admin/Variant-model']                 		=   'menu/variant_model';
$route['Partner-Admin/Min-Selection']                 		=   'menu/min_selection';
$route['Partner-Admin/Add-Category']                 		=   'menu/add_category';
$route['Partner-Admin/Adding-Category']                 	=   'menu/adding_category';
$route['Partner-Admin/Adding-variant']                 	    =   'menu/adding_variant';
$route['Partner-Admin/Adding-variants']                     =   'menu/adding_variants';
$route['Partner-Admin/Active-Inactive-Item']                =   'menu/active_inactive_item';

$route['Partner-Admin/Order']                 			    = 	'order/index';
$route['Partner-Admin/ViewOrders/(:any)']                   = 	'order/ViewOrders/$1';
$route['Partner-Admin/Order-Details']                       = 	'order/order_details';
$route['Partner-Admin/Orders-List']                         = 	'order/order_list';
$route['Partner-Admin/Order-Accect']                        = 	'order/order_accect';

/*-------Discount 	----------*/
$route['Partner-Admin/Discount']                			= 	'discount/index';
$route['Partner-Admin/Create-Discount']       			    = 	'discount/create';

/*-------Time 	----------*/
$route['Partner-Admin/Time']                			    = 	'time/index';
$route['Partner-Admin/Regular-Time']                	    = 	'time/regular_time';
    
/*-------Helpdesk 	----------*/
$route['Partner-Admin/Helpdesk']                			= 	'helpdesk/index';

/*-------Reviews 	----------*/
$route['Partner-Admin/Reviews']                			    = 	'reviews/index';
$route['Partner-Admin/Reviews-Summary']                		= 	'reviews/review_summary';
/*---------------End restaurant------------------------*/   
/*---------------End Api restaurant---------------------*/
$route['Login-Restraint']                 	                =   'apis/api_restaurant/login_restraint';
$route['Menu-List']                 	                    =   'apis/api_restaurant/restraint_menu';
$route['Item-Status']                 	                    =   'apis/api_restaurant/activedeactiveitem';
$route['New-Order']                 	                    =   'apis/api_restaurant/neworder';
$route['New-Order-View']                 	                =   'apis/api_restaurant/viewneworder';
$route['Preparing-Order']                 	                =   'apis/api_restaurant/preparing';
$route['Readyfororder']                 	                =   'apis/api_restaurant/ready_for_oder';
$route['Outfordelivery']                 	                =   'apis/api_restaurant/out_for_delivery';
$route['Cancel-Order']                 	                    =   'apis/api_restaurant/cancel_order';
$route['Change-Action']                 	                =   'apis/api_restaurant/change_action';
$route['Change-Status']                 	                =   'apis/api_restaurant/online_offline';
$route['View-Orders']                 	                    =   'apis/api_restaurant/vieworders';
$route['Delay-Order']                 	                    =   'apis/api_restaurant/delay_order';
/*---------------End Api restaurant---------------------*/

/*--------------------Driver Apis----------------------------------*/
$route['Api-Driver-Login']                       	        = 	'apis/api_driver/loginapi';
$route['Api-Driver-Forget']                       	        = 	'apis/api_driver/forget';
$route['Api-Driver-Address-Update']                         = 	'apis/api_driver/present_address_update';
$route['Api-Driver-Logout']                       	        = 	'apis/api_driver/logout';
$route['Api-Driver-Active-Inactive']                        = 	'apis/api_driver/ActiveInactive';
$route['Api-Driver-Support']                       	        = 	'apis/api_driver/support';
$route['tokens']                 	                        =   'apis/api_driver/tokens';
$route['Api-Driver-Times']                 	                =   'apis/api_driver/drivertime';
$route['Api-New-Order']                 	                =   'apis/api_driver/neworder';
$route['Api-Restarent-Details']                 	        =   'apis/api_driver/restarent_details';
$route['Api-Pickup-Order']                 	                =   'apis/api_driver/pickuporder';
$route['Api-takeit-Order']                 	                =   'apis/api_driver/takeitorder';
$route['Api-Arrived-Order']                 	            =   'apis/api_driver/takeitorder';
$route['Api-Delivery-Order']                 	            =   'apis/api_driver/deliveryorder';
$route['Api-today-Order-Amount']                 	        =   'apis/api_driver/today_order_amount';
/*---------------------Driver Apis---------------------------------*/

$route['Driver-Map-Point']                 	                =   'apis/map/driverpoint';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;