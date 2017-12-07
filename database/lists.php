<?php
  function userTDLists($dbh,$username){
    $stmt = $dbh->prepare('SELECT List.* FROM User,List WHERE User.username = ? and User.idUser = List.idUser ORDER BY List.editedDate DESC');
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
    $stmt = $dbh->prepare('SELECT List.* FROM List,
      (SELECT List.idList as id
            FROM List INNER JOIN Category
            ON ((List.privacy = 0) AND (List.idList = Category.idList))
            INNER JOIN Tag
            ON ((Tag.idTag = Category.idTag) AND Tag.name = ?)
            INNER JOIN User
            ON ((User.username != ?) AND (User.idUser = List.idUser))
            GROUP BY List.idList) notUser,
          (SELECT List.idList as id
            FROM List INNER JOIN Category
            ON (List.idList = Category.idList)
            INNER JOIN Tag
            ON ((Tag.idTag = Category.idTag) AND (Tag.name = ?))
            INNER JOIN User
            ON ((User.username = ?) AND (User.idUser = List.idUser))
            GROUP BY List.idList) sessionUser
      WHERE (List.idList = sessionUser.id OR List.idList = notUser.id)
      GROUP BY List.idList
      ORDER BY List.idList ASC;
');
    $stmt->execute(array($tag,$username,$tag,$username));
    print_r($stmt->fetchAll());
    die();
  }

  function SearchByUser($dbh,$username){
    $stmt = $dbh->prepare('SELECT List.* FROM List INNER JOIN User ON ((List.idUser = User.idUser) AND (User.username = ?) AND (List.privacy = 0))');
    $stmt->execute(array($username));
    return $stmt->fetchAll();
  }
 ?>
