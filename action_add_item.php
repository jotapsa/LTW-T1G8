<?php
  session_start();
  include_once('database/connection.php');
  include_once('database/lists.php');

  if(isset($_POST["info"]) && $_POST["info"] != '' && isset($_POST["list"]) && $_POST["list"] != ''){
    if(isset($_SESSION['username']) && $_SESSION['username'] != ''){
      if(ListBelongsUser($dbh,$_SESSION['username'],$_POST["list"])) {
        addItem($dbh,$_POST["list"],$_POST["info"]);
        updateModified($dbh,$_POST["list"]);
      }
    }
  }
  else {
    echo -1;
    return;
  }
 ?>
