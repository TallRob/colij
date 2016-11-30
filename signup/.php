<?php
 ob_start();
 session_start();

 include_once 'script/connection.php';
 mysqli_select_db ('users');

 $error = false;

 if ( isset($_POST['btn-signup']) )
 {
  
  // clean user inputs to prevent sql injections
  $username = trim($_POST['username']);
  $username = strip_tags($username);
  $username = htmlspecialchars($username);
  
  $password = trim($_POST['password']);
  $password = strip_tags($password);
  $password = htmlspecialchars($password);
  
  $exists = mysqli_fetch_assoc($link,"SELECT * FROM users WHERE username = '$username'");
  $type = "Guest";
  
  // username validation
  if (empty($username)) {
   $error = true;
   $nameError = "Please enter a username.";
  } else if (strlen($username) < 5) {
   $error = true;
   $nameError = "Your username must have atleast 5 characters.";
  } else if (strlen($username) > 24) {
   $error = true;
   $nameError = "Your username can't be longer than 24 characters.";
  } else if (!preg_match("/^[a-zA-Z ]+$/",$username)) {
   $error = true;
   $nameError = "Name must contain alphabetic characters and space.";
  } else if ($exists > 0) {
	$error = true;
	$nameError = "Sorry, that username already exists";
  }
  
  // password validation
  if (empty($password)){
   $error = true;
   $passError = "Please enter a password.";
  }
  else if(strlen($password) < 6)
  {
   $error = true;
   $passError = "Your password must have atleast 6 characters.";
  }
  else if (strlen($username) > 24)
  {
   $error = true;
   $passError = "Your password can't be longer than 24 characters.";
  }
  
 
   
  // if there's no error, continue to signup
  if( !$error ) {
   
   $sql = "INSERT INTO users (username, password, type) VALUES ('". $username."', '". $password."', '". $type."')";
   
   $result = mysqli_query($link, $sql);
   	  
   if ($result)
   {
	   $errTyp = "success";
	   $errMSG = "Account successfully created.";
	   unset($username);
	   unset($password);
	}
	else
	{
	   $errTyp = "danger";
	   $errMSG = "Something went wrong, try again later..."; 
    }
  }
 }
?>
