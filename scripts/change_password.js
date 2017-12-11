let oldpassword = document.querySelector('#change_pwd input[name=oldpassword]');
let password = document.querySelector('#change_pwd input[name=newpassword]');
let repeat = document.querySelector('#change_pwd input[name=repeatpassword]');

oldpassword.addEventListener('keyup', validateOldPassword, false);
password.addEventListener('keyup', validatePassword, false);
repeat.addEventListener('keyup', validateRepeat, false);

let change_password = document.querySelector('#change_pwd form');
change_password.addEventListener('submit', validateRegister, false);

function validateOldPassword(event){
  str = this.value;
  if(str.length == 0){
    this.classList.remove('valid');
    this.classList.remove('invalid');
    return;
  }

  listClass = this.classList;

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if(this.responseText > 0){
          listClass.remove('valid');
          listClass.add('invalid');
        }
        else {
          listClass.remove('invalid');
          listClass.add('valid');
        }
      }
  };

  xmlhttp.open("POST", "check_password.php", true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send('password='+str);
}

function validatePassword(event) {
  if (!/^\w{3,}$/.test(this.value)){
    this.classList.remove('valid');
    this.classList.add('invalid');
  }
  else{
    this.classList.remove('invalid');
    this.classList.add('valid');
  }
  validateRepeat();
}

function validateRepeat(event) {
  if (repeat.value !== password.value){
    repeat.classList.remove('valid');
    repeat.classList.add('invalid');
  }
  else{
    repeat.classList.remove('invalid');
    repeat.classList.add('valid');
  }
}

function validateRegister(event) {
  let inputs = this.querySelectorAll('input');
  for (let i = 1; i < inputs.length; i++){
    if (inputs[i].classList.contains('invalid'))
     event.preventDefault();
  }

  window.alert('Your password has been changed successfully!');
}
