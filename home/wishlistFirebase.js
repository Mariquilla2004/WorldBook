  //Reference books collection
  var wishlistRef = firebase.database().ref("Wishlist");



//Listen for form submit

document.getElementById("wishlistForm").addEventListener("submit2", submitForm1);


//Submit form
function submitForm1(e){

    e.preventDefault();


   //Get values
   var titlew = getInputVal("titlew")
    var authorw = getInputVal("authorw")



    //Save book
    saveMessage1(titlew, authorw)

    $('#wishlistModal').modal('hide')
   //Clear form
   document.getElementById("wishlistForm").reset();
}


//Function to get form values
function getInputVal(id){
   return document.getElementById(id).value;
}

//save the book to firebase

function saveMessage1(titlew, authorw){
   var newWishlistRef = wishlistRef.push();
   newWishlistRef.set({
      titlew: titlew,
      authorw:authorw,
   });
}
