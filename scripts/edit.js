let username = document.querySelector('#editProfile input[name=username]');
username.addEventListener('keyup', validateUsername, false);

let email = document.querySelector('#editProfile input[name=email]');
email.addEventListener('keyup', validateEmail, false);

let edit = document.querySelector('#editProfile form');
edit.addEventListener('submit', validateChanges, false);

var usernameUser = username.value;
var emailUser = email.value;

function validateUsername() {
  str = this.value;
  hint = document.getElementsByClassName("hint");

  if(str.length == 0 || str === usernameUser){
    this.classList.remove('valid');
    this.classList.remove('invalid');
    return;
  }

  if (!/^\w{3,}$/.test(this.value)){
    hint[0].innerHTML = "Username must have at least 3 characters!"
    this.classList.remove('valid');
    this.classList.add('invalid');
    return;
  }

  listClass = this.classList;

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if(this.responseText != 0){
          hint[0].innerHTML = "Username already exists!"
          listClass.remove('valid');
          listClass.add('invalid');
        }
        else {
          listClass.remove('invalid');
          listClass.add('valid');
        }
      }
  };

  xmlhttp.open("GET", "check_username.php?username=" + str, true);
  xmlhttp.send();
}

function validateEmail() {
  str = this.value;
  hint = document.getElementsByClassName("hint");
  if(str.length == 0 || str === emailUser){
    this.classList.remove('valid');
    this.classList.remove('invalid');
    return;
  }

  listClass = this.classList;

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if(this.responseText != 0){
          hint[1].innerHTML = "Email already exists!"
          listClass.remove('valid');
          listClass.add('invalid');
        }
        else {
          listClass.remove('invalid');
          listClass.add('valid');
        }
      }
  };

  xmlhttp.open("GET", "check_email.php?email=" + str, true);
  xmlhttp.send();
}

function validateChanges(event) {
  let inputs = this.querySelectorAll('input');
  for (let i = 0; i < inputs.length; i++){
    if (inputs[i].classList.contains('invalid')){
      event.preventDefault();
      window.alert('Arguments Invalid!');
      username.value = usernameUser;
      username.classList.remove('valid');
      username.classList.remove('invalid');
      email.value = emailUser;
      email.classList.remove('valid');
      email.classList.remove('invalid');
      username.focus();
      return;
    }
  }
  window.alert('Profile was successfully saved!');
}
