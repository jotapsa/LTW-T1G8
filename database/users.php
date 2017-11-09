<?php
  function userExists($dbh,$username,$password){
    $stmt = $dbh->prepare('SELECT * FROM User WHERE username = ? AND password = ?');
    $stmt->execute(array($username,sha1($password)));
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

  function RegisterUser($dbh,$username,$password,$birthday,$registerDate,$gender,$nickname,$email,$path){
    $stmt = $dbh->prepare('INSERT INTO User VALUES (?,?,?,?,?,?,?,?,?)');
    $stmt->execute(array(NULL,$username,sha1($password),$birthday,$registerDate,$gender,$nickname,$email,$path));
  }

  function getUserbySession($dbh,$username){
    $stmt = $dbh->prepare('SELECT * FROM User WHERE User.username = ?');
    $stmt->execute(array($username));
    return $stmt->fetch();
  }
 ?>
