<?php
  session_start();
  include_once('database/connection.php');
  include_once('database/users.php');

  if(isset($_SESSION['username']) && $_SESSION['username'] != '' && isset($_POST["newpassword"]) && $_POST["newpassword"] != '' && isset($_POST["oldpassword"]) && $_POST["oldpassword"] != ''){
      if(userExists($dbh,$_SESSION['username'],$_POST["oldpassword"])){
        UpdatePassword($dbh,$_SESSION['username'],$_POST["newpassword"]);
        header('Location: index.php');
        exit();
      }
      else{
        header('Location: change_password.php');
        exit();
      }
  }
  else {
    header('Location: change_password.php');
    exit();
  }
 ?>
