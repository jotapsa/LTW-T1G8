<?php
  function userExists($dbh,$username,$password){
    $stmt = $dbh->prepare('SELECT COUNT(User.username) as valid FROM User WHERE User.username = ? and User.password = ?');
    $stmt->execute(array($username,hash('sha1', $password)));
    return $stmt->fetch() !== false;
  }

  function NameofUser($dbh,$username){
    $stmt = $dbh->prepare('SELECT User.name as name FROM User WHERE User.username = ?');
    $stmt->execute(array($username));
    return $stmt->fetch();
  }
 ?>
