<?php
session_start();
include_once('database/connection.php');
include_once('database/users.php');

if(!isset($_SESSION['username']) && $_SESSION['username'] != ''){
  header('Location: index.php');
  exit();
}

include('templates/common/header.php');  // prints the initial part of the HTML document
include('templates/sessions/change_password.php');
include('templates/common/footer.php');

?>
