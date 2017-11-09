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
      Picture <input type="file" name="picture" accept="image/*">
    </label>
    <input type="submit" value="Register">
  </form>
</section>
