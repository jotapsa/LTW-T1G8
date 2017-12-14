<?php
  include_once('database/connection.php');
  include_once('database/users.php');


  if(isset($_SESSION['username']) && $_SESSION['username'] != ''){
    if(isset($_POST["newpassword"]) && $_POST["newpassword"] != ''){
        $password = hash('sha256',$_POST["password"]);
    }
    else {
      echo -1;
      return;
    }

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
