//Database reference.
var db = firebase.firestore();

/* ADD DATA TO FIRESTORE */

//Listen for form submit
document.getElementById("bookForm").addEventListener("submit", addToLibrary);
document.getElementById("wishlistModal").addEventListener("submit", addToWishlist);

//Save the Library book data to firebase.
function addToLibrary(){

  //Input values.
  var titleL = document.getElementById('title').value, author = document.getElementById('author').value,
  isbn = document.getElementById('ISBN').value;

  //Get current user and save data to Firestore.
  var user = firebase.auth().currentUser;
  db.doc('/library/' + titleL).set({
    title: titleL,
    author: author,
    isbn: isbn,
    owner: user.uid,

  }).then(function(docRef){

    matchFromLibrary(titleL);
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
  var titlew = document.getElementById('titlew').value, author = document.getElementById('authorw').value;

  //Get current user and save data to Firestore.
  var user = firebase.auth().currentUser;
  db.doc('/wishlist/' + titlew).set({
    title: titlew,
    author: author,
    requester: user.uid,

  }).then(function(docRef){

    matchFromWishlist(titlew);
    //Saved successfuly, so hide the modal.
    $('#addModal').modal('hide')

  }).catch(function(error){
    //An error happened.
    console.log(error);
  });
}


/* READ DATA FROM FIRESTORE*/

//Fetch books the user has added to his wishlist/library
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

//Look if the recently added library book matches something in the wishlist collection
function matchFromLibrary(titleL){
  db.collection('/wishlist').where('title', '==', titleL)
  .get()
  .then(function(querySnapshot){
    querySnapshot.forEach(function(doc){
      showNotification('And.. match! Some user wants to read ' + titleL);
      alert('We found a match but you don\'t let us display notifications ' + titleL)
    })
  });
}

//Look if the recently added wishlist book matches something in the library collection
function matchFromWishlist(titlew){
  db.collection('/library').where('title', '==', titlew)
  .get()
  .then(function(querySnapshot){
    querySnapshot.forEach(function(doc){
      showNotification('New match! Some user has ' + titlew);
      alert('We found a match but you don\'t let us display notifications ' + titlew)
    })
  });
}


//Ask to show push notifications to the user
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
