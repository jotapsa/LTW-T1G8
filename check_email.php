<?php
  include_once('database/connection.php');
  include_once('database/users.php');

  if(isset($_GET["email"]) && $_GET["email"] != ''){
    $email = $_GET["email"];
  }
  else {
    echo -1;
    return;
  }

  if(emailExists($dbh,$email)){
    echo 1;
  }
  else {
    echo 0;
  }
  ?>
