<?php
  session_start();
  include_once('database/connection.php');
  include_once('database/lists.php');

  $item = getItem($dbh,$_GET["item"]);

  if(isset($_SESSION['username']) && $_SESSION['username'] != ''){
    if(ListBelongsUser($dbh,$_SESSION['username'],$item['idList'])) {
      deleteItem($dbh,$_GET["item"]);
      updateModified($dbh,$item['idList']);
      // echo 0;
    }
  }
  else {
    echo -1;
  }
 ?>
