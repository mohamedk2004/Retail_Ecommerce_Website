<?php
include "./database/db_conn.php";
include "./enums.php";

class User
{
    public $userId;
    public $firstName;
    public $lastName;
    public $email;
    public $password;
    public $createdAt;
    public Role $role;

    function __construct($id)
    {
        global $conn;

        if ($id != "") {
            $sql = "select * from users where ID=$id";
            $user = mysqli_query($conn, $sql);
            if ($row = mysqli_fetch_array($user)) {
                $this->firstName = $row["firstname"];
                $this->lastName = $row["lastname"];
                $this->email = $row["email"];
                $this->password = $row["password"];
                $this->createdAt = $row["created_at"];
                $this->role = Role::from($row["role"]);
            }
        }
    }

    //login functions
    static function login($email,$pass){
		$sql="SELECT * FROM users WHERE UserName='$UserName' and Password='$Password'";	
		$result=mysqli_query($GLOBALS['con'],$sql);
		if ($row=mysqli_fetch_array($result)){
			return new User($row[0]); 		
		}
		return NULL;
	}
}