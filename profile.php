<?php
session_start();
include_once('database/connection.php');
include_once('database/users.php');

if(isset($_SESSION['username']) && $_SESSION['username'] != ''){
  $user = getUserbySession($dbh,$_SESSION['username']);
include('templates/common/header.php');
include('templates/users/show_profile.php');
include('templates/common/footer.php');
}
else{
  header('Location: index.php');
  exit();
}

 ?>
