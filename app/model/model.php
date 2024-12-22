<?php
session_start();
require_once("../app/db/dbh.php");
abstract class Model{
    protected $db;
    protected $conn;

    public function connect(){
        if(null === $this->conn ){
            $this->db = new Dbh();
            $this->conn = $this->db->getConn();
        }
        return $this->db;
    }
}
?>