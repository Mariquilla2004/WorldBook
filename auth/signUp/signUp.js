/*const firebase = require("firebase");
// Required for side-effects
require("firebase/firestore");*/
var db = firebase.firestore();

    //Get the user's input.
    var userName= document.getElementById('inputUsername');
    var emailInput= document.getElementById('inputEmail');
    var passwordInput= document.getElementById('inputPassword');
    var confirmPassword= document.getElementById('inputConfirmPassword');

    //Error messages.
    var emError= document.getElementById('emError');
    var passError = document.getElementById('passError');
    var confirmPassErr = document.getElementById('confirmPassError');
    var userErr= document.getElementById('usernameError');

    userName.addEventListener("keydown", function (e) {
    if (e.keyCode === 13) {    //checks whether the pressed key is "Enter"
        signUp();
    }
    });

    emailInput.addEventListener("keydown", function (e) {
    if (e.keyCode === 13) {    //checks whether the pressed key is "Enter"
        signUp();
    }
    });

    passwordInput.addEventListener("keydown", function (e) {
    if (e.keyCode === 13) {    //checks whether the pressed key is "Enter"
        signUp();
    }
    });

    confirmPassword.addEventListener("keydown", function (e) {
    if (e.keyCode === 13) {    //checks whether the pressed key is "Enter"
        signUp();
    }
    });

    //Firebase database.
    var firebasedb = firebase.database();
    //Register a new user.
    function signUp(){
      if (passwordInput.value == confirmPassword.value){

        emError.innerHTML = '';
        passError.innerHTML = '';
        confirmPassErr.innerHTML = '';
        userErr.innerHTML = '';
        const email = emailInput.value;
        const pass = passwordInput.value;

        //Create a new user with email and password.
        firebase.auth().createUserWithEmailAndPassword(email, pass).catch(function(error){

            var errorCode = error.code;
              var errorMessage = error.message;

              //Display custom error messages to the user.
              switch (errorCode != null) {

                case errorCode == 'auth/email-already-in-use':
                  emError.innerHTML = 'Email already in use';
                  break;

                case errorCode == 'auth/invalid-email':
                  emError.innerHTML = 'Invalid email';
                  break;

                case errorCode == 'auth/weak-password':
                  passError.innerHTML = 'Password is too weak';
                  break;

                default:  return alert(errorMessage);
              }
        });

        firebase.auth().onAuthStateChanged(function(user){
          user = firebase.auth().currentUser;

          if (user){

            //Update the user's profile adding a username.
            user.updateProfile({
              displayName: userName.value

            }).then(function(){

              //Create the user in the database.
              db.doc("users/" + user.uid).set({
                name: user.displayName,
                em: user.email,
                p: 'email',
                c: new Date().toLocaleDateString(),

              }).then(function() {
                //Redirect to verifyEmail.html
                window.location = 'verifyEmail.html';

                console.log(user);
              })
              .catch(function(error) {
                console.error("Error adding document: ", error);
              });


            }).catch(function(error){
              alert(error);

            });

          }
        });
      }

      else if(passwordInput != confirmPassword){
        confirmPassErr.innerHTML = 'Passwords must match';
      }
    }

    //Google's sign in.
    function googleSignUp(){
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
            c: new Date().toLocaleDateString(),

          }).then(function() {
            window.location = '/home';

          })
          .catch(function(error) {
            console.error("Error adding document: ", error);
          });
        }
      });
    }
