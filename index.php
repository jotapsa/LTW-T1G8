<?php
  include_once('database/connection.php');
  include_once('database/users.php');
  include_once('database/lists.php');

  include('templates/common/header.php');  // prints the initial part of the HTML document
  if(isset($_SESSION['username']) && $_SESSION['username'] != ''){
    //user layout
    $user = getUserbySession($dbh,$_SESSION['username']);
    include('templates/lists/lists_user.php');
  }
  else{
    //guest layout
    include('templates/lists/lists_guest.php');
  }
  //include('templates/news/list_news.php'); // prints the list of news in HTML
  include('templates/common/footer.php');
?>
