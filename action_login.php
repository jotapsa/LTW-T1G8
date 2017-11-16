<?php
  session_start();                         // starts the session
  include_once('database/connection.php'); // connects to the database
  include_once('database/users.php');      // loads the functions responsible for the users table

  if (userExists($dbh,$_POST['username'], $_POST['password'])){
    $_SESSION['username'] = $_POST['username'];
    header('Location: index.php');
    exit();
  }
  else{
    header('Location: login.php');
    exit();
  }
?>
