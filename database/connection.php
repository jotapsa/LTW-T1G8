<?php
session_start();
// session_set_cookie_params(0, '/', 'www.fe.up.pt', true, true);
   try {
      $dbh = new PDO('sqlite:database/list.db');
      $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   } catch (PDOException $e) {
      die($e->getMessage());
   }
 ?>
