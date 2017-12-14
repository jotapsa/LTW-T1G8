<?php
  include_once('database/connection.php');
  include_once('database/users.php');

  if(isset($_SESSION['username']) && $_SESSION['username'] != ''){
    header('Location: index.php');
    exit();
  }

  include('templates/common/header.php');
  include('templates/sessions/login.php');
  include('templates/common/footer.php');
?>
