<?php

class Appointments extends Controller
{
    public function __construct()
    {
        $this->appointmentModel = $this->model("Appointment");
    }




    public function index()
    {


        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_new_appointment'])) {


            // First we check if the user is logged in
            if (Session::isUserLoggedIn() == false) {

                $data = [
                    "input_date" =>  "",
                    "input_month" =>  "",
                    "description" =>  "",
                    "time_reminder" => "",
                    "input_date_err" =>  "",
                    "input_month_err" =>  "",
                    "description_err" =>  "",
                    "time_reminder_err" => "",
                    "user_login_err" => "Bitte einloggen",


                    "active-home" => true,
                    "page-title" => "Home"
                ];
                $this->view("appointments/index", $data);
            }


            $time_reminder = !empty($_POST['time_reminder']) ? trim($_POST["time_reminder"]) : "";

            // Map all values 
            $data = [
                "input_date" =>  trim($_POST["input_date"]),
                "input_month" =>  trim($_POST["input_month"]),
                "description" =>  trim($_POST["description"]),
                "time_reminder" => $time_reminder,

                "input_date_err" =>  "",
                "input_month_err" =>  "",
                "description_err" =>  "",
                "time_reminder_err" => "",
                "user_login_err" => "",


                "active-home" => true,
                "page-title" => "Home"
            ];

            // Start the validation
            if (empty($time_reminder)) {
                $data["time_reminder_err"] = "Bitte wählen Sie eine Erinnerungszeit aus.";
            }


            // Check if the inputs are empty  and have the correct values.
            $data["input_date_err"] = Validate::validateDateInput($data["input_date"]) ?? "";
            $data["input_month_err"] = Validate::validateMonthInput($data["input_month"]) ?? "";

            //Check if the date is valid existing date in the calendar 
            if (empty($data["input_date_err"]) && empty($data["input_month_err"])) {
                if (!validate::isDateExists($data["input_date"], $data["input_month"])) {
                    $data["input_date_err"] = "Die Kalenderdaten sind nicht vorhanden";
                    $data["input_month_err"] = "Die Kalenderdaten sind nicht vorhanden";
                }
            }

            // Check if the description is empty
            if (empty($data["description"])) {
                $data["description_err"] = "Die Bezeichnung darf nicht leer sein.";
            }




            // Check if  all errors are empty 
            if (empty($data["input_date_err"]) && empty($data["input_month_err"]) && empty($data["description_err"])  && empty($data["time_reminder_err"]) && Session::isUserLoggedIn()) {


                // check how meany digits the input day and month have (in design the single digit inputs display as 01.)
                if (strlen($data["input_date"]) <= 1) {
                    $data["input_date"] =  "0" . $data["input_date"];
                }

                if (strlen($data["input_month"]) <= 1) {
                    $data["input_month"] =  "0" . $data["input_month"];
                }

                // we send request to the model to create the appointment 
                if ($this->appointmentModel->createAppointment($data)) {

                    Redirect::redirect("/");
                } else {
                    Redirect::redirect("/errors/404");
                }
            } else {


                $this->view("appointments/index", $data);
            }
        }



        if (Session::isUserLoggedIn() == true) {
            $_SESSION["appointments"] =   $this->appointmentModel->getAppointmentByUserId($_SESSION["user_id"]);
        }

        // Default return index  view values
        $data = [
            "input_date" =>  "",
            "input_month" =>  "",
            "description" =>  "",
            "time_reminder" => "",
            "input_date_err" =>  "",
            "input_month_err" =>  "",
            "description_err" =>  "",
            "time_reminder_err" => "",
            "user_login_err" => "",


            "active-home" => true,
            "page-title" => "Home"
        ];

        $this->view("appointments/index", $data);
    }





    public function about()
    {

        $data = [
            "active-about" => true,
            "page-title" => "About"
        ];

        $this->view("appointments/about", $data);
    }


    public function delete()
    {
        // Ajax delete request handing
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {


            $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

            if ($contentType === "application/json") {

                $content = trim(file_get_contents("php://input"));
                $decoded = json_decode($content, true);


                header("Content-Type: application/json");
                if (isset($decoded["item_id"])) {
                    if ($this->appointmentModel->deleteAppointmentById($decoded["item_id"])) {

                        echo json_encode(true);
                    } else {

                        echo json_encode(false);
                    }
                }
            }
        }
    }

    public function update()
    {
        // Ajax update request handing
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {


            $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

            if ($contentType === "application/json") {

                $content = trim(file_get_contents("php://input"));
                $decoded = json_decode($content, true);


                header("Content-Type: application/json");
                if (isset($decoded["item_id"])) {
                    if ($this->appointmentModel->editAppointment($decoded)) {

                        echo json_encode(true);
                    } else {

                        echo json_encode(false);
                    }
                }
            }
        }
    }
}
