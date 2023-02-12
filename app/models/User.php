<?php

class User
{
    private $db;
    public function __construct()
    {
        $this->db = Database::getDBInstance();
    }


    // find by email
    public function findUserByEmail($email)
    {

        try {
            $this->db->query("SELECT * FROM users WHERE email = :email");
            $this->db->bind(":email", $email);

            $row = $this->db->single();

            // check if user exists
            if ($this->db->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            Redirect::redirect("/errors/500");
            // throw new Exception($e->getMessage());
        }
    }


    public function register($data)
    {


        try {
            $this->db->query("INSERT INTO users ( email , password) values ( :email, :password)");
            $this->db->bind(":email", $data["email"]);
            $this->db->bind(":password", $data["password"]);

            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            Redirect::redirect("/errors/500");
            // throw new Exception($e->getMessage());
        }
    }

    public function login($email, $password)
    {

        try {
            $this->db->query("SELECT * FROM users WHERE email = :email");
            $this->db->bind(":email", $email);
            $row = $this->db->single();
            $hashed_password = $row->password;

            if (password_verify($password, $hashed_password)) {
                return $row;
            } else {
                return false;
            }
        } catch (Exception $e) {
            Redirect::redirect("/errors/500");
            // throw new Exception($e->getMessage());
        }
    }


    public function logout()
    {
        Session::unsetSessionValues([$_SESSION['user_id'], $_SESSION['user_email']]);
        Session::sessionDestroy();
        Redirect::redirect("/users/login");
    }



    public function initUser($user)
    {

        $_SESSION['user_id'] = $user->id;
        $_SESSION["user_email"] = $user->email;
        Redirect::redirect("/");
    }
}
