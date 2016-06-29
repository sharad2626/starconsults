<?php
$conn = mysql_connect("localhost","starcon5_wp","WFFZVDPgVNh+");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$db=mysql_select_db("starcon5_wp");
?>