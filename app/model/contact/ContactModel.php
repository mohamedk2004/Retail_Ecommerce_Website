
<?php
// ContactModel.php
require_once(__ROOT__ . "model/model.php");
require_once(__ROOT__ . "model/contact.php");

class ContactModel extends Model
{
    private $contacts;

    function __construct()
    {
        $this->fillArray();
    }

    function fillArray()
    {
        $this->contacts = array();
        $this->db = $this->connect();
        $result = $this->readContacts();
        while ($row = $result->fetch_assoc()) {
            array_push(
                $this->contacts,
                new Contact(
                    $row["contact_id"],
                    $row["name"],
                    $row["email"],
                    $row["subject"],
                    $row["message"]
                )
            );
        }
    }

    function getContacts()
    {
        return $this->contacts;
    }

    function readContacts()
    {
        $sql = "SELECT * FROM contact";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    function addContact($name, $email, $subject, $message)
    {
        $sql = "INSERT INTO contact (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";
        if ($this->db->query($sql) === true) {
            echo "<div style='color: green;'>Contact added successfully.</div>";
            $this->fillArray();
        } else {
            echo "<div style='color: red;'>ERROR: Could not execute $sql. " . $this->db->error . "</div>";
        }
    }
}
?>