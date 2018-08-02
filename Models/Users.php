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

    public function getUserId($username)
    {
        $sql = "SELECT id FROM users WHERE username= ?";
        $req = $this->database->prepare($sql);
        $req->execute(array($username));
        $res = $req->fetch(PDO::FETCH_ASSOC);
        return $res["id"];
    }

    public function display_user($id)
    {
        $sql = "SELECT * FROM users WHERE id= ?";
        $req = $this->database->prepare($sql);
        $req->execute(array($id));
        $res = $req->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    public function create_user($username, $password, $email, $group='User')
    {
        $exists = $this->user_exists($username, $password);
        if ($exists) {
            return (false);
        } else {
            $sql = "INSERT INTO users (username,password,email,`group`,banned) VALUES(?, ?, ?, ?, 'no')";
            $req = $this->database->prepare($sql);
            $res = $req->execute(array($username, $password, $email, $group));
            return (true);
        }
    }

    public function edit_user($id, $username, $email, $group, $banned)
    {
        if($banned==null)
        $banned='no';
        else
        $banned='yes';
        $sql = "UPDATE users SET username= ?, email = ?, `group`= ?, banned= ?, edition_date = NOW() WHERE id= ?";
        $req = $this->database->prepare($sql);
        $req->execute(array($username, $email, $group, $banned, $id));
    }

    public function delete_user($id)
    {
        $sql = "DELETE FROM users WHERE id=?";
        $req = $this->database->prepare($sql);
        $req->execute(array($id));
        echo "<p>The account has been deleted.</p>";
        
    }

    public function log_in($username, $password)
    {
        $req = $this->database->prepare("SELECT username, password FROM users WHERE username=:username;");
        $req->execute(array(":username" => $username));
        $res = $req->fetch();
        if (!$res) {
            return false;
        } else {
            if ($res["password"] == $password) {
                $_SESSION['username'] = $res['username'];
                $_SESSION['password'] = $res['password'];
                return true;
            } else {
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
