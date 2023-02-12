<?php



// Email class is responsible for sending emails to the user that must be notified


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

class Email extends Controller
{

    public function __construct()
    {
        $this->appointmentModel = $this->model("Appointment");
        $data = $this->fetchAllAppointmentsToBeNotified();;


        if (count($data) > 0) {
            foreach ($data as $key => $appointment) {


                $appointment_time = date_create($appointment->input_date . "-" . $appointment->input_month . "-" . date("Y"));
                $time_now = date_create(date("Y-m-d"));
                $difference  = date_diff($time_now, $appointment_time);
                $difference_in_days = (int)$difference->format("%a");
                $time_to_be_reminded = $this->findTheTimeReminder($appointment->time_reminder);

                // check if  the time difference between the time to be reminded and difference in days match to send the email notification to the user.
                if ($difference_in_days <= $time_to_be_reminded) {
                    $desc = $appointment->description;
                    $message = "Dear user your appointment ${desc} is coming  in ${difference_in_days} days.";
                    if ($this->sendEmail($appointment->user_email, $message)) {
                        $this->appointmentModel->markAppointmentClosed($appointment->id);
                    }
                }
            }
        }
    }

    private function sendEmail($emailRecipient, $messageBody)
    {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Mailer = "smtp";


        // $mail->SMTPDebug  = 1;
        $mail->SMTPAuth   = TRUE;
        $mail->SMTPSecure = "tls";
        $mail->Port       = 587;
        $mail->Host       = "smtp.gmail.com";
        $mail->Username   = "testemail445055@gmail.com";
        $mail->Password   = "ahtptusfdakyftzg";
        $mail->Subject = "Appointment reminder";

        $mail->IsHTML(true);
        $mail->AddAddress($emailRecipient);
        $mail->SetFrom("testemail445055@gmail.com");
        $mail->Body = $messageBody;

        if (!$mail->send()) {
            return false;
        } else {
            return true;
        }
        $mail->smtpClose();
    }

    private function fetchAllAppointmentsToBeNotified()
    {
        return $data = $this->appointmentModel->getAppointmentsToBeNotified();
    }


    private function findTheTimeReminder($time)
    {
        switch ($time) {
            case '1 Tag':
                return  1;
                break;
            case '2 Tage':
                return  2;
                break;
            case '4 Tage':
                return   4;
                break;
            case '1 Woche':
                return   7;
                break;
            default:
                return  14;
                break;
        }
    }
}
