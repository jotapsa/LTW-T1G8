<?php
  session_start(); 
  include_once('database/connection.php');
  include_once('database/users.php');

  // $article = getNewsbyID($dbh, $_GET['id']);
  // $paragraphs = explode("\n", $article['fulltext']);
  // $comments = getCommentsbyNewsID($dbh, $_GET['id']);
  // $Ncomments = getNumberCommentsbyNewsID($dbh, $_GET['id']);

  include('templates/common/header.php');
  include('templates/sessions/login.php');
  include('templates/common/footer.php');
?>
