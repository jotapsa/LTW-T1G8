<section id="change_pwd">
  <h1>Change Password</h1>
  <form action="action_change_password.php" method="post" id="changePWDForm">
    <label>Old Password<input type="password" name="oldpassword" required>
    </label>
    <label>New Password<input type="password" name="newpassword" required>
      <span class="hint"></span>
    </label>
    <label>Repeat Password<input type="password" name="repeatpassword" required>
    </label>
    <input type="submit" value="Submit" class="submit">
  <script src="scripts/change_password.js"></script>
</section>
