<?php
  include_once('database/connection.php');
  include_once('database/lists.php');
  include_once('database/users.php');

  if(isset($_SESSION['username']) && $_SESSION['username'] != ''){
    $idUser = getUserID($dbh,$_SESSION['username']);
    addList($dbh,$idUser);
  }
  else {
    echo -1;
    return;
  }
 ?>
