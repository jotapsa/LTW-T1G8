<section id="change_pwd">
  <h1>Register</h1>
  <form action="action_register.php" method="post" enctype="multipart/form-data" id="registerForm">
    <label for="username">
      Username <input id="username" type="text" name="username" required>
    </label>
    <div id="username_error" class="val_error"> errado </div>
    <label>
      Password <input type="password" name="password" required>
    </label>
    <label>
      Nickname <input type="nickname" name="nickname" required>
    </label>
    <label>
      E-mail <input type="email" name="email" required>
    </label>
    <div id="email_error" class="val_error"> errado </div>
    <label>
      Gender
      <label id="gender">
          Male
          <input type="radio" name="gender"
          <?php if (isset($gender) && $gender=="male") echo "checked";?>
          value="male" checked>
          Female
          <input type="radio" name="gender"
          <?php if (isset($gender) && $gender=="female") echo "checked";?>
          value="female">
      </label>
    </label>
    <label>
      Birthday <input type="date" name="birthday" value="2000-01-01" required>
    </label>
    <label>
      Picture <input type="file" name="picture" accept="image/*">
    </label>
    <input type="submit" value="Register" onclick="check()">
  </form>
  <script src="scripts/register.js"></script>
</section>
