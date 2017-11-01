<?php
  session_start(); 
  include_once('database/connection.php');
  include_once('database/news.php');
  $articles = getAllNews($dbh);

  include('templates/common/header.php');  // prints the initial part of the HTML document
  include('templates/news/list_news.php'); // prints the list of news in HTML
  include('templates/common/footer.php');  // prints the initial part of the HTML document
?>
