<?php
$host= "alyanpr.cmydnnixocdw.us-west-2.rds.amazonaws.com:3306";
$user= "alyanadmin"
$pass= "password"
$db= "alyanPR"

$mysql= new mysql($host,$user,$pass,$db) or die($mysql->error);

 ?>
