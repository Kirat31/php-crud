<?php

$conn = new mysqli("localhost", "root", "", "example");

if ($conn->connect_error) {
	die("Connection failure: "
		. $conn->connect_error);
}

?>