<?php
require_once(__ROOT__ . "model/model.php");
require_once(__ROOT__ . "model/user.php");

class Users extends Model
{
    private $users;
    function __construct()
    {
        $this->fillArray();
    }

    function fillArray()
    {
        $this->users = array();
        $this->db = $this->connect();
        $result = $this->readUsers();
        while ($row = $result->fetch_assoc()) {
            array_push(
                $this->users,
                new User(
                    $row["user_id"],
                    $row["firstname"],
                    $row["lastname"],
                    $row["email"],
                    $row["password"],
                    $row["created_at"],
                    $row["role"],
                    $row["address"]
                )
            );
        }
    }

    function getUsers()
    {
        return $this->users;
    }

    function readUsers()
    {
        $sql = "SELECT * FROM user";

        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    function addUser($fname, $lname, $email, $password, $role, $address)
    {
        $sql = "INSERT INTO user (fname, password, age, phone) VALUES ('$name','$password', '$age', '$phone')";
        if ($this->db->query($sql) === true) {
            echo "Records inserted successfully.";
            $this->fillArray();
        } else {
            echo "ERROR: Could not able to execute $sql. " . $conn->error;
        }
    }
}