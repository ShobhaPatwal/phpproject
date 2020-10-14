<?php

$siteurl = "http://localhost/training/projects/";
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "password";
$dbname = "shopping_store";

// Create connection
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>