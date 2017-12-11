<?php
  session_start();
  include_once('database/connection.php');
  include_once('database/users.php');

  $username = $_GET["username"];
  if(usernameExists($dbh,$username)){
    echo 1;
  }
  else {
    echo 0;
  }
  ?>
