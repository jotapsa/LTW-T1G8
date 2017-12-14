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
			<h2><?php echo $user['nickname']?></h2>
      <h3>Age: <a><?php
      $years = floor((time() - $user['birthday']) / (365.25*60*60*24));
      echo $years;
      ?> years old</a></h3>
      <h3>e-mail: <a href="mailto:<?php echo $user['email']?>" target="_blank"><?php echo $user['email']?></a></h3>
      <h3>Member Since: <a><?php echo gmdate('d/m/y',$user['registerDate'])?></a></h3>
		</div>

  </div>

  <div id="user_lists">
    <?php
      if($mode == 'index'){?>
        <i class="addList">add</i>
        <? $lists = userTDLists($dbh,$user['username']);
      }
      include('templates/lists/list_to_do_lists.php');
     ?>
  </div>
</section>
