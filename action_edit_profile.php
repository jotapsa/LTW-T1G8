<?php
  session_start();                         // starts the session
  include_once('database/connection.php'); // connects to the database
  include_once('database/users.php');      // loads the functions responsible for the users table

  if(!isset($_SESSION['username']) && $_SESSION['username'] == ''){
    header('Location: index.php');
    exit();
  }

  if(!isset($_POST['username']) || !isset($_POST['nickname']) || !isset($_POST['email'])){
    header('Location: edit_profile.php');
    exit();
  }

  $user = getUserbySession($dbh,$_SESSION['username']);

  if(isset($_FILES['picture']) && $_FILES['picture']['size'] > 0){
    if(isset($user['image'])){
      unlink($user['image']);
    }
    $image = $_FILES['picture']['name'];
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    $path = 'images/'.$_POST['username'].'.'.$ext;
    move_uploaded_file($_FILES["picture"]['tmp_name'],$path);
  }
  else if(isset($user['image'])){
    $ext = array_pop(explode('.', $user['image']));
    $path = 'images/'.$_POST['username'].'.'.$ext;
    rename($user['image'],$path);
  }
  else {
    $path = NULL;
  }

  if($_POST['gender'] == 'male')
    $gender = 0;
  else {
    $gender = 1;
  }

  $birthday = strtotime($_POST['birthday']);

  updateUser($dbh,$user['idUser'],$_POST['username'],$birthday,$gender,$_POST['nickname'],$_POST['email'],$path);
  $_SESSION['username'] = $_POST['username'];
  header('Location: index.php');
  exit();
?>
