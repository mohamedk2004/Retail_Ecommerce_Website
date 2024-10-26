<?php
// include "./database/db_conn.inc.php";
include "./enums.php";

$conn = mysqli_connect("localhost", "root", "","ecommerce_simple_schema");
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
        // global $conn;

        if ($id != "") {
            $sql = "SELECT * from users where ID=$id";
            $user = mysqli_query($GLOBALS['$conn'], $sql);
            if ($row = mysqli_fetch_array($user)) {
                $this->userId = $row["user_id"];
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
    static function login($email, $pass)
    {
        $sql = "SELECT * FROM users WHERE email = '$email' and password = '$pass'";
        $result = mysqli_query($GLOBALS['$conn'], $sql);
        if ($row = mysqli_fetch_array($result)) {
            return new User($row[0]);
        }
        return NULL;
    }

    static function signUp($fn, $ln, $em, $pss, $crAt, $rle)	{
		$sql="INSERT into users (firstname, lastname, email, password, created_at) values ('$UN','$PW',2)";
		if(mysqli_query($GLOBALS['con'],$sql))
			return true;
		else
			return false;
	}
}