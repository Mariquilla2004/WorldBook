var userName = document.getElementById('userName');
var profilePic = document.getElementById('profilePic');

// Get the current user

firebase.auth().onAuthStateChanged(function(user){
  var user = firebase.auth().currentUser;

  if (user){
    userName.innerHTML = user.displayName;
    if (user.photoUrl != null){
      profilePic.src = user.photoURL;
    }
  }

  else{
    window.location = '/auth/logIn';
  }

});

//Logs out the current user.
function logOut(){
  firebase.auth().signOut().then(function() {

    // Sign-out successful.
    window.location = 'logIn/';
    }).catch(function(error) {

    // An error happened.
    console.log(error);
    });
}

