<?php
  include_once('database/connection.php');
  include_once('database/lists.php');

  if(isset($_GET["tag"]) && $_GET["tag"] != ''){
    $tag = $_GET["tag"];
  }
  else {
    echo -1;
    return;
  }

  if(tagExists($dbh,$tag)){
    echo 1;
  }
  else {
    echo 0;
  }
  ?>
