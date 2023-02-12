<?php

class Session

{
    public function __construct()
    {
    }

    public static function sessionStart()

    {
        session_start();
    }

    public static function sessionDestroy()
    {
        session_destroy();
    }

    public static function unsetSessionValues($arrayOfSessionsValues)
    {
        foreach ($arrayOfSessionsValues as $value) {
            unset($value);
        }
    }

    public static function isUserLoggedIn()
    {

        if (isset($_SESSION['user_id'])) {
            return true;
        } else {
            return false;
        }
    }
}
