//Get the current user
firebase.auth().onAuthStateChanged(function(user){

  var user = firebase.auth().currentUser;
  if (user){
    user.providerData.forEach(function(profile){

        //If the user has his email verified, redirect to home.
        var provider = profile.providerId;
        if (user.emailVerified == 1 || provider == 'facebook.com' || provider == 'twitter.com'){
                window.location = '../welcome.html';
        }

        else {
          user.sendEmailVerification().then(function() {

            // Email sent.
          }).catch(function(error) {

            // An error happened.
            alert(error);
          });
        }
    });
  }

  else {
    window.location = '../logIn/'
  }
});



function resendVerificationEmail(){

            if (user.emailVerified == 0){
              user.sendEmailVerification().then(function() {
                // Email sent.
                var demo= document.getElementById('demo');
                demo.innerHTML = ('Email sent');

              }).catch(function(error) {
                // An error happened.
                console.log(error);
              });

            }
            else if(user == null) {
              alert('You are not logged in, please log in and try again');
            }
}
