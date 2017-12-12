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
      <h3>e-mail: <a href="mailto:<?php echo $user['email']?>" target="_blank"><?php echo $user['email']?></a></h3>
      <h3>Member Since: <a><?php echo gmdate('d/m/y',$user['registerDate'])?></a></h3>
		</div>

  </div>

  <div id="user_lists">
    <i class="addList">add</i>
    <?php
      $lists = userTDLists($dbh,$user['username']);
      include('templates/lists/list_to_do_lists.php');
     ?>
  </div>

  <div id="nav">

  </div>

</section>
