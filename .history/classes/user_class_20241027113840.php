<?php
include "./enums.php";

$conn = mysqli_connect("localhost", "root", "", "ecommerce_simple_schema");
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
            User::db_connection();
            $sql = "SELECT * from users where ID=$id";
            $user = mysqli_query($GLOBALS['conn'], $sql);
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

    static function db_connection() {
        if ($GLOBALS['conn']->connect_error) {
            die("Connection failed: " . $GLOBALS['conn']->connect_error);
        } else {
            echo 'Database connection SUCCESSFUL';
        }

    }
    //login functions
    static function login($email, $pass)
    {
        User::db_connection();
        $sql = "SELECT * FROM users WHERE email = '$email' and password = '$pass'";
        $result = mysqli_query($GLOBALS['conn'], $sql);
        if ($row = mysqli_fetch_array($result)) {
            echo 'row found with given email and password';
            return new User($row[0]);
        }
        echo 'Email & pass not located in database';
        return NULL;
    }

    static function signUp($first, $last, $email, $pass)
    {
        User::db_connection();
        // $crAt = date('Y-m-d H:i:s');
        $role = str_starts_with($email, 'admin') ? 'admin' : 'customer';

        $sql = "INSERT into users (firstname, lastname, email, password, role) values ('$first','$last', '$email', '$pass', '$crAt', '$role')";
        if (mysqli_query($GLOBALS['conn'], $sql)) {
            echo 'Signed up SUCCESSFULLY';
            return true;
        } else {
            echo 'Error: ' . mysqli_error($GLOBALS['conn']);  // Add this for detailed error
            return false;
        }
    }

    static function updatePassword($email, $newPassword)
    {
        User::db_connection();
        // Check if the email exists
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($GLOBALS['conn'], $sql);

        if (mysqli_num_rows($result) > 0) {
            // If the email exists, update the password
            echo 'Email exists';
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT); // hash the new password
            $updateSql = "UPDATE users SET password = '$hashedPassword' WHERE email = '$email'";

            if (mysqli_query($GLOBALS['conn'], $updateSql)) {
                echo 'Password update SUCCESSFUL';
                return true;
            } else {
                ECHO 'Password update FAILED';
                return false;
            }
        } else {
            echo 'Email does NOT EXIST';
            return false;
        }
    }
}