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
                $this->firstName = $row["firstName"];
                $this->Password = $row["Password"];
                $this->ID = $row["ID"];
                $this->UserType_obj = new UserType($row["UserType_id"]);
            }
        }
    }
}