<?php
  include_once('database/connection.php');
  include_once('database/users.php');

  if(isset($_GET["username"]) && $_GET["username"] != ''){
    $username = $_GET["username"];
  }
  else {
    echo -1;
    return;
  }

  if(usernameExists($dbh,$username)){
    echo 1;
  }
  else {
    echo 0;
  }
  ?>
