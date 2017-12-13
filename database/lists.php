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

  function TagsofList($dbh,$idList){
    $stmt = $dbh->prepare('SELECT Tag.* FROM List INNER JOIN Category ON ((List.idList = ?) AND (List.idList = Category.idList)) INNER JOIN Tag ON (Tag.idTag = Category.idTag)');
    $stmt->execute(array($idList));
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
              INNER JOIN Belongs
              ON (Belongs.idList = List.idList)
              INNER JOIN User
              ON ((User.username != ?) AND (Belongs.idUser = User.idUser))
              GROUP BY List.idList) notUser,
            (SELECT List.idList as id
              FROM List INNER JOIN Category
              ON (List.idList = Category.idList)
              INNER JOIN Tag
              ON ((Tag.idTag = Category.idTag) AND (Tag.name = ?))
              INNER JOIN Belongs
              ON (Belongs.idList = List.idList)
              INNER JOIN User
              ON ((User.username == ?) AND (Belongs.idUser = User.idUser))
              GROUP BY List.idList) sessionUser
        WHERE (List.idList = sessionUser.id OR List.idList = notUser.id)
        GROUP BY List.idList
        ORDER BY List.idList ASC');
      $stmt->execute(array($tag,$username,$tag,$username));
      return $stmt->fetchAll();
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

  function updateModified($dbh,$idList){
    $stmt = $dbh->prepare('UPDATE List SET editedDate = ? WHERE List.idList = ?');
    $stmt->execute(array(time(),$idList));
  }

  function updateItem($dbh,$idItem,$checked){
    $stmt = $dbh->prepare('UPDATE Item SET checked = ? WHERE Item.idItem = ?');
    $stmt->execute(array($checked,$idItem));
  }

  function addItem($dbh,$idList,$info){
    $stmt = $dbh->prepare('INSERT INTO Item VALUES(NULL,?,0,?)');
    $stmt->execute(array($info,$idList));

    $stmt = $dbh->prepare('SELECT Item.idItem FROM Item ORDER BY Item.idItem DESC LIMIT 1');
    $stmt->execute(array());
    $idItem = $stmt->fetch()['idItem'];

    echo $idItem;
    updateList($dbh,$idList);
  }

  function deleteItem($dbh,$idItem){
    $stmt = $dbh->prepare('DELETE FROM Item WHERE Item.idItem=?');
    $stmt->execute(array($idItem));

    updateList($dbh,$idList);
  }

  function updateList($dbh,$idList){

  }

  function ListBelongsUser($dbh,$username,$idList){
    $stmt = $dbh->prepare('SELECT * FROM Belongs INNER JOIN User ON (Belongs.idUser = User.idUser AND User.username = ?) INNER JOIN List ON (Belongs.idList = List.idList AND List.idList = ?)');
    $stmt->execute(array($username,$idList));
    return $stmt->fetch() !== false;
  }

  function setPrivacyofList($dbh,$idList,$privacy){
    $stmt = $dbh->prepare('UPDATE List SET privacy = ? WHERE List.idList = ?');
    $stmt->execute(array($privacy,$idList));
  }

  function setTitleofList($dbh,$idList,$title){
    $stmt = $dbh->prepare('UPDATE List SET title = ? WHERE List.idList = ?');
    $stmt->execute(array($title,$idList));
  }

  function setColorofList($dbh,$idList,$color){
    $stmt = $dbh->prepare('UPDATE List SET color = ? WHERE List.idList = ?');
    $stmt->execute(array('#'.$color,$idList));
  }

  function addList($dbh,$idUser){
    //List
    $stmt = $dbh->prepare('INSERT INTO List VALUES(?,?,?,?,?,?)');
    $stmt->execute(array(NULL,0,'Title','#0000ff',0,time()));

    //Get List.id of new List
    $stmt = $dbh->prepare('SELECT List.idList FROM List ORDER BY List.idList DESC LIMIT 1');
    $stmt->execute(array());
    $idList = $stmt->fetch()['idList'];

    //Belongs
    $stmt = $dbh->prepare('INSERT INTO Belongs VALUES(?,?)');
    $stmt->execute(array($idList,$idUser));

    echo $idList;
  }

  function deleteList($dbh,$idList){
    //Belongs
    $stmt = $dbh->prepare('DELETE FROM Belongs WHERE Belongs.idList = ?');
    $stmt->execute(array($idList));

    //Items
    $stmt = $dbh->prepare('DELETE FROM Item WHERE Item.idList = ?');
    $stmt->execute(array($idList));

    // //Category
    // $stmt = $dbh->prepare('DELETE FROM Category WHERE Category.idList = ?');
    // $stmt->execute(array($idList));

    //Tags
    $tags = TagsofList($dbh,$idList);
    foreach( $tags as $tag) {
      deleteTagfromList($dbh,$idList,$tag['idTag']);
    }

    //List
    $stmt = $dbh->prepare('DELETE FROM List WHERE List.idList = ?');
    $stmt->execute(array($idList));
  }

  function NumberofLists($dbh){
    $stmt = $dbh->prepare('SELECT Count(List.idList) as num FROM List');
    $stmt->execute(array());
    return $stmt->fetch()['num'];
  }

  function insertTagtoList($dbh,$idList,$tagName){
    //Check if Tag already exists in SQLiteDatabase
    $stmt = $dbh->prepare('SELECT Tag.idTag FROM Tag WHERE Tag.name = ?');
    $stmt->execute(array($tagName));
    $result = $stmt->fetch();
    $exists = $result !== false ? 1 : 0;

    if($exists){
      $idTag = $result['idTag'];
    }
    else {
      //Insert Tag
      $stmt = $dbh->prepare('INSERT INTO Tag VALUES(?,?)');
      $stmt->execute(array(NULL,$tagName));

      //Get idTag of new Tag
      $stmt = $dbh->prepare('SELECT Tag.idTag FROM Tag ORDER BY Tag.idTag DESC LIMIT 1');
      $stmt->execute(array());
      $idTag = $stmt->fetch()['idTag'];
    }

    //Insert Category
    $stmt = $dbh->prepare('INSERT INTO Category VALUES(?,?)');
    $stmt->execute(array($idList,$idTag));

    echo $idTag;
  }

  function deleteTagfromList($dbh,$idList,$idTag){
    //Category
    $stmt = $dbh->prepare('DELETE FROM Category WHERE Category.idList = ? AND Category.idTag = ?');
    $stmt->execute(array($idList,$idTag));

    //If idTag not belongs to any List, delete Tag
    $stmt = $dbh->prepare('SELECT count(List.idList) as num FROM List INNER JOIN Category ON (Category.idList = List.idList) INNER JOIN Tag ON (Category.idTag = Tag.idTag AND Tag.idTag = ?)');
    $stmt->execute(array($idTag));
    $num = $stmt->fetch()['num'];

    //Delete Tag
    if($num == 0){
      $stmt = $dbh->prepare('DELETE FROM Tag WHERE Tag.idTag = ?');
      $stmt->execute(array($idTag));
    }
  }
 ?>
