<?php
  include_once('database/connection.php');
  include_once('database/lists.php');
  $tags = PublicTags($dbh);

  $dataList = array();
  $i = 0;

  $tag = $_GET["tag"];

  // lookup all hints from array if $q is different from ""
  if ($tag !== "") {
      $tag = strtolower($tag);
      $len=strlen($tag);
      foreach($tags as $name) {
          if (stristr($tag, substr($name['name'], 0, $len))) {
            $dataList[$i] = $name['name'];
            $i = $i + 1;
          }
      }
  }

  echo json_encode($dataList);
 ?>
