<?php

// HTTP
define('HTTP_SERVER', 'http://pro.test/admin/');
define('HTTP_CATALOG', 'http://pro.test/');

// HTTPS
define('HTTPS_SERVER', 'http://pro.test/admin/');
define('HTTPS_CATALOG', 'http://pro.test/');

// DIR
define('APPBASEPATH', str_replace('\\', '/', dirname(dirname(__FILE__))) . '/');
// echo APPBASEPATH;
define('DIR_APPLICATION',  APPBASEPATH.'admin/');
define('DIR_SYSTEM',  APPBASEPATH.'system/');
define('DIR_LANGUAGE',  APPBASEPATH.'admin/language/');
define('DIR_TEMPLATE',  APPBASEPATH.'admin/view/template/');
define('DIR_CONFIG',  APPBASEPATH.'system/config/');
define('DIR_IMAGE',  APPBASEPATH.'image/');
define('DIR_CACHE',  APPBASEPATH.'system/storage/cache/');
define('DIR_DOWNLOAD',  APPBASEPATH.'system/storage/download/');
define('DIR_UPLOAD',  APPBASEPATH.'system/storage/upload/');
define('DIR_LOGS', APPBASEPATH.'system/storage/logs/');
define('DIR_CATALOG', APPBASEPATH.'catalog/');
define('DIR_MODIFICATION', APPBASEPATH.'system/storage/modification/');


// DB
define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '12345678');
define('DB_DATABASE', 'provision');
define('DB_PORT', '3306');
define('DB_PREFIX', 'oc_');
