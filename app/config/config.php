<?php
define("APP_ROOT", dirname(dirname(__FILE__)));
define("APP_NAME", "Calendar Reminder");


// Database Params
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_NAME", "calendar");
define("DB_PASS", "");

//!! This value must   match the rewrite path at  calendar/public/.htaccess  (RewriteBase rule) and make sure you have the correct apache configs
define("URL_ROOT",  "http://localhost/calendar");
