<?php


class Debugger
{
    public static function dd($data, $scriptLocation = null, $runWithoutDie = false)
    {
        echo $scriptLocation ??  $scriptLocation;
        echo '<pre>';
        if ($runWithoutDie) {
            var_dump($data);
        } else {
            die(var_dump($data));
        }
        echo '</pre>';
    }
}
