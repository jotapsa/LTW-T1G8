<?php
  include_once('database/connection.php');
  include_once('database/users.php');
  include_once('database/lists.php');

  if(!isset($_GET['user']) && !isset($_GET['tag']))
    die('Search Invalid!');

  include('templates/common/header.php');  // prints the initial part of the HTML document

  //user
  if(isset($_GET['user']) && $_GET['user'] != '' && usernameExists($dbh,$_GET['user'])){
    $username = $_GET['user'];

    if(isset($_SESSION['username']) && $_SESSION['username'] != '' && $username == $_SESSION['username']){
      $lists = userTDLists($dbh,$username);
    }
    else {
      $lists = SearchByUser($dbh,$username);
    }

    $user = getUserbySession($dbh,$username);
    include('templates/lists/lists_user.php');
  }
  //tags
  else if(isset($_GET['tag']) && $_GET['tag'] != '' && tagExists($dbh,$_GET['tag'])){
    $tag = $_GET['tag'];

    if(isset($_SESSION['username']) && $_SESSION['username'] != ''){
      $lists = SearchbyTagSession($dbh,$_SESSION['username'],$tag);
    }
    else{
      $lists = SearchByTag($dbh,$tag);
    }
    include('templates/lists/list_to_do_lists.php');
  }

  include('templates/common/footer.php');  // prints the initial part of the HTML document
?>
