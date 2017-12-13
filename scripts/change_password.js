let oldpassword = document.querySelector('#change_pwd input[name=oldpassword]');
let password = document.querySelector('#change_pwd input[name=newpassword]');
let repeat = document.querySelector('#change_pwd input[name=repeatpassword]');

password.addEventListener('keyup', validatePassword, false);
repeat.addEventListener('keyup', validateRepeat, false);

let change_password = document.querySelector('#change_pwd form');
change_password.addEventListener('submit', validateChanges, false);

function validatePassword(event) {
  hint = document.getElementsByClassName("hint");

  if (!/^\w{3,}$/.test(this.value)){
    this.classList.remove('valid');
    this.classList.add('invalid');
    hint[0].innerHTML = "Password must have at least 3 characters!";
  }
  else{
    this.classList.remove('invalid');
    this.classList.add('valid');
  }
  validateRepeat();
}

function validateRepeat(event) {
  if(password.value.length == 0 || repeat.value.length == 0){
    repeat.classList.remove('valid');
    repeat.classList.remove('invalid');
    return;
  }

  if (repeat.value !== password.value){
    repeat.classList.remove('valid');
    repeat.classList.add('invalid');
  }
  else{
    repeat.classList.remove('invalid');
    repeat.classList.add('valid');
  }
}

function validateChanges(event) {
  let inputs = this.querySelectorAll('input');
  for (let i = 0; i < inputs.length; i++){
    if (inputs[i].classList.contains('invalid')){
      event.preventDefault();
      window.alert('Arguments Invalid!');
      oldpassword.value = '';
      password.value = '';
      password.classList.remove('valid');
      password.classList.remove('invalid');
      repeat.value = '';
      repeat.classList.remove('valid');
      repeat.classList.remove('invalid');
      oldpassword.focus();
    }
  }
}
