<?php
  session_start();
  include_once('database/connection.php');
  include_once('database/lists.php');

  $idList = $_GET["list"];

  if(!isset($_SESSION['username'] )

  if(isset($_SESSION['username']) && $_SESSION['username'] != ''){
      echo 0;
  }
  else {
    echo -1;
  }
 ?>
