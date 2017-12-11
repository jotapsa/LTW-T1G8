<?php
  session_start();
  include_once('database/connection.php');
  include_once('database/users.php');

  $password = hash('sha256',$_POST["password"]);

  if(isset($_SESSION['username']) && $_SESSION['username'] != ''){
    if(CheckUserPassword($dbh,$_SESSION['username'],$password)) {
      echo 0;
    }
    else {
      echo 1;
    }
  }
  else {
    echo -1;
  }
 ?>
