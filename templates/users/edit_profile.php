<section id="editProfile">
  <h1>Edit Profile</h1>
  <form action="action_edit_profile.php" method="post" enctype="multipart/form-data" id="editForm">
    <label for="username">Username<input id="username" type="text" name="username" value="<?=$user['username']?>" required>
      <span class="hint"></span>
    </label>
    <label>Nickname<input type="nickname" name="nickname" value="<?=$user['nickname']?>" required>
    </label>
    <label>E-mail<input type="email" name="email" value="<?=$user['email']?>" required>
      <span class="hint"></span>
    </label>
    <?php
    $gender = $user['gender'] == 0 ? 0:1;?>
    <label>Gender<label id="gender">
          Male
          <input type="radio" name="gender" value="male" <? if($gender == 0) echo 'checked';?>>
          Female
          <input type="radio" name="gender" value="female" <? if($gender == 1) echo 'checked';?>>
      </label>
    </label>
    <label>Birthday<input type="date" name="birthday" value="<? echo gmdate('Y-m-d',$user['birthday'])?>" required>
    </label>
    <label>Picture<input type="file" name="picture" accept="image/*">
    </label>
    <input type="submit" value="Save Changes" id="editProfile<?=$user['idUser']?>">
  </form>
  <script src="scripts/edit.js" defer></script>
</section>
