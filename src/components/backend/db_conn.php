<?php
$servername = "localhost";
$dbname = "travel_website";
$username = "root";
$password = "P@ss2525";
$conn = mysqli_connect($servername,$username,$password,$dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>