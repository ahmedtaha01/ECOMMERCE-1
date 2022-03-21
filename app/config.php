<?php

namespace PHPMVC\APP;

defined('DB_HOST_NAME')       ? null : define ('DB_HOST_NAME', 'localhost');
defined('DB_USER_NAME')       ? null : define ('DB_USER_NAME', 'root');
defined('DB_PASSWORD')        ? null : define ('DB_PASSWORD', '');
defined('DB_NAME')            ? null : define ('DB_NAME', 'shop');
defined('DB_PORT_NUMBER')     ? null : define ('DB_PORT_NUMBER', 3306);


define("URLROOT","http://myshop.local/");
define("SITENAME","") ;
define("DS", DIRECTORY_SEPARATOR);
define("APP_PATH",realpath(dirname(__FILE__)));
define("VIEW_PATH" , realpath(dirname(__FILE__).DS."view"));
define("INCLUDES_PATH" , realpath(dirname(__FILE__).DS."view".DS."includes"));
define("LANGUAGES_PATH",APP_PATH.DS."languages".DS."en");
define("UPLOAD_IMG_ITEM" , "images".DS."items".DS);
define("UPLOAD_IMG_USER" , "images".DS."users".DS);
define("ITEM_PATH_SHOW" , URLROOT."images".DS."items".DS);
define("USER_PATH_SHOW" , URLROOT."images".DS."users".DS);

// str_replace('/',DS,$_SERVER['DOCUMENT_ROOT']).DS.