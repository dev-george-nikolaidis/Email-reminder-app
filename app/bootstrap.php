<?php

require_once "config/config.php";

require_once "helpers/Redirect.php";
require_once "helpers/Debugger.php";
require_once "helpers/Session.php";
require_once "helpers/Validate.php";
require_once "helpers/Session.php";




// Autoload core classes
spl_autoload_register(function ($className) {
    require_once "core/" . $className . ".php";
});
