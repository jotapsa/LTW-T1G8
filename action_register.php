<?php
  include_once('database/connection.php'); // connects to the database
  include_once('database/users.php');      // loads the functions responsible for the users table

  if(!isset($_POST['username']) || !isset($_POST['password']) || !isset($_POST['nickname']) || !isset($_POST['email'])){
    header('Location: register.php');
    exit();
  }

  if (usernameExists($dbh,$_POST['username'])){
    header('Location: register.php');
    exit();
  }
  else{
    //$message = "Registration Sucessful!";
    if(isset($_FILES['picture']) && $_FILES['picture']['size'] > 0){
      $image = $_FILES['picture']['name'];
      $ext = pathinfo($image, PATHINFO_EXTENSION);
      $path = 'images/'.$_POST['username'].'.'.$ext;
      move_uploaded_file($_FILES["picture"]['tmp_name'],$path);
    }
    else{
      $path = NULL;
    }

    if($_POST['gender'] == 'male')
      $gender = 0;
    else {
      $gender = 1;
    }

    $registerDate = time();
    $birthday = strtotime($_POST['birthday']);

    RegisterUser($dbh, $_POST['username'], $_POST['password'],$birthday,$registerDate,$gender,$_POST['nickname'], $_POST['email'],$path);
    header('Location: login.php');
    exit();
  }
?>
