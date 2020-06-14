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
    owner: user.displayName,

  }).then(function(docRef){

    //Saved successfuly, so hide the modal.
    $('#addModal').modal('hide')

    //Read the wishlist collection and find common books.
    var addedBook = [titleL, ''];
    let wishbooks = [];
    db.collection('/wishlist/').get().then(function(querySnapshot){
      querySnapshot.forEach(function(doc){
        wishbooks.push(doc.data().title);

        findCommonBook(addedBook, wishbooks, '/wishlist/');
      });
    }).catch(function(error){console.log(error);});


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
    requester: user.displayName,

  }).then(function(docRef){

    //Saved successfuly, so hide the modal.
    $('#wishlistModal').modal('hide')

        //Read the wishlist collection and find common books.
    var addedBook = [titlew, ''];
    let libbooks = [];
    db.collection('/library/').get().then(function(querySnapshot){
      querySnapshot.forEach(function(doc){
        libbooks.push(doc.data().title);

        findCommonBook(addedBook, libbooks, '/library/');
      });
    }).catch(function(error){console.log(error);});

  }).catch(function(error){
    //An error happened.
    console.log(error);
  });
}


/* READ DATA FROM FIRESTORE*/
firebase.auth().onAuthStateChanged(function(user) {
  if (user){

    //Fetch books the user has added to his wishlist/library.
      fetchLibrary();
      fetchWishlist();

  } else { window.location = '/auth/logIn/';}
});

function fetchLibrary(){

  var libraryCardContainer = document.getElementById('libraryCardContainer');
  var user = firebase.auth().currentUser;
  var collectionRef = db.collection('/library');
  //Fetch user's library from Firestore.
  collectionRef.where('owner', '==', user.displayName).onSnapshot(function(querySnapshot){
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
  collectionRef.where('requester', '==', user.displayName).onSnapshot(function(querySnapshot){
    wishlistCardContainer.innerHTML = '';

    //Display all books added to user's library.
    querySnapshot.forEach((doc) =>{
      wishlistCardContainer.innerHTML += `<div class= 'card bookCard'>${doc.id}</div>`
      });
  });
}

/* PERFORM DATA QUERIES */


//Look if the recently added library book matches something in the wishlist collection
    db.collection('/wishlist').onSnapshot(function(snapshot){
      var wishBooksL= [];
      //Get each book in the wishlist collection and push them to an array.
      snapshot.docChanges().forEach(function(change){
        if (change.type === 'added' || change.type === 'modified'){
          wishBooksL.push(change.doc.data().title);
        }
      });
      console.log(wishBooksL);
      //Get books in user's library.
      var lNodeList = document.getElementById("libraryCardContainer").querySelectorAll(".bookCard");
      libBooksL = Array.prototype.slice.call(lNodeList).map(function(e) {
      return e.textContent;});

      findCommonBook(libBooksL, wishBooksL, '/wishlist/');
    });


//Look if the recently added wishlist book matches something in the library collection
  db.collection('/library').onSnapshot(function(snapshot){
    var libBooksW = [];
    //Get each book in the library collection and push them to an array.
    snapshot.docChanges().forEach(function(change){
      if (change.type === 'added' || change.type === 'modified'){
        libBooksW.push(change.doc.data().title);
      }
    });
    console.log(libBooksW);
    //Get books in user's wishlist.
    var wNodeList = document.getElementById("wishlistCardContainer").querySelectorAll(".bookCard");
    var wishBooksW = Array.prototype.slice.call(wNodeList).map(function(e) {
    return e.textContent;});

    findCommonBook(wishBooksW, libBooksW, '/library/');
  });


//Ask to show push notifications to the user
function showNotification(message){

  Notification.requestPermission(function() {
    var notification = new Notification('WorldBook', { body : message });
  });

}

function findCommonBook(array1, array2, path) {
  //Loop through the two arrays.
  for(let i = 0; i < array1.length; i++) {
    for(let j = 0; j < array2.length; j++) {
      if(array1[i] === array2[j]) {
          // Return if common element found
          db.doc(path + array2[j]).get().then(function(doc){

            if (doc.exists && path === '/wishlist/'){
              showNotification('Hey! ' + doc.data().requester + ' wants to read ' + array1[i] + '!');

            } else if (doc.exists && path === '/library/'){
              showNotification('Lucky! ' + doc.data().owner + '\'s got ' + array1[i] + '!');
            }

          });
        }
      }
  }
  // Return if no common element exist
  return false;
}
