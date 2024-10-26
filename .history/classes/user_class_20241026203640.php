<?php
include "./database/db_conn.php";

class User
{
    public $userId;
    public $firstName;
    public $lastName;
    public $email;
    public $password;
    public $createdAt;
    public $role;

    function __construct($id)
    {
        if ($id != "") {
            $sql = "select * from users where ID=$id";
            $user = mysqli_query($conn, $sql);
            if ($row = mysqli_fetch_array($user)) {
                $this->firstName = $row["firstname"];
                $this->lastName = $row["lastname"];
                $this->email = $row["lastname"];
                $this->password = $row["lastname"];
                $this->lastNpaame = $row["lastname"];
            }
        }
    }
}