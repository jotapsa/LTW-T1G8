<?php
  session_start();

  if(!isset($_GET['user']) && !isset($_GET['tag']))
    die('Search Invalid!');

  if($_GET['user'] == '' && $_GET['tag'] == '')
    die('Search Invalid!');

  include_once('database/connection.php');
  include_once('database/users.php');
  include_once('database/lists.php');

  if($_GET['user'] != ''){
    $username = $_GET['user'];

    if(isset($_SESSION['username']) && $_SESSION['username'] != '' && $username == $_SESSION['username']){
      $lists = userTDLists($dbh,$username);
    }
    else {
      $lists = SearchByUser($dbh,$username);
    }
  }
  //tags
  else{
    $tag = $_GET['tag'];

    if(isset($_SESSION['username']) && $_SESSION['username'] != ''){
      $lists = SearchbyTagSession($dbh,$username,$tag);
    }
    else{
      $lists = SearchByTag($dbh,$tag);
    }
  }

  include('templates/common/header.php');  // prints the initial part of the HTML document
  include('templates/lists/list_to_do_lists.php');
  include('templates/common/footer.php');  // prints the initial part of the HTML document
?>
