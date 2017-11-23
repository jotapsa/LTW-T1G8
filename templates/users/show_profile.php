<div id="cv" class="instaFade">
	<div class="mainDetails">
		<div id="headshot">
			<img src="<?php
			if(isset($user['image']))
				echo $user['image'];
			else
				echo 'images/unknown.jpg';?>"/>
		</div>

		<div id="name">
			<h1><?php echo $user['nickname']?></h1>
			<h2><?php echo $user['username']?></h2>
		</div>

		<div id="contactDetails">
			<ul>
				<li>e-mail: <a href="mailto:<?php echo $user['email']?>" target="_blank"><?php echo $user['email']?></a></li>
				<li>Member Since: <a><?php echo gmdate('d/m/y',$user['registerDate'])?></a></li>
			</ul>
		</div>
    <div class="clear"></div>
	</div>

	<div id="toplists">
    <div class="clear"></div>
	</div>
</div>
