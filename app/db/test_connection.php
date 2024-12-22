<?php
require_once("dbh.php");

// Create an instance of the DBh class
$db = new DBh();

// Test the connection
if ($db->getConn()) {
    echo "Database connected successfully!";
} else {
    echo "Failed to connect to the database.";
}
?>
