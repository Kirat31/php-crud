<?php
    include ('conn.php');
    
    $sql= "CREATE TABLE info(
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(15),
        email VARCHAR(20),
        phone VARCHAR(15),
        address VARCHAR(30),
        gender VARCHAR(20),
        hobbies VARCHAR(30),
        city VARCHAR(10),
        profile longblob NOT NULL)
        ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";

        if ($conn->query($sql)){
            echo "Table created successfully";
        }
        else{
            echo "Error creating table".$conn->error();
        }

        $conn->close();

?>