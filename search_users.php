<?php
  include_once('database/connection.php');
  include_once('database/users.php');
  $users = Users($dbh);

  $dataList = array();
  $i = 0;

  if(isset($_GET["user"]) && $_GET["user"] != ''){
    $user = $_GET["user"];
  }
  else {
    echo -1;
    return;
  }

  // lookup all hints from array if $q is different from ""
  if ($user !== "") {
      $user = strtolower($user);
      $len=strlen($user);
      foreach($users as $name) {
          if (stristr($user, substr($name['username'], 0, $len))) {
            $dataList[$i] = $name['username'];
            $i = $i + 1;
          }
      }
  }

  echo json_encode($dataList);
 ?>
