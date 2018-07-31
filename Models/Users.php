<?php

include_once '../Config/Database.php';

class Users
{

    private $database;

    public function __construct()
    {
        $connection = Database::getInstance();
        $this->database = $connection->getConnection();
    }

    public function display_users()
    {
        $sql = "SELECT * FROM users";
        $req = $this->database->query($sql);
        $res = $req->fetchAll(PDO::FETCH_ASSOC);

        return $res;

    }

    public function display_user($id)
    {
        $sql = "SELECT * FROM users WHERE id= ?";
        $req = $this->database->prepare($sql);
        $req->execute(array($id));
        $res = $req->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    public function create_user($username, $password, $email)
    {
        $exists = $this->user_exists($username, $password);
        if ($exists) {
            return (false);
        } else {
            $sql = "INSERT INTO users (username,password,email,`group`,banned) VALUES(?, ?, ?, 0, 1)";
            $req = $this->database->prepare($sql);
            $res = $req->execute(array($username, $password, $email));
            return (true);
        }
    }

    public function edit_user($id, $username = null, $password = null, $email = null)
    {
        $sql = "UPDATE users SET username= ?, password= ?, email = ?, edition_date = NOW() WHERE id= ?";
        $req = $this->database->prepare($sql);
        $req->execute(array($username, $password, $email, $id));
    }

    public function delete_user($id)
    {
        $sql = "DELETE FROM users WHERE id=?";
        $req = $this->database->prepare($sql);
        $req->execute(array($id));
    }

    public function log_in($username, $password)
    {
        $req = $this->database->prepare("SELECT username, password FROM users WHERE username=:username;");
        $req->execute(array(":username" => $username));
        $res = $req->fetch();
        if (!$res) {
            echo "Invalid email/password.";
            return false;
        } else {
            if ($res["password"] == $password) {
                $_SESSION['username'] = $res['username'];
                $_SESSION['password'] = $res['password'];
                return true;
            } else {
                echo "Invalid email/password.";
                return false;
            }

        }
    }

    public function log_out()
    {
        session_destroy();
        unset($_SESSION);
        header("Location: UsersController.php");
    }

    public function get_group($id)
    {
        $sql = "SELECT 'group' FROM users WHERE id= ?";
        $req = $this->database->prepare($sql);
        $req->execute(array($id));
        $res = $req->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    public function user_exists($username, $email)
    {
        $req = $this->database->prepare("SELECT username FROM users WHERE username=:username;");
        $req->execute(array(":username" => $username));
        if ($req->fetch() == false) {
            $req->closeCursor();
            $req = $this->database->prepare("SELECT email FROM users WHERE email=:email;");
            $req->execute(array(":email" => $email));
            if ($req->fetch() != false) {
                echo "<p>Email already linked to another username.</p>";
                return (true);
            }
        } else {
            echo "<p>Username already exists.</p>";
            return (true);
        }
    }
}
