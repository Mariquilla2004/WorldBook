function wrongPassword(){
  $('#passError').text('Ups, wrong password! Please try again.');
  return;
}

function wrongEmail(){
  $('#emailError').text('Error: Is this your email? Hint: Probably not.');
  return;
}
