<section id="main">
  <div id="user">
    <div id="headshot">
      <img src="<?php
      if(isset($user['image']))
        echo $user['image'];
      else
        echo 'images/unknown.jpg';?>"/>
    </div>

    <div id="name_user">
			<h2><?php echo $user['username']?></h2>
		</div>

  </div>

  <div id="user_lists">
    <?php
      $lists = userTDLists($dbh,$user['username']);
      include('templates/lists/list_to_do_lists.php');
     ?>
  </div>
</section>
