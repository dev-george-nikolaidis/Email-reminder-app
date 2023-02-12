<?php

require_once "../app/bootstrap.php";

Session::sessionStart();
$app = new Router();
$emailHandler = new Email();
