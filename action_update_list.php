<?php
  session_start();
  include_once('database/connection.php');
  include_once('database/lists.php');

  if(isset($_SESSION['username']) && $_SESSION['username'] != ''){
    if(isset($_GET["new"]) && $_GET["new"] != ''){

    }
    else {
      echo NumberofLists($dbh);
    }


  }
  else {
    echo -1;
    return;
  }

 ?>
