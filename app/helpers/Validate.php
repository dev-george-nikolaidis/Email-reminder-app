<?php

class Validate
{

    static function validateEmail($email)
    {
        if (empty($email)) {

            return  "Geben Sie bitte Ihre Email-Adresse ein.";
        }



        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return   "Bitte geben Sie eine gültige E-Mail-Adresse ein.";
        }
    }


    static function validatePassword($password, $customMessage)
    {


        if (empty($password)) {

            return  $customMessage;
        }

        if (strlen($password) < 6) {
            return "Das Passwort muss zwischen 6 und 12 Zeichen lang sein.";
        }

        if (strlen($password) > 16) {
            return "Das Passwort muss zwischen 6 und 12 Zeichen lang sein.";
        }
    }


    static function validateDateInput($input)
    {
        if (empty($input)) {

            return  "Das Datum darf nicht leer sein.";
        }

        if (!(int)$input) {
            return  "Das Datum muss eine Zahl sein.";
        }

        $date = (int)$input;

        if ($date > 31 ||    $date <= 0) {
            return  "Das Datum muss zwischen 1 und 31 liegen.";
        }
    }

    static function validateMonthInput($input)
    {
        if (empty($input)) {

            return  "Die Monatseingabe darf nicht leer sein.";
        }

        if (!(int)$input) {
            return  "Das Monatseingabe muss eine Zahl sein.";
        }

        $date = (int)$input;

        if ($date > 12 ||    $date < 0) {
            return  "Die Monatseingabe muss zwischen 1 und 12 liegen.";
        }
    }

    static function isDateExists($day, $month)
    {
        $currentYear = date("Y");
        $date = checkdate((int)$month, (int)$day, (int)$currentYear);

        if ($date) {
            return true;
        }
    }
}
