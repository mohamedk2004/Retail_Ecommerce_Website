<?php
  require_once(__ROOT__ . "model/Model.php");

  include "enums.php";

?>

<?php
class User extends Model
{
  private $userId;
  private $fname;
  private $lname;
  private $email;
  private $password;
  private $createdAt;
  private Role $role;


  function __construct($id, $fname = "", $lname = "", $email = "", $password = "", $role = "user")
  {
    $this->userId = $id;
    $this->db = $this->connect();

    if ("" === $fname) {
      $this->readUser($id);
    } else {
      $this->fname = $fname;
      $this->lname = $lname;
      $this->email = $email;
      $this->password = $password;
      $this->createdAt = Date();
      $this->role = $role;
    }
  }

  function getFirstName()
  {
    return $this->fname;
  }
  function setFirstName($fname)
  {
    return $this->fname = $fname;
  }
  
  function getLastName()
  {
    return $this->lname;
  }
  function setLastName($lname)
  {
    return $this->lname = $lname;
  }

  function getEmail()
  {
    return $this->email;
  }
  
  function setEmail($email)
  {
    return $this->email = $email;
  }
  function getPassword()
  {
    return $this->password;
  }
  
  function setPassword($password)
  {
    return $this->password = $password;
  }

  function getCreatedAt()
  {
    return $this->createdAt;
  }
  function setCreatedAt($createdAt)
  {
    return $this->createdAt = Date();
  }

  function getRole()
  {
    return $this->role;
  }
  function setPhone($role)
  {
    return $this->role = $role;
  }

  function getID()
  {
    return $this->userId;
  }

  function readUser($id)
  {
    $sql = "SELECT * FROM user where ID=" . $id;
    $db = $this->connect();
    $result = $db->query($sql);
    if ($result->num_rows == 1) {
      $row = $db->fetchRow();
      $this->fname = $row["firstname"];
      $this->lname = $row["lastname"];
      $_SESSION["firstname"] = $row["firstname"];
      $this->email = $row["email"];
      $this->password = $row["Password"];
      $this->createdAt = $row["created_at"];
      $this->role = $row["role"];
    } else {
      $this->fname = "";
      $this->lname = "";
      $this->email = "";
      $this->password = "";
      $this->createdAt = Date();
      $this->role = "user";
    }
    }

    function editUser($fname, $lname, $email, $password, $age, $phone)
    {
      $sql = "update user set name='$name',password='$password', age='$age', phone='$phone' where id=$this->id;";
      if ($this->db->query($sql) === true) {
        echo "updated successfully.";
        $this->readUser($this->id);
      } else {
        echo "ERROR: Could not able to execute $sql. " . $conn->error;
      }

    function deleteUser()
    {
      $sql = "delete from user where id=$this->id;";
      if ($this->db->query($sql) === true) {
        echo "deletet successfully.";
      } else {
        echo "ERROR: Could not able to execute $sql. " . $conn->error;
      }
    }

  }
}