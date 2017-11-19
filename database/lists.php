<?php
  function userTDLists($dbh,$username){
    $stmt = $dbh->prepare('SELECT List.* FROM User,List WHERE User.username = ?');
    $stmt->execute(array($username));
    return $stmt->fetchAll();
  }

  function listItems($dbh,$listID){
    $stmt = $dbh->prepare('SELECT Item.* from List,Item where List.idList = ?');
    $stmt->execute(array($listID));
    return $stmt->fetchAll();
  }

  function listTagsofList($dbh,$listID){
    
  }
 ?>
