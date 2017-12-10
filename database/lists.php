<?php
  function userTDLists($dbh,$username){
    $stmt = $dbh->prepare('SELECT List.* FROM Belongs INNER JOIN User ON (User.username =? and User.idUser = Belongs.idUser) INNER JOIN List ON (Belongs.idList = List.idList) ORDER BY List.editedDate DESC');
    $stmt->execute(array($username));
    return $stmt->fetchAll();
  }

  function ItemsofList($dbh,$listID){
    $stmt = $dbh->prepare('SELECT Item.* from List,Item where List.idList = ? and List.idList = Item.idList');
    $stmt->execute(array($listID));
    return $stmt->fetchAll();
  }

  function TagsofList($dbh,$listID){
    $stmt = $dbh->prepare('SELECT Tag.name FROM List INNER JOIN Category ON ((List.idList = ?) AND (List.idList = Category.idList)) INNER JOIN Tag ON (Tag.idTag = Category.idTag)');
    $stmt->execute(array($listID));
    return $stmt->fetchAll();
  }

  function PublicLists($dbh){
    $stmt = $dbh->prepare('SELECT List.* FROM List WHERE List.privacy = 0');
    $stmt->execute(array());
    return $stmt->fetchAll();
  }

  function PublicTags($dbh){
    $stmt = $dbh->prepare('SELECT DISTINCT Tag.name FROM List INNER JOIN Category ON ((List.privacy = 0) AND (List.idList = Category.idList)) INNER JOIN Tag ON (Tag.idTag = Category.idTag)');
    $stmt->execute(array());
    return $stmt->fetchAll();
  }

  function SearchByTag($dbh,$tag){
    $stmt = $dbh->prepare('SELECT DISTINCT List.* FROM List INNER JOIN Category ON ((List.privacy = 0) AND (List.idList = Category.idList)) INNER JOIN Tag ON ((Tag.idTag = Category.idTag) AND Tag.name = ?)');
    $stmt->execute(array($tag));
    return $stmt->fetchAll();
  }

  function SearchbyTagSession($dbh,$username,$tag){

  }

  function SearchByUser($dbh,$username){
    $stmt = $dbh->prepare('SELECT List.* FROM Belongs INNER JOIN User ON (Belongs.idUser = User.idUser AND User.username = ?) INNER JOIN List ON (Belongs.idList = List.idList AND List.privacy = 0)');
    $stmt->execute(array($username));
    return $stmt->fetchAll();
  }

  function getItem($dbh,$idItem){
    $stmt = $dbh->prepare('SELECT Item.* FROM Item WHERE Item.idItem = ?');
    $stmt->execute(array($idItem));
    return $stmt->fetch();
  }

  function UpdateItem($dbh,$idItem,$checked){
    $stmt = $dbh->prepare('UPDATE Item SET checked = ? WHERE Item.idItem = ?');
    $stmt->execute(array($checked,$idItem));
  }

  function getListbyItem($dbh,$idItem){
    $stmt = $dbh->prepare('SELECT List.* FROM List INNER JOIN Item ON (Item.idList = List.idList and Item.idItem = ?)');
    $stmt->execute(array($idItem));
    return $stmt->fetch();
  }

  function UpdateList($dbh,$idList){

  }

  function ListBelongsUser($dbh,$username,$idList){
    $stmt = $dbh->prepare('SELECT * FROM Belongs INNER JOIN User ON (Belongs.idUser = User.idUser AND User.username = ?) INNER JOIN List ON (Belongs.idList = List.idList AND List.idList = ?)');
    $stmt->execute(array($username,$idList));
    return $stmt->fetch() !== false;
  }
 ?>
