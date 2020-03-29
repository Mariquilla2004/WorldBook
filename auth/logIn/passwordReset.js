function sendPasswordReset(){

  var auth = firebase.auth();
  var emailAddress = document.getElementById('email').value;
  var success = document.getElementById('success');
  var inError = document.getElementById('error');

  success.innerHTML = '';
  error.innerHTML = '';
  auth.sendPasswordResetEmail(emailAddress).then(function() {
    // Email sent.
    success.innerHTML = 'Email sent successfully';
  }).catch(function(error) {
    // An error happened.
    inError.innerHTML = error;
  });
}
