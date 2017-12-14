<?php
  include_once('database/connection.php'); // connects to the database
  include_once('database/users.php');      // loads the functions responsible for the users table

  if(isset($_POST['username']) && $_POST['username'] != '' && isset($_POST['password']) && $_POST['password'] != ''){
    if (userExists($dbh,$_POST['username'], $_POST['password'])){
      $_SESSION['username'] = $_POST['username'];
      header('Location: index.php');
      exit();
    }
    else{
      header('Location: login.php');
      exit();
    }
  }
  else{
    header('Location: login.php');
    exit();
  }
?>
