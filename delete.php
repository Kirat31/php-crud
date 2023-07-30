<?php
    include ('conn.php');

    $id = $_GET['id'];
    $sql ="SELECT profile FROM info WHERE id='".$id."' ";
    $result = $conn->query($sql);   
    $row = $result->fetch_assoc();
    unlink("upload/".$row['profile']);
    $s ="DELETE FROM info WHERE id='".$id."'";
    $res = $conn->query($s);

    //header("Location: display.php");

?>