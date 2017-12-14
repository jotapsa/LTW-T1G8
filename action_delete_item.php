<?php
  include_once('database/connection.php');
  include_once('database/lists.php');

  if(isset($_GET["item"]) && $_GET["item"] != ''){
    $item = getItem($dbh,$_GET["item"]);
  }
  else {
    echo -1;
    return;
  }

  if(isset($_SESSION['username']) && $_SESSION['username'] != '' && ListBelongsUser($dbh,$_SESSION['username'],$item['idList'])){
      deleteItem($dbh,$_GET["item"],$item['idList']);
      updateModified($dbh,$item['idList']);
  }
  else {
    echo -1;
  }
 ?>
