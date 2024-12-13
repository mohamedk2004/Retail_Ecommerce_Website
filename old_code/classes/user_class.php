<?php
include "enums.php";

$conn = mysqli_connect("localhost", "root", "", "ecommerce_simple_schema");
if (!$conn){
    die("Connection failed: ". mysqli_connect_error());
}
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
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
        // User::db_connection();
        $sql = "SELECT * FROM users WHERE email = '$email' and password = '$pass'";
        $result = mysqli_query($GLOBALS['conn'], $sql);
        if ($row = mysqli_fetch_array($result)) {
            $_SESSION['ID']=$row[0];
            $_SESSION['firstName']=$row['firstname'];
            $_SESSION['lastName']=$row['lastname'];
            $_SESSION['email']=$row['email'];
            $_SESSION['role'] = $row['role'];
            header(header: "Location:/Retail_Ecommerce_Website/user/home_page.php");
            return new User($row[0]);
        }
        echo 'Email & pass not located in database';
        return NULL;
    }

    static function signUp($first, $last, $email, $pass)
    {
        // User::db_connection();
        // $crAt = date('Y-m-d H:i:s');
        $role = str_starts_with($email, 'admin') ? 'admin' : 'customer';

        $sql = "INSERT into users (firstname, lastname, email, password, role) values ('$first','$last', '$email', '$pass', '$role')";
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
        // User::db_connection();
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

    static function editProfile($id,$first,$last,$email,$password = null){
        if($password!==null)
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql="update users SET firstname='$first', lastname='$last',email = '$email' ";
        if($password!==null)
        $sql .=",password='$hashedPassword'";
        $sql.=" where user_id=$id";
        // $sql="update users SET firstname='$first', lastname='$last',email = '$email' where user_id='$id'";
        $result=mysqli_query($GLOBALS['conn'], $sql);
        if($result){
            $_SESSION['firstName']=$first;
            $_SESSION['lastName']=$last;
            $_SESSION['email']=$email;
            header("Location:viewuserprofile.php?update=success");
            echo 'Profile updated successfully';
        }
        else{
            echo 'Failed to update profile '. mysqli_error($GLOBALS['conn']);
        }
        return $result ? true : false;
    }
    // static function editProfile($id, $first, $last, $email) {
    //     $sql = "UPDATE users SET firstname='$first', lastname='$last', email='$email' WHERE user_id=$id";
    //     $result = mysqli_query($GLOBALS['conn'], $sql);
        
    //     if ($result) {
    //         $_SESSION['firstName'] = $first;
    //         $_SESSION['lastName'] = $last;
    //         $_SESSION['email'] = $email;
    //         //  $_SESSION['updateSuccess'] = true;
    //         header("Location: viewuserprofile.php?update=success");
    //         exit(); // Ensure script stops after redirect
    //     } else {
    //         echo 'Failed to update profile: ' . mysqli_error($GLOBALS['conn']);
    //     }
    //     return $result ? true : false;
    // }
     static function deleteAccount($userId) {
        // Ensure connection to the database is established
        global $conn;
    
        // Sanitize the user ID to prevent SQL injection
        $userId = mysqli_real_escape_string($conn, $userId);
    
        // Create the SQL delete query
        $sql = "DELETE FROM users WHERE user_id = '$userId'";
    
        // Execute the query and return the result
        if (mysqli_query($conn, $sql)) {
            return true;  // Deletion successful
        } else {
            error_log("Delete Account Error: " . mysqli_error($conn)); // Log any errors for debugging
            return false; // Deletion failed
        }
    }
}