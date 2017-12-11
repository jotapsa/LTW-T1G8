<?php
  session_start();
  include_once('database/connection.php');
  include_once('database/users.php');

  $email = $_GET["email"];
  if(emailExists($dbh,$email)){
    echo 1;
  }
  else {
    echo 0;
  }
  ?>
