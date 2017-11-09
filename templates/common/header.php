<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>WIP</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <!-- <link href="css/layout.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link href="css/comments.css" rel="stylesheet"> -->
    <link href="css/forms.css" rel="stylesheet">
  </head>
  <body>
    <header>
      <h1><a href="index.php">WIP</a></h1>
      <!-- <h2><a href="list_news.php">Where fake news are born!</a></h2> -->
      <div id="signup">
        <?php
          include_once('database/users.php');
          if(isset($_SESSION['username']) && $_SESSION['username'] != ''){
            $name = NameofUser($dbh,$_SESSION['username']); ?>
            <a>Hello <?=$name['name']?>!</a>
            <a href="profile.php">Profile</a>
            <a href="add_news.php">Add To-Do List...</a>
            <a href="action_logout.php">Logout</a>
          <?php
          }
          else{ ?>
            <a href="search.php">Search</a>
            <a href="login.php">Login</a>
            <a href="register.html">Register</a>
      <?php } ?>
      </div>
    </header>
    </aside>
