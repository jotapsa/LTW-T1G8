<?php
  session_start();                         // starts the session
  include_once('database/connection.php'); // connects to the database
  include_once('database/users.php');      // loads the functions responsible for the users table

  if(!isset($_POST['username']) || !isset($_POST['password']) || !isset($_POST['nickname']) || !isset($_POST['email']) || !isset($_POST['picture'])){
    // $message = "Missing Fields!";
    // echo "<script type='text/javascript'>alert('$message');</script>";
    header('Location: register.php');
    exit();
  }

  if (userExists($dbh,$_POST['username'], $_POST['password'])){
    header('Location: register.php');
    exit();
  }
  else{
    //$message = "Registration Sucessful!";
    RegisterUser($dbh, $_POST['username'], $_POST['password'], $_POST['nickname'], $_POST['email'], $_POST['picture']);
    header('Location: index.php');
    exit();
  }
?>
