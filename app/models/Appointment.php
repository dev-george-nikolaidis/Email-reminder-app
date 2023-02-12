<?php



class Appointment
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getDBInstance();
    }



    public  function getAppointments()
    {

        try {
            $this->db->query("SELECT * FROM events");
            $results = $this->db->resultSet();

            return $results;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }


    public  function getAppointmentsToBeNotified()
    {

        try {
            $this->db->query("SELECT * FROM events WHERE  notified = 0");
            $results = $this->db->resultSet();

            return $results;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }


    public  function getAppointmentByUserId($id)
    {



        try {
            $this->db->query("SELECT * FROM events WHERE user_id = :id");
            $this->db->bind(":id", $id);
            $results = $this->db->resultSet();
            return $results;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function createAppointment($data)
    {

        try {
            $this->db->query("INSERT INTO events (input_date,input_month ,description,time_reminder,user_id,user_email) VALUES ( :input_date , :input_month,:description,:time_reminder,:user_id,:user_email)");
            $this->db->bind(":input_date", $data['input_date']);
            $this->db->bind(":input_month", $data['input_month']);
            $this->db->bind(":description", $data['description']);
            $this->db->bind(":time_reminder", $data['time_reminder']);
            $this->db->bind(":user_id", $_SESSION['user_id']);
            $this->db->bind(":user_email", $_SESSION['user_email']);
            $this->db->execute();

            return true;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }


    public function editAppointment($data)
    {

        try {
            $this->db->query("UPDATE events SET input_date=:input_date,description=:description,time_reminder=:time_reminder, input_month=:input_month WHERE id = :id");
            $this->db->bind(":id", $data["item_id"]);
            $this->db->bind(":input_date", $data['day']);
            $this->db->bind(":description", $data['description']);
            $this->db->bind(":time_reminder", $data['time_reminder']);
            $this->db->bind(":input_month", $data['month']);
            $this->db->execute();

            return true;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }


    public function markAppointmentClosed($id)
    {

        try {
            $this->db->query("UPDATE events SET notified = :notified  WHERE id = :id");
            $this->db->bind(":id", $id);
            $this->db->bind(":notified", 1);
            $this->db->execute();

            return true;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }



    public  function deleteAppointmentById($id)
    {
        try {
            $this->db->query("DELETE FROM events WHERE (id = :id )");
            $this->db->bind(":id", $id);
            $this->db->execute();
            return true;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
