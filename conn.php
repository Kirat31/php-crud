<?php

$conn = new mysqli("localhost", "root", "", "ajaxcrud");

if ($conn->connect_error) {
	die("Connection failure: "
		. $conn->connect_error);
}

?>