<?php
  session_start();
  include_once('database/connection.php');
  include_once('database/lists.php');

  $item = getItem($dbh,$_GET["item"]);

  if(isset($_SESSION['username']) && $_SESSION['username'] != ''){
    if(ListBelongsUser($dbh,$_SESSION['username'],$item['idList'])) {
      $idList = getListbyItem($dbh,$_GET["item"]);
      DeleteItem($dbh,$_GET["item"]);
      UpdateList($dbh,$idList);
      echo 0;
    }
  }
  else {
    echo -1;
  }
 ?>
