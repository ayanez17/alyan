<?php
$host= "alyandb.cmydnnixocdw.us-west-2.rds.amazonaws.com";
$user= "root";
$pass= "password";
$db= "alyan";

$mysqli= new mysqli($host,'root','password', "alyan")or die($mysqli->error);
echo mysqli_ping() ;
if (!$mysqli) {
    die("Connection failed: " . mysqli_connect_error());
}
 ?>
