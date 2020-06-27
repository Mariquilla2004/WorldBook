
var signUpForm = document.getElementById('signUpForm');
var password = document.getElementById('inputPassword');
var confirmPassword= document.getElementById('inputConfirmPassword');
var confirmPassErr = document.getElementById('confirmPassError');

//Check whether password field and confirm password field match.
signUpForm.addEventListener('submit', function(e){

  e.preventDefault();
  var match= password.value == confirmPassword.value;

  if (match){ this.submit(); } //If they match, submit the form.

  else {
    confirmPassErr.innerHTML = 'Passwords must match';
  }

});
