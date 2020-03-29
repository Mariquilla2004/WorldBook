// Database reference.
var db = firebase.firestore();

    var emailInput= document.getElementById('inputEmail');
    var passwordInput= document.getElementById('inputPassword');
    var emError= document.getElementById('emError');
    var passError = document.getElementById('passError');

    emailInput.addEventListener("keydown", function (e) {
    if (e.keyCode === 13) {    //checks whether the pressed key is "Enter"
        signIn();
    }
    });

    passwordInput.addEventListener("keydown", function (e) {
    if (e.keyCode === 13) {    //checks whether the pressed key is "Enter"
        signIn();
    }
    });


    //Sign the user in.
    function signIn(){

      const email = emailInput.value;
      const pass = passwordInput.value;

      firebase.auth().signInWithEmailAndPassword(email, pass).catch(function(error) {
        var errorCode = error.code;
        var errorMessage = error.message;
        switch (errorCode != null) {

          case errorCode == 'auth/invalid-email':
            emError.innerHTML = 'Invalid email';
            break;

          case errorCode == 'auth/user-not-found':
            emError.innerHTML = 'User not found';
            break;

          case errorCode == 'auth/wrong-password':
            passError.innerHTML = 'Wrong password';
            break;

          default: alert(errorMessage);

        }
      });

      firebase.auth().onAuthStateChanged(function(user){
        if(user){

          //Get the user auth provider.
          user.providerData.forEach(function (profile){
            var provider = profile.providerId;

            //User has verified his/her email.
            if (user.emailVerified == 1){
              window.location = '/home';
            }

            //User hasn't verified his/her email or has logged in with Google, Facebook, or Twitter.
            if (user.emailVerified == 0){

              window.location = '../signUp/verifyEmail.html';
            }
          });
        }
      });
    }

    //Google's sign in.
    function googleSignIn(){
      var provider = new firebase.auth.GoogleAuthProvider();
      firebase.auth().useDeviceLanguage();

      firebase.auth().signInWithPopup(provider).then(function(result) {
        // This gives you a Google Access Token. You can use it to access the Google API.
        var token = result.credential.accessToken;
        // The signed-in user info.
        var user = result.user;

      }).catch(function(error) {
        var errorCode = error.code;
        var errorMessage = error.message;
        // The email of the user's account used.
        var email = error.email;
        // The firebase.auth.AuthCredential type that was used.
        var credential = error.credential;
        console.log(errorMessage, email, credential);
      });

          firebase.auth().onAuthStateChanged(function(user){
            if (user){
              //Create the user in the database.
              db.doc("users/" + user.uid).set({
                name: user.displayName,
                em: user.email,
                p: 'g',

              }).then(function(docRef) {
                window.location = '/home';

              })
              .catch(function(error) {
                console.error("Error adding document: ", error);
              });
            }
          });
    }
