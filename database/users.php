<?php
  function userExists($dbh,$username,$password){
    $stmt = $dbh->prepare('SELECT * FROM User WHERE username = ? AND password = ?');
    $stmt->execute(array($username,hash('sha256',$password)));
    return $stmt->fetch() !== false;
  }

  function usernameExists($dbh,$username){
    $stmt = $dbh->prepare('SELECT * FROM User WHERE username = ?');
    $stmt->execute(array($username));
    return $stmt->fetch() !== false;
  }

  function NameofUser($dbh,$username){
    $stmt = $dbh->prepare('SELECT User.nickname as name FROM User WHERE User.username = ?');
    $stmt->execute(array($username));
    return $stmt->fetch();
  }

  function getUserID($dbh,$username){
    $stmt = $dbh->prepare('SELECT User.idUser as id FROM User WHERE User.username = ?');
    $stmt->execute(array($username));
    return $stmt->fetch()['id'];
  }

  function RegisterUser($dbh,$username,$password,$birthday,$registerDate,$gender,$nickname,$email,$path){
    $stmt = $dbh->prepare('INSERT INTO User VALUES (?,?,?,?,?,?,?,?,?)');
    $stmt->execute(array(NULL,$username,hash('sha256',$password),$birthday,$registerDate,$gender,$nickname,$email,$path));
  }

  function getUserbySession($dbh,$username){
    $stmt = $dbh->prepare('SELECT * FROM User WHERE User.username = ?');
    $stmt->execute(array($username));
    return $stmt->fetch();
  }

  function Users($dbh){
    $stmt = $dbh->prepare('SELECT User.username FROM User');
    $stmt->execute(array());
    return $stmt->fetchAll();
  }

  function CheckUserPassword($dbh,$username,$password){
    $stmt = $dbh->prepare('SELECT * FROM User WHERE User.username = ? AND User.password = ?');
    $stmt->execute(array($username,$password));
    return $stmt->fetch() !== false;
  }

  function UpdatePassword($dbh,$username,$password){
    $stmt = $dbh->prepare('UPDATE User SET password = ? WHERE User.username = ?');
    $stmt->execute(array(hash('sha256',$password),$username));
  }

  function emailExists($dbh,$email){
    $stmt = $dbh->prepare('SELECT * FROM User WHERE User.email = ?');
    $stmt->execute(array($email));
    return $stmt->fetch() !== false;
  }

  function updateUser($dbh,$idUser,$username,$birthday,$gender,$nickname,$email,$path){
    $stmt = $dbh->prepare('UPDATE User set username=?,birthday=?,gender=?,nickname=?,email=?,image=? where User.idUser=?');
    $stmt->execute(array($username,$birthday,$gender,$nickname,$email,$path,$idUser));
  }

  function getUserofList($dbh,$idList){
    $stmt = $dbh->prepare('SELECT User.* FROM User INNER JOIN Belongs ON (User.idUser = Belongs.idUser) INNER JOIN List ON (Belongs.idList = List.idList AND List.idList=?)');
    $stmt->execute(array($idList));
    return $stmt->fetch();
  }
 ?>
