<?php
  session_start();
  include_once('database/connection.php');
  include_once('database/lists.php');

  if(isset($_GET["item"]) && $_GET["item"] != ''){
    $item = getItem($dbh,$_GET["item"]);
  }
  else {
    echo -1;
    return;
  }

  if($item['checked'] == 0)
    $checked = 1;
  else {
    $checked = 0;
  }
  
  if(isset($_SESSION['username']) && $_SESSION['username'] != ''){
    if(ListBelongsUser($dbh,$_SESSION['username'],$item['idList'])) {
      updateItem($dbh,$_GET["item"],$checked);
      updateModified($dbh,$item['idList']);
      echo $checked;
    }
  }
  else {
    echo -1;
  }
 ?>
