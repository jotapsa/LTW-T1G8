<?php
  session_start();
  include_once('database/connection.php');
  include_once('database/users.php');

  if(isset($_SESSION['username']) && $_SESSION['username'] != '' && isset($_POST["newpassword"]) && $_POST["newpassword"] != ''){
      $password = hash('sha256',$_POST["newpassword"]);
      UpdatePassword($dbh,$_SESSION['username'],$password);
  }
  header('Location: index.php');
  exit();
 ?>
