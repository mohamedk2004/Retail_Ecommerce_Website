<?php
require_once(__ROOT__ . "model/model.php");

include "enums.php";

?>

<?php
class User extends Model
{
  private $user_id;
  private $fname;
  private $lname;
  private $email;
  private $password;
  private $createdAt;
  private Role $role;
  private $address;
  private $phone;


  function __construct($id, $fname = "", $lname = "", $email = "", $password = "", $role = "customer", $address = "", $phone="")
  {
    $this->user_id = $id;
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
      $this->address = $address;
      $this->phone = $phone;
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
  function setRole($role)
  {
    return $this->role = $role;
  }

  function getPhone()
  {
    return $this->phone;
  }
  function setPHONE($phone)
  {
    return $this->phone = $phone;
  }
  function getAddress()
  {
    return $this->address;
  }
  function setAddress($address)
  {
    return $this->address = $address;
  }

  function getID()
  {
    return $this->user_id;
  }
  



  function readUser($id)
  {
    $sql = "SELECT * FROM user where user_id=" . $id;
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
      $this->address = $row["address"];
      $this->phone = $row["phone"];
    } else {
      $this->fname = "";
      $this->lname = "";
      $this->email = "";
      $this->password = "";
      $this->createdAt = Date();
      $this->role = "customer";
      $this->address = "";
      $this->phone = "";
    }
  }

  function editUser($fname, $lname, $email, $password, $address, $phone)
  {
    $sql = "update user set firstname='$fname', lastname='$lname', email='$email', password='$password', address='$address', phone='$phone' where user_id=$this->user_id;";
    if ($this->db->query($sql) === true) {
      echo "updated successfully.";
      $this->readUser($this->user_id);
    } else {
      echo "ERROR: Could not able to execute $sql. " . $conn->error;
    }
  }

  function deleteUser()
  {
    $sql = "delete from user where id=$this->user_id;";
    if ($this->db->query($sql) === true) {
      echo "deletet successfully.";
    } else {
      echo "ERROR: Could not able to execute $sql. " . $conn->error;
    }
  }
}