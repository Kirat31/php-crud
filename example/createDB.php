<?php
     include ('conn.php');

     $sql = "CREATE DATABASE example";

     if ($conn->query($sql) === TRUE)
     {
         echo "Database created successfully";
     }
     else{
         echo "Error creating database ".$conn->error();
     }
?>