<?php
require 'db.php';
include "Mail.php";
session_start();
//echo $_POST['email'];s
//echo $_POST['name'];
//echo $_POST['lastname'];
//echo "string";
// if (!$mysqli) {
//   echo "Failed to connect to MySQL: " . mysqli_connect_error();
// }else {
//   echo "connected";
// }


$_SESSION['email'] = $_POST['email'];
$_SESSION['first_name'] = $_POST['name'];
$_SESSION['last_name'] = $_POST['lastname'];

$firstname = mysqli_real_escape_string($mysqli,$_POST['name']);
//$firstname = $mysqli->escape_string($_POST['name']);
//echo "<script type='text/javascript'>alert('$firstname');</script>";
$lastname = $mysqli->escape_string($_POST['lastname']);
//echo "<script type='text/javascript'>alert('$lastname');</script>";
$email = $mysqli->escape_string($_POST['email']);
$password = $mysqli->escape_string( password_hash($_POST['password'], PASSWORD_BCRYPT) );
$hash = $mysqli->escape_string( md5( rand(0,1000) ) );
$num = 1;

// $message = $email;
// echo "<script type='text/javascript'>alert('$message');</script>";
// $message = $password;
// echo "<script type='text/javascript'>alert('$message');</script>";
// $message = $hash;
// echo "<script type='text/javascript'>alert('$message');</script>";
// $message = $firstname;
// echo "<script type='text/javascript'>alert('$message');</script>";
//
// $message = "2";
// echo "<script type='text/javascript'>alert('$message');</script>";
// $subject = "This is subject11";
//
// $message = "<b>This is HTML message11.</b>";
// $message .= "<h1>This is headline.</h1>";
//
// mail ($email,$subject,$message);



$message = "3";
echo "<script type='text/javascript'>alert('$message');</script>";
// Check if user with that email already exists
$result = $mysqli->query("SELECT * FROM users WHERE email='$email'") or die($mysqli->error);
// $message = "3.1";
// echo "<script type='text/javascript'>alert('$message');</script>";
// We know user email exists if the rows returned are more than 0
if ( $result->num_rows > 0 ) {
    // $message = "4";
    // echo "<script type='text/javascript'>alert('$message');</script>";

    $_SESSION['message'] = 'User with this email already exists!';
    //echo "error1";
    //header("location: error.php");

}
else { // Email doesn't already exist in a database, proceed...
    // $message = "5";
    // echo "<script type='text/javascript'>alert('$message');</script>";
    // echo "sendemail";
    // active is 0 by DEFAULT (no need to include it here)
    $sql = "INSERT INTO users (name, lastname, email, password, hash) "
            . "VALUES ('$firstname','$lastname','$email','$password', '$hash')";
    // $message = "6";
    // echo "<script type='text/javascript'>alert('$message');</script>";

    // Add user to the database
    if ( $mysqli->query($sql) ){
        // $message = "added to db";
        // echo "<script type='text/javascript'>alert('$message');</script>";

        $_SESSION['active'] = 0; //0 until user activates their account with verify.php
        $_SESSION['logged_in'] = true; // So we know the user has logged in
        $_SESSION['message'] =

                 "Confirmation link has been sent to $email, please verify
                 your account by clicking on the link in the message!";

        // Send registration confirmation link (verify.php)
        $to = $email;
        $subject = 'Account Verification ( alyan.tech )';
        $header = "From:alyantech@gmail.com \r\n";
        $message_body = '
        Hello '.$first_name.',

        Thank you for signing up!

        Please click this link to activate your account:

        http://alyan.tech/pages/verify.php?email='.$email.'&hash='.$hash;

        mail( $to, $subject, $message_body,$header );

        header("location: success.php");
        //
        // echo "second3";

    }

    else {
        // $message = "8";
        // echo "<script type='text/javascript'>alert('$message');</script>";
        $_SESSION['message'] = 'Registration failed!';
        echo "error";
        //header("location: error.php");
    }

}







 ?>
