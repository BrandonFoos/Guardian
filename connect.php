<?php
$server = "localhost";
$username = "admin";
$password = "Eden2013";
$database = "Guardian";

$conn = mysqli_connect($server,$username,$password) or die("Error in Connection");
mysqli_select_db($conn, $database ) or die("Could not select database");

if ( $conn->connect_error ){

    die("Connection failed: " . $conn->connect_error);

}

?>
