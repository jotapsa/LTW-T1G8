<?php
  session_start();
  include_once('database/connection.php');
  include_once('database/users.php');

  $password = hash('sha256',$_POST["newpassword"]);

  if(isset($_SESSION['username']) && $_SESSION['username'] != ''){
    UpdatePassword($dbh,$_SESSION['username'],$password);
  }

  header('Location: index.php');
  exit();
 ?>
