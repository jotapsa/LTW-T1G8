<div id="cv" class="instaFade">
	<div class="mainDetails">
		<div id="headshot">
			<img src="<?php
			if(isset($user['image']))
				echo $user['image'];
			else
				echo 'images/unknown.jpg';?>" alt = "">
		</div>

		<div id="name">
			<h1><?=$user['nickname']?></h1>
			<h2><?=$user['username']?></h2>
		</div>

		<div id="contactDetails">
			<ul>
				<li>e-mail: <a href="mailto:<?=$user['email']?>" target="_blank"><?=$user['email']?></a></li>
				<li>Member Since: <a><?php echo gmdate('d/m/Y',$user['registerDate'])?></a></li>
			</ul>
		</div>
    <div class="clear"></div>
	</div>

	<div id="toplists">
    <div class="clear"></div>
	</div>
</div>
