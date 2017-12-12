<?php
  session_start();
  include_once('database/connection.php');
  include_once('database/lists.php');

  if(isset($_SESSION['username']) && $_SESSION['username'] != '' && ListBelongsUser($dbh,$_SESSION['username'],$_GET["list"])){
    if(isset($_GET["privacy"]) && $_GET["privacy"] != '' && isset($_GET["list"]) && $_GET["list"] != ''){
      setPrivacyofList($dbh,$_GET["list"],$_GET["privacy"]);
      updateModified($dbh,$_GET["list"]);
      echo 0;
    }
    elseif (isset($_GET["title"]) && $_GET["title"] != '' && isset($_GET["list"]) && $_GET["list"] != '') {
      setTitleofList($dbh,$_GET["list"],$_GET["title"]);
      updateModified($dbh,$_GET["list"]);
      echo 0;
    }
    elseif (isset($_GET["color"]) && $_GET["color"] != '' && isset($_GET["list"]) && $_GET["list"] != '') {
      setColorofList($dbh,$_GET["list"],$_GET["color"]);
      updateModified($dbh,$_GET["list"]);
      echo 0;
    }
    else {
      echo -1;
      return;
    }
  }
  else {
    echo -1;
    return;
  }
 ?>
