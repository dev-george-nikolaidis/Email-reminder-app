<?php



class Users extends Controller
{


    public function __construct()
    {
        $this->userModel = $this->model("User");
    }





    public function index()
    {
        Redirect::redirect("/users/register");
    }



    public function register()
    {

        // Protect route if the user is already logged in
        if (Session::isUserLoggedIn()) {
            Redirect::redirect("/");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [
                "email" =>  trim($_POST['email']),
                "password" =>  trim($_POST['password']),
                "confirm_password" =>  trim($_POST['confirm_password']),
                "email_err" => "",
                "password_err" => "",

                "confirm_password_err" => "",
                "active-register" => true,
                "page-title" => "Register",
            ];

            // Check if email is valid and not empty
            $data["email_err"] =  Validate::validateEmail($data["email"]) ?? "";

            // Check if the email  already exists in the database
            if (empty($data["email_err"])) {
                if ($this->userModel->findUserByEmail($data["email"])) {
                    $data["email_err"] = "E-Mail ist bereits vorhanden";
                }
            }

            // Check if the password are empty;
            $data["password_err"] = Validate::validatePassword($data["password"], "Bitte geben Sie Ihr Passwort ein") ?? "";
            $data["confirm_password_err"] = Validate::validatePassword($data["confirm_password"], "Bitte wiederholen Sie Ihr Passwort") ?? "";

            // check if the password are  matching 
            if (empty($data["password_err"]) && empty($data["confirm_password_err"])) {
                // Check for match Password
                if ($data["password"] != $data["confirm_password"]) {
                    $data["confirm_password_err"] = "Das passwort stimmt nicht überein";
                    $data["password_err"] = "Das passwort stimmt nicht überein";
                }
            }

            // check if all errors are empty
            if ((empty($data["email_err"])) && (empty($data["password_err"]) && (empty($data["confirm_password_err"])))) {

                // Hashing the password
                $data["password"] = password_hash($data["password"], PASSWORD_DEFAULT);


                if ($this->userModel->register($data)) {
                    $data = [
                        "email" => "",
                        "password" =>  "",
                        "confirm_password" => "",
                        "email_err" => "",
                        "password_err" => "",
                        "confirm_password_err" => "",
                        "active-register" => true,
                        "page-title" => "Register",
                        "register-success" => true
                    ];
                    $this->view("users/register", $data);
                } else {
                    Redirect::redirect("/errors/404");
                }
            } else {
                $this->view("users/register", $data);
            }
        } else {

            $data = [
                "email" => "",
                "password" =>  "",
                "confirm_password" => "",
                "email_err" => "",
                "password_err" => "",
                "confirm_password_err" => "",
                "active-register" => true,
                "page-title" => "Register",
            ];

            $this->view("users/register", $data);
        }
    }




    public function login()
    {
        // Protect route if the user is already logged in
        if (Session::isUserLoggedIn()) {
            Redirect::redirect("/");
        }

        // Check for post
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = [
                "email" =>  trim($_POST['email']),
                "password" =>  trim($_POST['password']),
                "email_err" => "",
                "password_err" => "",
                "active-login" => true,
                "page-title" => "Register",
            ];



            // Check if email is valid and not empty
            $data["email_err"] =  Validate::validateEmail($data["email"]) ?? "";

            // Debugger::dd($data);
            if (empty($data["email_err"])) {
                // Check if the email exist in the database
                if (!$this->userModel->findUserByEmail($data["email"])) {
                    $data["email_err"] = "Kein Benutzer gefunden";
                }
            }

            // Check if the password is empty and between 6 - 12 characters
            $data["password_err"] = Validate::validatePassword($data["password"], "Bitte geben Sie Ihr Passwort ein") ?? "";

            // check if all errors are empty 
            if (empty($data["email_err"]) && empty($data["password_err"])) {


                $user = $this->userModel->login($data["email"], $data["password"]);

                if ($user) {
                    $this->userModel->initUser($user);
                } else {
                    $data["password_err"] = "Falsche Eingabedaten";
                    $this->view("users/login", $data);
                }
            } else {
                $this->view("users/login", $data);
            }
        } else {
            // load form

            $data = [
                "email" => "",
                "password" => "",
                "email_err" => "",
                "password_err" => "",
                "active-login" => true,
                "page-title" => "Login",
            ];

            $this->view("users/login", $data);
        }
    }

    public function logout()
    {
        $this->userModel->logout();
    }
}
