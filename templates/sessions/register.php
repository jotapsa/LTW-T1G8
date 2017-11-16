<section id="register">
  <h1>Register</h1>
  <form action="action_register.php" method="post" enctype="multipart/form-data">
    <label>
      Username <input type="text" name="username">
    </label>
    <label>
      Password <input type="password" name="password">
    </label>
    <label>
      Nickname <input type="nickname" name="nickname">
    </label>
    <label>
      E-mail <input type="email" name="email">
    </label>
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
      Birthday <input type="date" name="birthday" value="2000-01-01">
    </label>
    <label>
      Picture <input type="file" name="picture" accept="image/*">
    </label>
    <input type="submit" value="Register">
  </form>
</section>
