<?php
  include_once('database/connection.php');
  include_once('database/lists.php');

  if(isset($_SESSION['username']) && $_SESSION['username'] != '' && ListBelongsUser($dbh,$_SESSION['username'],$_GET["list"])){
    //Change List Privacy
    if(isset($_GET["privacy"]) && $_GET["privacy"] != '' && isset($_GET["list"]) && $_GET["list"] != ''){
      setPrivacyofList($dbh,$_GET["list"],$_GET["privacy"]);
      updateModified($dbh,$_GET["list"]);
      echo 0;
    }
    //Change List Title
    elseif (isset($_GET["title"]) && $_GET["title"] != '' && isset($_GET["list"]) && $_GET["list"] != '') {
      setTitleofList($dbh,$_GET["list"],$_GET["title"]);
      updateModified($dbh,$_GET["list"]);
      echo 0;
    }
    //Change List Color
    elseif (isset($_GET["color"]) && $_GET["color"] != '' && isset($_GET["list"]) && $_GET["list"] != '') {
      setColorofList($dbh,$_GET["list"],$_GET["color"]);
      updateModified($dbh,$_GET["list"]);
      echo 0;
    }
    //Delete Tag From List
    elseif (isset($_GET["delTag"]) && $_GET["delTag"] != '' && isset($_GET["list"]) && $_GET["list"] != '') {
      deleteTagfromList($dbh,$_GET["list"],$_GET["delTag"]);
      updateModified($dbh,$_GET["list"]);
      echo 0;
    }
    //Insert Tag to List
    elseif (isset($_GET["newTag"]) && $_GET["newTag"] != '' && isset($_GET["list"]) && $_GET["list"] != '') {
      insertTagtoList($dbh,$_GET["list"],$_GET["newTag"]);
      updateModified($dbh,$_GET["list"]);
    }
    //Get Color of List
    elseif (isset($_GET["getColor"]) && $_GET["getColor"] != '' && isset($_GET["list"]) && $_GET["list"] != '') {
      getColorofList($dbh,$_GET["getColor"]);
    }
    //Get Username of List
    elseif (isset($_GET["getUsername"]) && $_GET["getUsername"] != '' && isset($_GET["list"]) && $_GET["list"] != '') {
      echo $_SESSION['username'];
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
