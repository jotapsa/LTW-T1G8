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
      $title = 'FeupTasks';
    else if(strpos($a, 'login') !== false)
      $title = 'FeupTasks - Login';
    else if(strpos($a, 'register') !== false)
      $title = 'FeupTasks - Register';
    else if(strpos($a, 'profile') !== false)
      $title = 'FeupTasks - Profile';
    else {
      $title = 'FeupTasks';
    }
     ?>
    <title><?php echo $title?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/index_session.css" rel="stylesheet">
    <link href="css/forms.css" rel="stylesheet">
    <link href="css/profile.css" rel="stylesheet">
    <script src="scripts/search.js" defer></script>
    <script src="scripts/item.js" defer></script>
  </head>
  <body>
    <header>
      <img src="images/logo_feup.png">
      <h1><a href="index.php">FeupTasks</a></h1>
      <h3><a href="index.php">"The only thing more important than your to-do list is your to-be list. The only thing more important than your to-be list is to be."</a></h3>
      <div id="signup">
        <select id="searchType" onchange="changeType(this.value)">
          <option value="user">User</option>
          <option value="tag">Tag</option>
        </select>
        <input type="text" id="search" list="datalist" placeholder="search for user...">
        <datalist id="datalist"></datalist>
        <?php
          include_once('database/users.php');
          if(isset($_SESSION['username']) && $_SESSION['username'] != ''){
            $name = NameofUser($dbh,$_SESSION['username']); ?>
            <a href="profile.php" ><?=$name['name']?></a>
            <div class="dropdown">
              <a class="dropbtn">My Profile</a>
              <div class="dropdown-content">
                <a href="edit_profile.php">Edit Profile</a>
                <a href="change_password.php">Change Password</a>
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
