<?php
    class User {
        public $userId;
        public $firstName;
        public $lastName;
        public $email;
        public $password;
        public $createdAt;
        public $role;

        function __construct($id)	{
            if ($id !=""){
                $sql="select * from users where 	ID=$id";
                $User = mysqli_query($GLOBALS['con'],$sql);
                if ($row = mysqli_fetch_array($User)){
                    $this->UserName=$row["UserName"];
                    $this->Password=$row["Password"];
                    $this->ID=$row["ID"];
                    $this->UserType_obj=new UserType($row["UserType_id"]);
                }
            }
        }
    }
?>