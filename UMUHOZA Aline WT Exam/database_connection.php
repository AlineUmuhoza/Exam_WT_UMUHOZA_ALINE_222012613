<?php
// Connection details
$host = "localhost";
$user = "Natacha"; // creation of user in database
$pass = "UMUHOZA01"; //creation of password in database
$database = "virtual_product_management_training";

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>