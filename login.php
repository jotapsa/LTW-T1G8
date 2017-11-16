<?php
  session_start();
  include_once('database/connection.php');
  include_once('database/users.php');

  include('templates/common/header.php');
  include('templates/sessions/login.php');
  include('templates/common/footer.php');
?>
