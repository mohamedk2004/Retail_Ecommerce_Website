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
    return $this->fname = $fname;
  }

  function getPassword()
  {
    return $this->password;
  }
  function setPassword($password)
  {
    return $this->password = $password;
  }

  function getAge()
  {
    return $this->age;
  }
  function setAge($age)
  {
    return $this->age = $age;
  }

  function getPhone()
  {
    return $this->phone;
  }
  function setPhone($phone)
  {
    return $this->phone = $phone;
  }

  function getID()
  {
    return $this->id;
  }

  function readUser($id)
  {
    $sql = "SELECT * FROM user where ID=" . $id;
    $db = $this->connect();
    $result = $db->query($sql);
    if ($result->num_rows == 1) {
      $row = $db->fetchRow();
      $this->name = $row["Name"];
      $_SESSION["Name"] = $row["Name"];
      $this->password = $row["Password"];
      $this->age = $row["Age"];
      $this->phone = $row["Phone"];
    } else {
      $this->name = "";
      $this->password = "";
      $this->age = "";
      $this->phone = "";
    }
    function editUser($name, $password, $age, $phone)
    {
      $sql = "update user set name='$name',password='$password', age='$age', phone='$phone' where id=$this->id;";
      if ($this->db->query($sql) === true) {
        echo "updated successfully.";
        $this->readUser($this->id);
      } else {
        echo "ERROR: Could not able to execute $sql. " . $conn->error;
      }

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