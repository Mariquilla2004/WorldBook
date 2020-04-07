//Database reference.
var db = firebase.firestore();

/* ADD DATA TO FIRESTORE */

//Listen for form submit
document.getElementById("bookForm").addEventListener("submit", addToLibrary);

//Save the Library book data to firebase.
function addToLibrary(){

  //Input values.
  var title = document.getElementById('title').value, author = document.getElementById('author').value,
  isbn = document.getElementById('ISBN').value;

  //Get current user and save data to Firestore.
  var user = firebase.auth().currentUser;
  db.doc('/library/' + title).set({
    title: title,
    author: author,
    isbn: isbn,
    owner: user.uid,

  }).then(function(docRef){

    matchFromLibrary(title);
    //Saved successfuly, so hide the modal.
    $('#addModal').modal('hide')

  }).catch(function(error){
    //An error happened.
    console.log(error);
  });
}

//Save the Wishlist book data to firebase.
function addToWishlist(){

  //Input values.
  var title = document.getElementById('titlew').value, author = document.getElementById('authorw').value;

  //Get current user and save data to Firestore.
  var user = firebase.auth().currentUser;
  db.doc('/wishlist/' + title).set({
    title: title,
    author: author,
    requester: user.uid,

  }).then(function(docRef){

    matchFromWishlist(title);
    //Saved successfuly, so hide the modal.
    $('#addModal').modal('hide')

  }).catch(function(error){
    //An error happened.
    console.log(error);
  });
}


/* READ DATA FROM FIRESTORE*/

firebase.auth().onAuthStateChanged(function(user){
  if (user){
    fetchLibrary();
    fetchWishlist();
  }
});

function fetchLibrary(){

  var libraryCardContainer = document.getElementById('libraryCardContainer');
  var user = firebase.auth().currentUser;
  var collectionRef = db.collection('/library');
  //Fetch user's library from Firestore.
  collectionRef.where('owner', '==', user.uid).onSnapshot(function(querySnapshot){
    libraryCardContainer.innerHTML = '';

    //Display all books added to user's library.
    querySnapshot.forEach((doc) =>{
      libraryCardContainer.innerHTML += `<div class= 'card bookCard'>${doc.id}</div>`
      });
  });
}

function fetchWishlist(){

  var wishlistCardContainer = document.getElementById('wishlistCardContainer');
  var user = firebase.auth().currentUser;
  var collectionRef = db.collection('/wishlist');
  //Fetch user's library from Firestore.
  collectionRef.where('requester', '==', user.uid).onSnapshot(function(querySnapshot){
    wishlistCardContainer.innerHTML = '';

    //Display all books added to user's library.
    querySnapshot.forEach((doc) =>{
      wishlistCardContainer.innerHTML += `<div class= 'card bookCard'>${doc.id}</div>`
      });
  });
}

/* PERFORM DATA QUERIES */

function matchFromLibrary(title){
  db.collection('/wishlist').where("title", '==', title).onSnapshot(function(querySnapshot){
    showNotification('Someone wants to read ' + title);
  });
}

function matchFromWishlist(title){
  db.collection('/library').where('title', '==', title).onSnapshot(function(querySnapshot){
    showNotification('We found someone who has ' + title);
  });
}

function showNotification(message){

  if (Notification.permission === 'granted'){

  var notification = new Notification(message);
  }

  else if (Notification.permission !== "denied") {

    Notification.requestPermission().then(function (permission) {
      // If the user accepts, let's create a notification
      if (permission === "granted") {

        var notification = new Notification(message);
      }
    });
  }
}
