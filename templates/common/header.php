<?php
if(isset($_SESSION['username']) && $_SESSION['username'] != ''){
  if(!usernameExists($dbh,$_SESSION['username'])){
    header('Location: action_logout.php');
    exit();
  }
}
?>
<!DOCTYPE html>
<html lang="en-US">
  <head>
    <?php
    $a = $_SERVER['PHP_SELF'];
    if(strpos($a, 'index') !== false)
      $title = 'WIP';
    else if(strpos($a, 'login') !== false)
      $title = 'WIP - Login';
    else if(strpos($a, 'register') !== false)
      $title = 'WIP - Register';
    else if(strpos($a, 'profile') !== false)
      $title = 'WIP - Profile';
    else {
      $title = 'WIP';
    }
     ?>
    <title><?php echo $title?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/index_session.css" rel="stylesheet">
    <!-- <link href="css/layout.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link href="css/comments.css" rel="stylesheet"> -->
    <link href="css/forms.css" rel="stylesheet">
    <link href="css/profile.css" rel="stylesheet">
  </head>
  <body>
    <header>
      <h1><a href="index.php">WIP</a></h1>
      <div id="signup">
        <select id="searchType" onchange="changeType(this.value)">
          <option value="user">User</option>
          <option value="tag">Tag</option>
        </select>
        <input type="text" id="search" list="datalist" placeholder="search for user..." onkeypress="Search(event)" onkeyup="showHints(this.value)">
        <datalist id="datalist"></datalist>
        <?php
          include_once('database/users.php');
          if(isset($_SESSION['username']) && $_SESSION['username'] != ''){
            $name = NameofUser($dbh,$_SESSION['username']); ?>
            <a href="profile.php" ><?=$name['name']?></a>
            <div class="dropdown">
              <a class="dropbtn">My Profile</a>
              <div class="dropdown-content">
                <a href="#">Edit Profile</a>
                <a href="#">Change Password</a>
              </div>
            </div>
            <a href="action_logout.php">Logout</a>
          <?php
          }
          else{ ?>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
      <?php } ?>
      </div>
    </header>
    </aside>
