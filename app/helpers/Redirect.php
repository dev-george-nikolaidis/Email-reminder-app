<?php

class Redirect
{
    static function redirect($page)
    {
        header("location:" . URL_ROOT . $page);
    }
}
