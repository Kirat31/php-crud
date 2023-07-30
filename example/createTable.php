<?php
    include ('conn.php');
    
    $sql= "CREATE TABLE user_data (
        id int(11) NOT NULL,
        name varchar(100) NOT NULL,
        email varchar(50) NOT NULL,
        phone varchar(100) NOT NULL,
        city varchar(50) NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

        if ($conn->query($sql)){
            echo "Table created successfully";
        }
        else{
            echo "Error creating table".$conn->error();
        }

        $conn->close();

?>