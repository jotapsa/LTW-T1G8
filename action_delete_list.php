<?php
  include_once('database/connection.php');
  include_once('database/lists.php');

  if(isset($_GET["list"]) && $_GET["list"] != ''){
    $idList = $_GET["list"];
  }
  else {
    echo -1;
    return;
  }

  if(isset($_SESSION['username']) && $_SESSION['username'] != '' && ListBelongsUser($dbh,$_SESSION['username'],$idList)){
      deleteList($dbh,$idList);
      echo 0;
    }
  else {
    echo -1;
  }
 ?>
