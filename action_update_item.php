<?php
  session_start();
  include_once('database/connection.php');
  include_once('database/lists.php');

  $item = getItem($dbh,$_GET["item"]);

  if($item['checked'] == 0)
    $checked = 1;
  else {
    $checked = 0;
  }
  if(isset($_SESSION['username']) && $_SESSION['username'] != ''){
    if(ListBelongsUser($dbh,$_SESSION['username'],$item['idList'])) {
      UpdateItem($dbh,$_GET["item"],$checked);
      $idList = getListbyItem($dbh,$_GET["item"]);
      UpdateList($dbh,$idList);
      echo $checked;
    }
  }
  else {
    echo -1;
  }
 ?>
