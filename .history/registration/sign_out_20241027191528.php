<?php
    session_start();
    session_destroy();
    header("Location:http://localhost/Retail_Ecommerce_Website/user/home_page.php");
?>